<?php

namespace NOReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;



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

         $averagesArray = array();

         foreach ($data['type'] as $dt) {
          if($dt == 'threat'){

            if($data['allFams']){  //Si toutes les familles est sélectionné
              $averagesArray['averageThreat'] = $this->getAverageFamilyQuestions($data,$company,"MEN") ;
              $averagesArray['averagePreventiveAction'] = $this->getAverageFamilyQuestions($data,$company,"APR") ;
            }
            else{
              $averagesArray['averageThreat'] = $this->getAverageSubFamilyQuestions($data,$company,"MEN") ;
              $averagesArray['averagePreventiveAction'] = $this->getAverageSubFamilyQuestions($data,$company,"APR") ;
            }
           
           }

           if( $dt == 'opportunity'){
            if($data['allFams']){
              $averagesArray['averageOpportunity'] = $this->getAverageFamilyQuestions($data,$company,"OPP") ;
              $averagesArray['averageOpportunityAction'] = $this->getAverageFamilyQuestions($data,$company,"ADO") ;
            }
            else{
              $averagesArray['averageOpportunity'] = $this->getAverageSubFamilyQuestions($data,$company,"OPP") ;
              $averagesArray['averageOpportunityAction'] = $this->getAverageSubFamilyQuestions($data,$company,"ADO") ;
            }
           
           }
          
         }
             
         if($data['chart'] == 'radar'){
             
            return $this->render('NOReportBundle:Default:radar.html.twig',$averagesArray);
         }
         elseif($data['chart'] == 'bar'){
            
            return $this->render('NOReportBundle:Default:bar.html.twig',$averagesArray);
         }
         elseif($data['chart'] == 'list'){
             $responses = $this->getListReport($data,$company) ;
             return $this->render('NOReportBundle:Default:list.html.twig',$averagesArray);
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
         $averagesArray = array();

         foreach ($data['type'] as $dt) {
          if($dt == 'threat'){
           $averagesArray['averageThreat'] = $this->getAverageSubFamilyQuestions($data,$company,"MEN") ;
           $averagesArray['averagePreventiveAction'] = $this->getAverageSubFamilyQuestions($data,$company,"APR") ;
           }

           if( $dt == 'opportunity'){
           $averagesArray['averageOpportunity'] = $this->getAverageSubFamilyQuestions($data,$company,"OPP") ;
           $averagesArray['averageOpportunityAction'] = $this->getAverageSubFamilyQuestions($data,$company,"ADO") ;
           }
          
          }

            
            if($data['chart'] == 'radar'){
               return $this->render('NOReportBundle:Default:radar.html.twig',$averagesArray);
            }
            elseif($data['chart'] == 'bar'){
            
            return $this->render('NOReportBundle:Default:bar.html.twig',$averagesArray);
            }
            elseif($data['chart'] == 'list'){
               $responses = $this->getListReport($data,$company) ;
               return $this->render('NOReportBundle:Default:list.html.twig',array('responses'=>$responses,));
            }
            
        }

        return $this->render('NOReportBundle:Default:index.html.twig',array('form' => $form->createView(),'company'=> $company ));
   }




   public function getAverageSubFamilyQuestions($data,$company,$typeCode){
      $em = $this->getDoctrine()->getManager();
      $average = array();
      foreach ($data['subFams'] as $sub) {
               $responses = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
                                 ->findTotalSubFamilyAnsweredResponses($company->getId(),$sub,$typeCode); 
               $lines = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
                                       ->findTotalSubFamilyAnsweredCount($company->getId(),$sub,$typeCode);
                                       
               $totalAnswersScoring = 0;
               foreach ($responses as $resp) {
                  $totalAnswersScoring += $resp->getScoring();
                  
                } 
                
               if($lines[1]!=0){  // la condition évite la division par zéro
               $average[$sub->getFamily()->getName().':'.$sub->getName()] = (int)($totalAnswersScoring/(int)$lines[1]);
               }
               else{
                $average[$sub->getFamily()->getName().':'.$sub->getName()] = 0;
               }
            }
      return $average;
   }


   public function getAverageFamilyQuestions($data,$company,$typeCode){
      $em = $this->getDoctrine()->getManager();
      $average = array();
      $fams = array();
      // liste des familles accessibles
      foreach ($data['subFams'] as $sub) {
          $fams[$sub->getFamily()->getName()] = $sub->getFamily();
      }


      foreach ($fams as $fam) {
               $responses = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
                                 ->findTotalFamilyAnsweredResponses($company->getId(),$fam,$typeCode); 
               $lines = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
                                       ->findTotalFamilyAnsweredCount($company->getId(),$fam,$typeCode);
                                       
               $totalAnswersScoring = 0;
               foreach ($responses as $resp) {
                  $totalAnswersScoring += $resp->getScoring();
                  
                } 
                
               if($lines[1]!=0){  // la condition évite la division par zéro
               $average[$fam->getName()] = (int)($totalAnswersScoring/(int)$lines[1]);
               }
               else{
                $average[$fam->getName()] = 0;
               }
            }
      return $average;
   }





   public function getDataForm($data,$companySubFams){
      return  $this->createFormBuilder($data)
            ->add('allFams' ,CheckboxType::class, array(
                        'label'    => 'Toutes les familles',
                        'required' => false,
                    ))
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
                                'list' => 'liste'
                            ),
                     'required' => true, 
                    'expanded' => true,
                    'multiple' => false ,))
            ->add('type',ChoiceType::class,array(
                     'choices'  => array(
                                'threat' => 'Menace',
                                'opportunity' => 'Opportunité',
                            ),
                    'data' => array('threat','opportunity'), 
                    'expanded' => true,
                    'multiple' => true ,))
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


    public function updateResponseReportCommentAction(Request $request){

        if($request->isXmlHttpRequest() ){
            $em = $this->getDoctrine()->getManager();
            $companyId = $request->request->get('companyId');
            $questionId = $request->request->get('questionId');
            $reportComment = $request->request->get('reportComment');
            $response = $em->getRepository('NODiagBundle:ResponseQuestionCompany')->findResponse($companyId,$questionId);
            $response->setReportComment($reportComment);
           
            $em->merge($response);
            $em->flush();
            return new JsonResponse(array('data'=>'Note interne ajoutée! pour voir les modifications appuyez sur la touche F5'));
        }
                         
        else{
            return new Response('not ajax query',400); 
        }  

    }
        



}
