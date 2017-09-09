<?php

namespace NODiagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NODiagBundle\Entity\QuestionFamily;
use NODiagBundle\Entity\QuestionFamilyType;

class AdministrationController extends Controller
{
	
	public function indexAction()
    {
        return $this->render('NODiagBundle:Admin:index.html.twig');
    }

    public function getAllQuestionsAction(){
    	$em = $this->getDoctrine()->getManager();
    	$questions = $em->getRepository('NODiagBundle:Question')->findAll();

    	return $this->render('NODiagBundle:Admin:all.html.twig',array('questions' => $questions,));

    }


    public function createFamilyAction(Request $request){
    	$family = new QuestionFamily();
    	$form = $this->createForm(new QuestionFamilyType(),$family);

    	if($form->HandleRequest($request)->isValid()){
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($family);
    		$em->flush();

    		return $this->redirectToRoute('no_create_family');
    	}

    	return $this->render('NODiagBundle:Admin:family.html.twig',array('form' => $form->createView() ));

    }

    public function createSubFamilyAction(){
    	$subFamily = new QuestionSubFamily();
    	$form = $this->createForm(new QuestionSubFamilyType(),$subFamily);

    	if($form->HandleRequest($request)->isValid()){
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($subFamily);
    		$em->flush();

    		return $this->redirectToRoute('no_create_sub_family');
    	}

    	return $this->render('NODiagBundle:Admin:subfamily.html.twig',array('form' => $form->createView() ));

    }


    public function createQuestionAction(){
    	$question = new Question();
    	$form = $this->createForm(new Question(),$question);

    	if($form->HandleRequest($request)->isValid()){
    		if($question->getIsClosedQuestion()){
    			$yes = new Answer("Oui",1.0);
    			$no = new Answer("Non",0.0);
    			$question->addAnswer($yes);
    			$question->addAnswer($no);
    		}
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($question);
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('success',"La question a été ajoutée avec succès");

    		return $this->redirectToRoute('no_create_question');
    	}

    	return $this->render('NODiagBundle:Admin:question.html.twig',array('form' => $form->createView() ));

    }

    public function updateAnswersAction(Request $request, $AnswerId){


    }

    

    public function createActionAction(Request $request, $AnswerId){

    }



}
