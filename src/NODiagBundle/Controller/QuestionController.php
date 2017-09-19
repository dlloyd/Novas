<?php

namespace NODiagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use NODiagBundle\Entity\Question;
use NODiagBundle\Form\QuestionType;

class QuestionController extends Controller
{
	public function createQuestionAction(Request $request){
		$question = new Question();
    	$form = $this->createForm(new QuestionType(),$question);

    	if($request->getMethod() == 'POST' &&  $form->HandleRequest($request)->isValid()){
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($question);
    		$em->flush();

    		$request->getSession()->getFlashBag()->add('success',"La question a été ajoutée avec succès");

    		return $this->redirectToRoute('no_create_question');
    	}

    	return $this->render('NODiagBundle:Question:create.html.twig',array('form' => $form->createView() ));
	}



    public function updateQuestionAction($id,Request $request){
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('NODiagBundle:Question')->find($id);
        $form = $this->createForm(new QuestionType(),$question);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->merge($question);
            $em->flush();

            return $this->redirectToRoute('no_create_question');
        }

        return $this->render('NODiagBundle:Question:update.html.twig', array('form' => $form->createView(),'id'=>$id,));

    }



}
