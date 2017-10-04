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
        $auth_checker = $this->get('security.authorization_checker');
        $em = $this->getDoctrine()->getManager();

        if($auth_checker->isGranted('IS_AUTHENTICATED_REMEMBERED') 
            && !$auth_checker->isGranted('ROLE_ADMIN') && !$auth_checker->isGranted('ROLE_SUPER_ADMIN')   ){
            $responsesSubFam = array();
            $totalSubFamQuestions = array();
            $user = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId());
            $companyId = $user->getCompany()->getId(); 
            $fams = $em->getRepository('NODiagBundle:QuestionFamily')->findAll();
            $subFamsCount = $em->getRepository('NODiagBundle:ResponseQuestionCompany')->findAnsweredQuestionSubFamiliesCount($companyId);
            $totalSubFamsCount = $em->getRepository('NODiagBundle:ResponseQuestionCompany')->findTotalQuestionSubFamiliesCount($companyId);

            foreach ($subFamsCount as $sfc) {
                $responsesSubFam[ $sfc['id'] ] = $sfc[1];
            }
            foreach ($totalSubFamsCount as $sfc) {
                $totalSubFamsCount[ $sfc['id'] ] = $sfc[1];
            }
            
            return $this->render('default/home.html.twig',array('fams'=> $fams,
                                                                'responsesSubFam'=>$responsesSubFam,
                                                                'totalSubFamQuestions'=>$totalSubFamsCount,));
        }

        $fams = $em->getRepository('NODiagBundle:QuestionFamily')->findAll();
        return $this->render('default/home.html.twig',array('fams'=> $fams,));
    }
    
}
