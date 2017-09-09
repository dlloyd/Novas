<?php

namespace NODiagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class QuestionController extends Controller
{
	public function createQuestionAction(){
		$question = new Question();
    	$form = $this->createForm(new Question(),$question);

    	if($form->HandleRequest($request)->isValid()){
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($question);
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('success',"La question a été ajoutée avec succès");

    		return $this->redirectToRoute('no_create_question');
    	}

    	return $this->render('NODiagBundle:Admin:question.html.twig',array('form' => $form->createView() ));
	}



}
