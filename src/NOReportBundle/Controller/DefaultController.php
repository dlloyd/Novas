<?php

namespace NOReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
   public function indexAction(){
   	//$em = $this->getDoctrine()->getManager();
   	//$user = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
   	//$companyId = $user->getCompany()->getId();

   	return $this->render('NOReportBundle:Default:index.html.twig');	
   }


   public function radarChartFamilyAction(){
   	return $this->render('NOReportBundle:Default:radar.html.twig');	
   	
   }

   public function barChartFamilyAction(){
   	return $this->render('NOReportBundle:Default:bar.html.twig');	
   }


   public function listChartReportFamilyAction(){

   }

   public function pdfReportAction(){

   }
}
