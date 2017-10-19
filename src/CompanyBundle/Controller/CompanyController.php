<?php

namespace CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

use CompanyBundle\Entity\Company;
use CompanyBundle\Form\CompanyType;
use NODiagBundle\Entity\ModeratorAccessRight;
use NODiagBundle\Entity\CompanyQuestionSubFamilyAccess;
use NODiagBundle\Entity\ResponseQuestionCompany;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CompanyController extends Controller
{
	public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
    	$company = $user->getCompany();
        return $this->render('CompanyBundle:Default:index.html.twig',array('company'=> $company,));
    }


    public function createCompanyAction(Request $request){
    	$company = new Company();
		$form = $this->createForm(new CompanyType(),$company);

		if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
			$em = $this->getDoctrine()->getManager();

			$em->persist($company);
			$em->flush();

			return $this->redirectToRoute('no_create_company');
		}

		return $this->render('CompanyBundle:Company:create.html.twig', array('form' => $form->createView()));

    }


     public function updateCompanyInfosAction(Request $request,$id){
        $em = $this->getDoctrine('CompanyBundle:Company')->getManager();
        $company = $em->getRepository()->find($id);
        $user = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());

        // just for administrator and company's owner
        if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN') || 
            ( $user->hasrole('ROLE_COMPANY_OWNER') && $user->getCompany()->getId() == $company->getId() )){
        $form = $this->createForm(new CompanyType(),$company);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('no_create_company');
        }

        return $this->render('CompanyBundle:Company:update.html.twig', array('form' => $form->createView()));
       }
       else{
            throw $this->createAccessDeniedException('YOU ARE NOT ALLOWED TO BE HERE!');
       }

    }



    public function getCompanyModeratorsAction($companyId){
    	$em = $this->getDoctrine()->getManager();
    	$company = $em->getRepository('CompanyBundle:Company')->find($companyId);

    	return $this->render('CompanyBundle:Company:company-moderators.html.twig',array('company' => $company,));
    }

    public function disableCompanyAndAccountsAction($companyId){
    	$em = $this->getDoctrine()->getManager();
    	$company = $em->getRepository('CompanyBundle:Company')->find($companyId);

    	if($company){
    		foreach ($company->getModerators() as $mod) {
    			$mod->setEnabled(false);
    		}
    		$em->merge($company);
    		$em->flush();
    	}

    	return $this->redirectToRoute('no_all_companies');
    }


    public function enableCompanyAndAccountsAction($companyId){
    	$em = $this->getDoctrine()->getManager();
    	$company = $em->getRepository('CompanyBundle:Company')->find($companyId);

    	if($company){
    		foreach ($company->getModerators() as $mod ) {
    			$mod->setEnabled(true);
    		}
    		$em->merge($company);
    		$em->flush();
    	}

    	return $this->redirectToRoute('no_all_companies');

    }


     public function deleteModeratorAction($moderatorId){
    	// just for company's admin user
    	$em = $this->getDoctrine()->getManager();
    	$mod = $em->getRepository('NOUserBundle:User')->find($moderatorId); 

    	if($mod){
    		$em->remove($mod);
    		$em->flush();

    	}

    	return $this->redirectToRoute('no_show_company_accounts',array('companyId'=> $mod->getCompany()->getId(),));
    }






    public function getCompaniesAction(){
    	$em = $this->getDoctrine()->getManager();
    	$companies = $em->getRepository('CompanyBundle:Company')->findAll();

    	return $this->render('CompanyBundle:Company:companies.html.twig',array('companies' => $companies,));
    }

    public function addModeratorAction($companyId, Request $request){
    	$userData = array();
    	$company = $this->getDoctrine()->getManager()->getRepository('CompanyBundle:Company')->find($companyId);
    	$form = $this->createFormBuilder($userData)
    		->add('name',TextType::class)
    		->add('email',EmailType::class)
    		->add('function',TextType::class)
    		->add('status',ChoiceType::class, array('choices' => array( 1 =>'ADMINISTRATOR',
    																	2 =>'EMPLOYEE'),))
    		->getForm();

    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid()){
            $pass = $this->generatePassword();

    		$userManager = $this->container->get('fos_user.user_manager');
    		$data= $form->getData();
            $user = $userManager->createUser();
            $user->setUsername($data['name']);
            $user->setEmail($data['email']);
            $user->setPlainPassword($pass);
            $user->setCompanyFunction($data['function']);
            if($data['status'] == 1){
            	$user->addRole('ROLE_COMPANY_OWNER');
            }
            if($data['status'] == 2 ){
            	$user->addRole('ROLE_USER');
            }
            
            $user->setCompany($company);
            $user->setEnabled(true);

            $userManager->updateUser($user);

            //envoie par email le mot de passe utilisateur? pour le moment affiche en flash
            $message = "l'utilisateur ".$user->getUsername(). " de la company ".$company->getDenomination()." à pour mot de passe ".$pass;
            $request->getSession()
            ->getFlashBag()
            ->add('success', $message);
            return $this->redirectToRoute('no_all_companies');
        }

        return $this->render('CompanyBundle:Default:create-mod.html.twig',array('form' => $form->createView(), 'company'=> $company,  ));

    }


    public function getModeratorsAction(){
    	$em = $this->getDoctrine()->getManager();
    	$companyAdmin = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
    	$moderators = $companyAdmin->getCompany()->getModerators();

    	return $this->render('CompanyBundle:Company:moderators.html.twig',array('moderators' => $moderators,));

    }


    public function disableModeratorAction($id){
    	$em = $this->getDoctrine()->getManager();
    	$admin = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
    	$mod =   $em->getRepository('NOUserBundle:User')->find($id); 

    	if($mod->getCompany()== $admin->getCompany()){
    		$mod->setEnabled(false);
    		$em->merge($mod);
    		$em->flush();

    	}

    	return $this->redirectToRoute('no_company_show_moderators');
    }


    public function enableModeratorAction($id){
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
        $mod = $em->getRepository('NOUserBundle:User')->find($id); 

        if($mod->getCompany()== $admin->getCompany()){
            $mod->setEnabled(true);
            $em->merge($mod);
            $em->flush();

        }

        return $this->redirectToRoute('no_company_show_moderators');
    }

    public function adminDisableModeratorAction($id){
        $em = $this->getDoctrine()->getManager();
        $mod = $em->getRepository('NOUserBundle:User')->find($id); 

        if($mod){
            $mod->setEnabled(false);
            $em->merge($mod);
            $em->flush();

        }

        return $this->redirectToRoute('no_show_company_accounts',array('companyId'=> $mod->getCompany()->getId(),));
    }


    public function adminEnableModeratorAction($id){
        $em = $this->getDoctrine()->getManager();
        $mod = $em->getRepository('NOUserBundle:User')->find($id); 

        if($mod){
            $mod->setEnabled(true);
            $em->merge($mod);
            $em->flush();

        }

        return $this->redirectToRoute('no_show_company_accounts',array('companyId'=> $mod->getCompany()->getId(),));
    }


    public function setModeratorAccessRightAction($moderatorId,Request $request){
    	$em = $this->getDoctrine()->getManager() ;
        $user = $em->getRepository('NOUserBundle:User')->find($moderatorId);
        $companyId = $user->getCompany()->getId(); 
        $data = array();
    	$otherSubFams = $em->getRepository('NODiagBundle:QuestionSubFamily')->findOthersAccessModerator($moderatorId,$companyId);
    	
        $form = $this->createFormBuilder($data)
    			->add('subFams',EntityType::class,array(
                    'class'    => 'NODiagBundle:QuestionSubFamily',
                    'choices'  =>  $otherSubFams,
                    'choice_label' => function ($subFamily) {
                            return $subFamily->getName();
                        },
                    'group_by' => function($subFamily) {
                                        return $subFamily->getFamily()->getName();
                                    },
                    'required' => false, 
                    'expanded' => true,
                    'multiple' => true ,))
                ->getForm();

    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid()){
    		
    		$data= $form->getData();
            
            foreach ($data['subFams'] as $subId) {
            	
            	$moderatorAccessRight = $em->getRepository('NODiagBundle:ModeratorAccessRight')->findMAR($moderatorId,$subId);
            	if(!$moderatorAccessRight){
            	$sub = $em->getRepository('NODiagBundle:QuestionSubFamily')->find($subId);
            	$moderatorAccessRight = new ModeratorAccessRight();
            	$moderatorAccessRight->setModerator($user);
            	$moderatorAccessRight->setQuestionSubFamily($sub);
            	$user->addModeratorAccessRight($moderatorAccessRight);
            	$em->persist($moderatorAccessRight);
            	$em->merge($user);
            	$em->flush();
             }
            }

            return $this->redirectToRoute('no_all_companies');
        }

        return $this->render('CompanyBundle:Company:mod-access.html.twig',array('form' => $form->createView(),
        		'moderatorId'=>$moderatorId,));

    }



    public function addCompanyAccessRightAction($companyId,Request $request){
        $em = $this->getDoctrine()->getManager() ;
        $data = array();
        $otherSubFams = $em->getRepository('NODiagBundle:QuestionSubFamily')->findOthersAccessCompany($companyId);

        $form = $this->createFormBuilder($data)
                ->add('subFams',EntityType::class,array(
                    'class'    => 'NODiagBundle:QuestionSubFamily',
                    'choices'  =>  $otherSubFams,
                    'choice_label' => function ($subFamily) {
                            return $subFamily->getName();
                        },
                    'group_by' => function($subFamily) {
                                        return $subFamily->getFamily()->getName();
                                    },
                    'required' => false, 
                    'expanded' => true,
                    'multiple' => true ,))
                ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
            $data= $form->getData();
            $company = $em->getRepository('CompanyBundle:Company')->find($companyId);
            
            
            foreach ($data['subFams'] as $subId) {
                
                $compAccess = $em->getRepository('NODiagBundle:CompanyQuestionSubFamilyAccess')->findCAR($companyId,$subId);
                if(!$compAccess){
                $sub = $em->getRepository('NODiagBundle:QuestionSubFamily')->find($subId);
                $compAccess = new CompanyQuestionSubFamilyAccess();
                $compAccess->setCompany($company);
                $compAccess->setQuestionSubFamily($sub);
                $company->addCompanyQuestionSubFamAccess($compAccess);

                foreach ($sub->getQuestions() as $quest) {
                    $questComp = new ResponseQuestionCompany();
                    $questComp->setCompany($company);
                    $questComp->setQuestion($quest);
                    $questComp->setIsAnswered(false);
                    $em->persist($questComp);

                }

                $em->persist($compAccess);
                $em->merge($company);
                $em->flush();
             }
            }

            return $this->redirectToRoute('no_all_companies');
        }

        return $this->render('CompanyBundle:Company:comp-access.html.twig',array('form' => $form->createView(),
                'companyId'=>$companyId,));
    }



    public function generatePassword(){
        $string = bin2hex(openssl_random_pseudo_bytes(4)); // 8 chars long
        $special = array('!','@','#','$','%','&');
        $random = rand(0,5);
        return 'NO1'.$string.$special[$random];
    }



}
