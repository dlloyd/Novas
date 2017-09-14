<?php

namespace NODiagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use NODiagBundle\Entity\QuestionFamily;
use NODiagBundle\Form\QuestionFamilyType;

class QuestionFamilyController extends Controller
{

	public function createQuestionFamilyAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		$fams = $em->getRepository('NODiagBundle:QuestionFamily')->findAll();
		$fam = new QuestionFamily();
        $form = $this->createForm(new QuestionFamilyType(),$fam);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            
            $em->persist($fam);
            $em->flush();

            return $this->redirectToRoute('no_create_question_family');
        }

        return $this->render('NODiagBundle:QuestionFamily:create.html.twig', array('form' => $form->createView(),'fams'=> $fams,));

    }


    public function updateQuestionFamilyAction($id,Request $request){
    	$em = $this->getDoctrine()->getManager();
        $fam = $em->getRepository('NODiagBundle:QuestionFamily')->find($id);
        $form = $this->createForm(new QuestionFamilyType(),$fam);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->merge($fam);
            $em->flush();

            return $this->redirectToRoute('no_show_all_question_family');
        }

        return $this->render('NODiagBundle:QuestionFamily:update.html.twig', array('form' => $form->createView(),'id'=>$id,));

    }


    public function deleteQuestionFamilyAction($id){
    	
    }
}
