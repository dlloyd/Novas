<?php

namespace NODiagBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use NODiagBundle\Entity\Question;
use NODiagBundle\Form\QuestionType;
use NODiagBundle\Form\AnswerType;
use NODiagBundle\Entity\ResponseQuestionCompany;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

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
                    $questComp->setIsInappropriated(false);
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

            $em->merge($question);
            $em->flush();

            return $this->redirectToRoute('no_update_question_answers',array('id'=> $question->getId(),));
        }

        return $this->render('NODiagBundle:Question:update.html.twig', array('form' => $form->createView(),'id'=>$id,));

    }

    public function allQuestionsAction(){
        $em = $this->getDoctrine()->getManager();
        $questions = $em->getRepository('NODiagBundle:Question')->findAll();

        return $this->render('NODiagBundle:Question:all.html.twig',array('questions'=>$questions,));
    }


    public function addQuestionAnswersAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('NODiagBundle:Question')->find($id);
        $form = $this->createFormBuilder($question)
        ->add('answers', 'collection' ,array(
                    'type' => new AnswerType(),
                    'allow_add' => true,
                    'allow_delete' => true,))
        ->getForm();

        
        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            foreach ($question->getAnswers() as $answer) {
                $answer->setQuestion($question);
            }

            $em->merge($question);
            $em->flush();


            return $this->redirectToRoute('no_create_question');
        }

        return $this->render('NODiagBundle:Question:answers.html.twig', array('form' => $form->createView(),'question'=>$question,
                                                                                'multiple' => $question->getAnswerTypeIsMultiple()));
    }

    public function updateQuestionAnswersAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('NODiagBundle:Question')->find($id);
        $form = $this->createFormBuilder($question)
        ->add('answers', 'collection' ,array(
                    'type' => new AnswerType(),
                    'allow_add' => true,
                    'allow_delete' => true,))
        ->getForm();

        
        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){

            foreach ($question->getAnswers() as $answer) {
                $answer->setQuestion($question);
            }

            $em->merge($question);
            $em->flush();

            return $this->redirectToRoute('no_all_questions');
        }

        return $this->render('NODiagBundle:Question:answers-update.html.twig', array('form' => $form->createView(),
                                                                                     'question'=>$question,));
    }

    public function questionsSubFamiliesAction($subFamId, Request $request){
        $em = $this->getDoctrine()->getManager();
        $userId = $this->getUser()->getId();
        $subFam = $em->getRepository('NODiagBundle:QuestionSubFamily')->find($subFamId);
        $company = $em->getRepository('NOUserBundle:User')->find($userId)->getCompany();
        $rightAcc = $em->getRepository('NODiagBundle:ModeratorAccessRight')->findMAR($userId,$subFamId);

        if($rightAcc){
            $resp = $em->getRepository('NODiagBundle:ResponseQuestionCompany')->findCSFResponses($company->getId(),$subFamId);
            return $this->render('NODiagBundle:Question:questions.html.twig',array('responses'=>$resp,'subFamily' => $subFam,));
        } 

        return $this->render('NODiagBundle:Question:questions.html.twig',array('responses'=>null, ));

    }


    public function respondeToQuestionAction($questionId, Request $request){
        $data= array();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
        $question = $em->getRepository('NODiagBundle:Question')->find($questionId);
        if(!$question){
            throw $this->createAccessDeniedException("Cette question n'existe pas!");
        }
        $access = $em->getRepository('NODiagBundle:ModeratorAccessRight')->findMAR($user->getId(),$question->getSubFamily());

        if($access){
            $response = $em->getRepository('NODiagBundle:ResponseQuestionCompany')->findResponse($user->getCompany()->getId(),$questionId);
            $form = $this->createFormBuilder($data)
            ->add('answers','entity',array(
                    'class'    => 'NODiagBundle:Answer',
                    'choices'  =>  $question->getAnswers(),
                    'property' => 'answer',
                    'required' => true, 
                    'expanded' => true,
                    'multiple' => $question->getAnswerTypeIsMultiple() ,))
            ->add('inappropriated' ,CheckboxType::class, array(
                        'label'    => 'N/A',
                        'required' => false,
                    ))
            ->add('comment','textarea',array('required'=>false,))
            ->add('reportComment','textarea',array('required'=>false,))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $answers = array();
            $data= $form->getData();

            if($question->getAnswerTypeIsMultiple()){
                foreach ($data['answers'] as $answ) {
                    array_push($answers, $answ);
                }
            }
            else{
                array_push($answers, $data['answers']);
            }
            
            if ($data['comment'] != null) {
                $response->setComment($data['comment']);
            }
             if ($data['reportComment'] != null) {
                $response->setReportComment($data['reportComment']);
            }
            if($data['inappropriated']){
                $response->setIsInappropriated(true);
            }
            else{
            $response->setAnswers($answers);
            }
            $response->setIsAnswered(true);
            $response->setLastModification( new\DateTime());
            $response->setUsername($user->getUsername());
            
            $em->merge($response);
            $em->flush();
                         
            return $this->redirectToRoute('no_question_sub_family_questions',array('subFamId'=>$question->getSubFamily()->getId(),));
        }

         return $this->render('NODiagBundle:Question:comp-answer.html.twig',array('form'=>$form->createView(),'response'=>$response));

        }
        else{
            throw $this->createAccessDeniedException('Vous ne pouvez pas accéder à cette question!');
        }

        
    }



}
