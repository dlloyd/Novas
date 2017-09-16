<?php

namespace NODiagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use NODiagBundle\Entity\QuestionSubFamily;
use NODiagBundle\Form\QuestionSubFamilyType;

class QuestionSubFamilyController extends Controller
{

	public function createQuestionSubFamilyAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		$subFams = $em->getRepository('NODiagBundle:QuestionSubFamily')->findAll();
		$subFam = new QuestionSubFamily();
        $form = $this->createForm(new QuestionSubFamilyType(),$subFam);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){

            $em->persist($subFam);
            $em->flush();

            return $this->redirectToRoute('no_create_question_sub_family');
        }

        return $this->render('NODiagBundle:QuestionSubFamily:create.html.twig', array('form' => $form->createView(),'subFams' => $subFams,));

    }


    public function updateQuestionSubFamilyAction($id,Request $request){
    	$em = $this->getDoctrine()->getManager();
        $subFam = $em->getRepository('NODiagBundle:QuestionSubFamily')->find($id);
        $form = $this->createForm(new QuestionSubFamilyType(),$subFam);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->merge($subFam);
            $em->flush();

            return $this->redirectToRoute('no_create_question_sub_family');
        }

        return $this->render('NODiagBundle:QuestionSubFamily:update.html.twig', array('form' => $form->createView(),'id'=>$id,));

    }


    


    
}
