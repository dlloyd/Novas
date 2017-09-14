<?php

namespace CompanyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CompanyBundle\Entity\ActivityBranch;
use CompanyBundle\Form\ActivityBranchType;
use CompanyBundle\Entity\CodeNAF;
use CompanyBundle\Form\CodeNAFType;
use CompanyBundle\Entity\LegalStatus;
use CompanyBundle\Form\LegalStatusType;




class DefaultController extends Controller
{

    public function createActivityBranchAction(Request $request){
        $actiBranch = new ActivityBranch();
        $form = $this->createForm(new ActivityBranchType(),$actiBranch);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($actiBranch);
            $em->flush();

            return $this->redirectToRoute('no_create_activity_branch');
        }

        return $this->render('CompanyBundle:Activity:create.html.twig', array('form' => $form->createView()));

    }

    public function createCodeNAFAction(Request $request){
        $codeNAF = new CodeNAF();
        $form = $this->createForm(new CodeNAFType(),$codeNAF);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($codeNAF);
            $em->flush();

            return $this->redirectToRoute('no_create_code_naf');
        }

        return $this->render('CompanyBundle:NAF:create.html.twig', array('form' => $form->createView()));

    }

    public function createLegalStatusAction(Request $request){
        $legalStatus = new legalStatus();
        $form = $this->createForm(new LegalStatusType(),$legalStatus);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($legalStatus);
            $em->flush();

            return $this->redirectToRoute('no_create_legal_status');
        }

        return $this->render('CompanyBundle:Status:create.html.twig', array('form' => $form->createView()));

    }


    public function updateActivityBranchAction($activityId,Request $request){
        $em = $this->getDoctrine()->getManager();
        $actiBranch = $em->getRepository('CompanyBundle:ActivityBranch')->find($activityId);
        $form = $this->createForm(new ActivityBranchType(),$actiBranch);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->merge($actiBranch);
            $em->flush();

            return $this->redirectToRoute('no_create_activities_branchs');
        }

        return $this->render('CompanyBundle:Activity:update.html.twig', array('form' => $form->createView(),'id'=>$activityId,));

    }



    public function updateCodeNAFAction($codeNAFId,Request $request){
        $em = $this->getDoctrine()->getManager();
        $codeNAF = $em->getRepository('CompanyBundle:CodeNAF')->find($codeNAFId);
        $form = $this->createForm(new CodeNAFType(),$codeNAF);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->merge($codeNAF);
            $em->flush();

            return $this->redirectToRoute('no_show_all_code_naf');
        }

        return $this->render('CompanyBundle:NAF:update.html.twig', array('form' => $form->createView(),'id'=>$codeNAFId,));

    }

    public function updateLegalStatusAction($statusId,Request $request){
        $em = $this->getDoctrine()->getManager();
        $legalStatus = $em->getRepository('CompanyBundle:LegalStatus')->find($statusId);
        $form = $this->createForm(new LegalStatusType(),$legalStatus);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->merge($legalStatus);
            $em->flush();

            return $this->redirectToRoute('no_show_all_legal_status');
        }

        return $this->render('CompanyBundle:Status:update.html.twig', array('form' => $form->createView(),'id'=>$statusId,));
        
    }


    public function deleteActivityBranchAction($activityId,Request $request){
        $em = $this->getDoctrine()->getManager();
        $actiBranch = $em->getRepository('CompanyBundle:ActivityBranch')->find($activityId);
        if($actiBranch){
            $em->remove($actiBranch);
            $em->flush();
        }

        return $this->redirectToRoute('no_show_all_activities_branchs');

    }

    public function deleteCodeNAFAction($codeNAFId){
        $em = $this->getDoctrine()->getManager();
        $codeNAF = $em->getRepository('CompanyBundle:CodeNAF')->find($codeNAFId);

        if($codeNAF){
            $em->remove($codeNAF);
            $em->flush();
        }

        return $this->redirectToRoute('no_show_all_code_naf');
    }


    public function deleteLegalStatusAction($statusId){
        $em = $this->getDoctrine()->getManager();
        $legalStatus = $em->getRepository('CompanyBundle:LegalStatus')->find($statusId);
        if($legalStatus){
            $em->remove($legalStatus);
            $em->flush();
        }

        return $this->redirectToRoute('no_show_all_legal_status');
        
    }


    public function getActivitiesBranchsAction(){
        $em = $this->getDoctrine()->getManager();
        $actiBranchs = $em->getRepository('CompanyBundle:ActivityBranch')->findAll();

        $this->render('CompanyBundle:Activity:all.html.twig',array('actiBranchs' => $actiBranch,));

    }


    public function getAllLegalStatusAction(){
        $em = $this->getDoctrine()->getManager();
        $legalStatus = $em->getRepository('CompanyBundle:LegalStatus')->findAll();

        $this->render('CompanyBundle:Status:all.html.twig',array('legalStatus' => $legalStatus,));

    }

    public function getAllCodeNAFAction(){
        $em = $this->getDoctrine()->getManager();
        $codeNAFs = $em->getRepository('CompanyBundle:CodeNAF')->findAll();

        $this->render('CompanyBundle:NAF:all.html.twig',array('codesNAF' => $codesNAF,));

    }
    
}
