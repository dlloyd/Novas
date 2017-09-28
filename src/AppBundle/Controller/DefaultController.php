<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

	/**
     * @Route("/", name="no_home")
     */
    public function indexAction(Request $request)
    {
        
        return $this->render('default/index.html.twig');
    }


	/**
     * @Route("/home", name="no_homepage")
     */
    public function homeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $fams = $em->getRepository('NODiagBundle:QuestionFamily')->findAll();
        return $this->render('default/home.html.twig',array('fams'=> $fams,));
    }
    
}
