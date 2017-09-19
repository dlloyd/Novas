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

class CompanyController extends Controller
{
	public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $this->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
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
    		->add('password',PasswordType::class)
    		->add('confirmation_password',PasswordType::class)
    		->add('function',TextType::class)
    		->add('status',ChoiceType::class, array('choices' => array( 1 =>'ADMINISTRATOR',
    																	2 =>'EMPLOYEE'),))
    		->getForm();

    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid()){
    		$userManager = $this->container->get('fos_user.user_manager');
    		$data= $form->getData();
            $user = $userManager->createUser();
            $user->setUsername($data['name']);
            $user->setEmail($data['email']);
            $user->setPlainPassword($data['password']);
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
    	$data = array();
    	$subFams = $em->getRepository('NODiagBundle:QuestionSubFamily')->findAll();
    	$form = $this->createFormBuilder($data)
    			->add('subFams','entity',array(
                    'class'    => 'NODiagBundle:QuestionSubFamily',
                    'property' => 'name',
                    'multiple' => true ,))
    			->getForm();

    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid()){
    		
    		$data= $form->getData();
            $user = $em->getRepository('NOUserBundle:User')->find($moderatorId);
            
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



    public function changeModeratorPasswordAction($moderatorId){

    }

    public function updateCompanyInfosAction(){

    }
}