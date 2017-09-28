<?php

namespace NODiagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use NODiagBundle\Entity\Question;
use NODiagBundle\Form\QuestionType;
use NODiagBundle\Entity\ResponseQuestionCompany;

class QuestionController extends Controller
{
	public function createQuestionAction(Request $request){
		$question = new Question();
    	$form = $this->createForm(new QuestionType(),$question);

    	if($request->getMethod() == 'POST' &&  $form->HandleRequest($request)->isValid()){
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($question);

            //ajouter la question aux companies qui ont les droits sur la sous-famille de questions
            $companies = $em->getRepository('CompanyBundle:Company')->findCompaniesRight($question->getSubFamily());
            foreach ($companies as $company) {
                $questComp = new ResponseQuestionCompany();
                    $questComp->setCompany($company);
                    $questComp->setQuestion($question);
                    $questComp->setIsAnswered(false);
                    $em->persist($questComp);
            }
            $em->flush();

    		$request->getSession()->getFlashBag()->add('success',"La question a été ajoutée avec succès");

    		return $this->redirectToRoute('no_add_question_answers',array('id'=> $question->getId(),));
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


    public function addQuestionAnswersAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('NODiagBundle:Question')->find($id);
        $form = $this->createForm(new QuestionType(),$question);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            foreach ($question->getAnswers() as $answer) {
                $answer->setQuestion($question);
            }

            $em->merge($question);
            $em->flush();

            return $this->redirectToRoute('no_create_question');
        }

        return $this->render('NODiagBundle:Question:answers.html.twig', array('form' => $form->createView(),'id'=>$id,));
    }

    public function questionsSubFamiliesAction($subFamId, Request $request){
        $em = $this->getDoctrine()->getManager();
        $userId = $this->getUser()->getId();
        $company = $em->getRepository('NOUserBundle:User')->find($userId)->getCompany();
        $rightAcc = $em->getRepository('NODiagBundle:ModeratorAccessRight')->findMAR($userId,$subFamId);

        if($rightAcc){
            $resp = $em->getRepository('NODiagBundle:ResponseQuestionCompany')->findCSFResponses($company->getId(),$subFamId);
            return $this->render('NODiagBundle:Question:questions.html.twig',array('responses'=>$resp,));
        } 

        return $this->render('NODiagBundle:Question:questions.html.twig',array('responses'=>null,));

    }



}
