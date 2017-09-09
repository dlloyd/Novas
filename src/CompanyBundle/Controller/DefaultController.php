<?php

namespace CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CompanyBundle:Default:index.html.twig');
    }


    public function createCompanyAction(){
    	// just for the site's admin

    }

    public function addModeratorAction($companyId, Request $request){
    	$userData = array();
    	$form = $this->createFormBuilder($userData)
    		->add('name')
    		->add('email')
    		->add('password')
    		->add('function')
    		->add('status',ChoiceType::class, array('choices' => array('administrator'=>'ADMINISTRATOR','employee'=>'EMPLOYEE'),))
    		->add('send', SubmitType::class)
    		->getForm();

    	$form->handleRequest($request)

    	if($form->isSubmitted() && $form->isValid()){
    	$userManager = $this->container->get('fos_user.user_manager');
    		$data= $form->getData();
            $user = $userManager->createUser();
            $user->setUsername($data['name']);
            $user->setEmail($data['email']);
            $user->setPlainPassword($data['password']);
            $user->setStatus($data['status']);
            $user->setCompanyFunction($data['function']);
            $user->addRole('ROLE_USER');

            $userManager->updateUser($user);
        }

        return $this->render('',array('form' => $form->createView(),));

    }


    public function disableModeratorAction($ModeratorId){
    	// just for company's admin user
    }


    public function changeModeratorPasswordAction($ModeratorId){

    }

    public function updateCompanyInfosAction(){

    }
}
