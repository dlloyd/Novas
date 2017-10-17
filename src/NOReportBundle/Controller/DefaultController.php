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


      $form = $this->createFormBuilder($data)
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
                            ),
                     'required' => true, 
                    'expanded' => true,
                    'multiple' => false ,))
                ->getForm();

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
         $average = array();
         $data= $form->getData();
            
            foreach ($data['subFams'] as $subId) {
               $responses = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
                                 ->findTotalSubFamilyAnsweredResponses($company->getId(),$subId); 
               $lines = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
                                       ->findTotalSubFamilyAnsweredCount($company->getId(),$subId);
                                       
               $totalAnswersValue = 0;
               foreach ($responses as $resp) {
                  $totalAnswersValue += $resp->getScoring();
                  
                } 
                
               if($lines[1]!=0){  // la condition évite la division par zéro
               $average[$subId->getName()] = (int)($totalAnswersValue/(int)$lines[1]);
               }
            }
            if($data['chart'] == 'radar'){
               return $this->render('NOReportBundle:Default:radar.html.twig',array('average'=>$average,));
            }
            else{
               return $this->render('NOReportBundle:Default:bar.html.twig',array('average'=>$average,));
            }
            
        }

        return $this->render('NOReportBundle:Default:index.html.twig',array('form' => $form->createView(),));

   }



   public function listChartReportFamilyAction($famId){

   }

   public function pdfReportAction(){

   }



}
