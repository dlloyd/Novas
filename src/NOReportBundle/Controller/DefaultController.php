<?php

namespace NOReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
   public function indexAction(){
   	$em = $this->getDoctrine()->getManager();
   	$user = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
   	$company = $user->getCompany();

   	$families= array();

   	foreach ($company->getCompanyQuestionSubFamAccess() as  $subAccess) {
   		$fam = $subAccess->getQuestionSubFamily()->getFamily();
   		if(!isset($families[ $fam->getId() ])){
   			$families[ $fam->getId() ] = $fam->getName();

   		}
   	}

   	return $this->render('NOReportBundle:Default:index.html.twig',array('families'=>$families,));	
   }


   public function radarChartFamilyAction($famId){
   	$em = $this->getDoctrine()->getManager();
   	$average = array();
   	$user = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
   	$company = $user->getCompany();

   	foreach ($company->getCompanyQuestionSubFamAccess() as  $subAccess) {
   		$subFam = $subAccess->getQuestionSubFamily();
   		if($subFam->getFamily()->getId()== $famId){
   		$responses = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
   										->findTotalSubFamilyAnsweredResponses($company->getId(),$subFam->getId()); 
   		$lines = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
   										->findTotalSubFamilyAnsweredCount($company->getId(),$subFam->getId());
   										
   		$totalAnswersValue = 0;
   		foreach ($responses as $resp) {
   			$totalAnswersValue += $resp->getScoring();
   		 	
   		 } 
   		 

   		$average[$subFam->getName()] = (int)($totalAnswersValue/(int)$lines[1]);
   	  }
   	}

   	return $this->render('NOReportBundle:Default:radar.html.twig',array('average'=>$average,));	
   	
   }

   public function barChartFamilyAction($famId){
   	$em = $this->getDoctrine()->getManager();
   	$average = array();
   	$user = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
   	$company = $user->getCompany();

   	foreach ($company->getCompanyQuestionSubFamAccess() as  $subAccess) {
   		$subFam = $subAccess->getQuestionSubFamily();

   		if($subFam->getFamily()->getId()== $famId){
   		$responses = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
   										->findTotalSubFamilyAnsweredResponses($company->getId(),$subFam->getId()); 
   		$lines = $em->getRepository('NODiagBundle:ResponseQuestionCompany')
   										->findTotalSubFamilyAnsweredCount($company->getId(),$subFam->getId());
   										
   		$totalAnswersValue = 0;
   		foreach ($responses as $resp) {
   			$totalAnswersValue += $resp->getScoring();
   		 	
   		 } 
   		 

   		$average[$subFam->getName()] = (int)($totalAnswersValue/(int)$lines[1]);
   	  }

   	}
   	return $this->render('NOReportBundle:Default:bar.html.twig',array('average'=>$average,));	
   }


   public function listChartReportFamilyAction($famId){

   }

   public function pdfReportAction(){

   }
}
