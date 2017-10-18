<?php

namespace NOReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DefaultController extends Controller
{
   
   public function indexAction(Request $request){
      $data = array();
      $companySubFams = array();
      $em = $this->getDoctrine()->getManager();
      $user = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
      $company = $user->getCompany();
      
      foreach ($company->getCompanyQuestionSubFamAccess() as  $subAccess) {
         array_push($companySubFams, $subAccess->getQuestionSubFamily());
      }


      $form = $this->getDataForm($data,$companySubFams);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
         $data= $form->getData();
             
         if($data['chart'] == 'radar'){
            $average = $this->getAverageSubFamilyQuestions($data,$company); 
            return $this->render('NOReportBundle:Default:radar.html.twig',array('average'=>$average,));
         }
         elseif($data['chart'] == 'bar'){
            $average = $this->getAverageSubFamilyQuestions($data,$company); 
            return $this->render('NOReportBundle:Default:bar.html.twig',array('average'=>$average,));
         }
         
         
     }

        return $this->render('NOReportBundle:Default:index.html.twig',array('form' => $form->createView(),));

   }


   public function adminCompanyReportAction($companyId,Request $request){
      $data = array();
      $companySubFams = array();
      $em = $this->getDoctrine()->getManager();
      $company = $em->getRepository('CompanyBundle:Company')->find($companyId);
      
      foreach ($company->getCompanyQuestionSubFamAccess() as  $subAccess) {
         array_push($companySubFams, $subAccess->getQuestionSubFamily());
      }


      $form = $this->getDataForm($data,$companySubFams);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
         
         $data= $form->getData();
         $average = $this->getAverageSubFamilyQuestions($data,$company);   
            
            if($data['chart'] == 'radar'){
               return $this->render('NOReportBundle:Default:radar.html.twig',array('average'=>$average,));
            }
            elseif($data['chart'] == 'bar'){
            $average = $this->getAverageSubFamilyQuestions($data,$company); 
            return $this->render('NOReportBundle:Default:bar.html.twig',array('average'=>$average,));
            }
            elseif($data['chart'] == 'liste'){
               $responses = $this->getListReport($data,$company) ;
               return $this->render('NOReportBundle:Default:list.html.twig',array('responses'=>$responses,));
            }
            
        }

        return $this->render('NOReportBundle:Default:index.html.twig',array('form' => $form->createView(),'company'=> $company ));
   }




   public function pdfReportAction(){

   }


   public function getAverageSubFamilyQuestions($data,$company){
      $em = $this->getDoctrine()->getManager();
      $average = array();
      foreach ($data['subFams'] as $sub) {
               $responses = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
                                 ->findTotalSubFamilyAnsweredResponses($company->getId(),$sub); 
               $lines = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
                                       ->findTotalSubFamilyAnsweredCount($company->getId(),$sub);
                                       
               $totalAnswersValue = 0;
               foreach ($responses as $resp) {
                  $totalAnswersValue += $resp->getScoring();
                  
                } 
                
               if($lines[1]!=0){  // la condition évite la division par zéro
               $average[$sub->getFamily()->getName().':'.$sub->getName()] = (int)($totalAnswersValue/(int)$lines[1]);
               }
            }
      return $average;
   }


   public function getDataForm($data,$companySubFams){
      return  $this->createFormBuilder($data)
            ->add('subFams',EntityType::class,array(
                    'class'    => 'NODiagBundle:QuestionSubFamily',
                    'choices'  => $companySubFams,
                    'choice_label' => function ($subFamily) {
                            return $subFamily->getName();
                        },
                    'group_by' => function($subFamily) {
                                        return $subFamily->getFamily()->getName();
                                    },
                    'required' => false, 
                    'expanded' => true,
                    'multiple' => true ,))
            ->add('chart',ChoiceType::class,array(
                     'choices'  => array(
                                'radar' => 'radar',
                                'bar' => 'bar',
                                'liste' => 'liste'
                            ),
                     'required' => true, 
                    'expanded' => true,
                    'multiple' => false ,))
                ->getForm();

   }


   public function getListReport($data,$company){
        $em = $this->getDoctrine()->getManager();
         foreach ($data['subFams'] as $sub) {
            $resp = $em->getRepository('NODiagBundle:ResponseQuestionCompany')->findCSFResponses($company->getId(),$sub->getId());
            $responses[$sub->getName()] = $resp ; 
         }
         
         return $responses;
       
   }



}
