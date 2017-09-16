<?php

namespace NOThreatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use NOThreatBundle\Entity\ThreatFamily;
use NOThreatBundle\Entity\ThreatSubFamily;
use NOThreatBundle\Entity\EventThreat;
use NOThreatBundle\Form\ThreatFamilyType;
use NOThreatBundle\Form\ThreatSubFamilyType;
use NOThreatBundle\Form\EventThreatType;

class DefaultController extends Controller
{
    

    public function createThreatFamilyAction(Request $request){
    	$em = $this->getDoctrine()->getManager();
		$fams = $em->getRepository('NOThreatBundle:ThreatFamily')->findAll();
		$fam = new ThreatFamily();
        $form = $this->createForm(new ThreatFamilyType(),$fam);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            
            $em->persist($fam);
            $em->flush();

            return $this->redirectToRoute('no_create_threat_family');
        }

        return $this->render('NOThreatBundle:Family:create.html.twig', array('form' => $form->createView(),'fams'=> $fams,));

    }

    public function createThreatSubFamilyAction(Request $request){
    	$em = $this->getDoctrine()->getManager();
		$subFams = $em->getRepository('NOThreatBundle:ThreatSubFamily')->findAll();
		$subFam = new ThreatSubFamily();
        $form = $this->createForm(new ThreatSubFamilyType(),$subFam);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            
            $em->persist($subFam);
            $em->flush();

            return $this->redirectToRoute('no_create_threat_sub_family');
        }

        return $this->render('NOThreatBundle:SubFamily:create.html.twig', array('form' => $form->createView(),'subFams'=> $subFams,));
    	
    }


    public function createEventThreatAction(Request $request){
    	$em = $this->getDoctrine()->getManager();
		$events = $em->getRepository('NOThreatBundle:EventThreat')->findAll();
		$event = new EventThreat();
        $form = $this->createForm(new EventThreatType(),$event);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('no_create_event_threat');
        }

        return $this->render('NOThreatBundle:Event:create.html.twig', array('form' => $form->createView(),'events'=> $events,));
    	
    }


    public function updateThreatFamilyAction(Request $request,$famId){
        $em = $this->getDoctrine()->getManager();
        $fam = $em->getRepository('NOThreatBundle:ThreatFamily')->find($famId);
        $form = $this->createForm(new ThreatFamilyType(),$fam);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            
            $em->persist($fam);
            $em->flush();

            return $this->redirectToRoute('no_create_threat_family');
        }

        return $this->render('NOThreatBundle:Family:update.html.twig', array('form' => $form->createView(),'famId'=> $famId,));
    	
    }

    public function updateThreatSubFamilyAction(Request $request,$subFamId){
        $em = $this->getDoctrine()->getManager();
        $subFam = $em->getRepository('NOThreatBundle:ThreatSubFamily')->find($subFamId);
        $form = $this->createForm(new ThreatSubFamilyType(),$subFam);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            
            $em->persist($subFam);
            $em->flush();

            return $this->redirectToRoute('no_create_threat_family');
        }

        return $this->render('NOThreatBundle:SubFamily:update.html.twig', array('form' => $form->createView(),'subFamId'=> $subFamId));

    	
    }

    public function updateEventThreatAction(Request $request,$eventId){
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('NOThreatBundle:EventThreat')->find($eventId);
        $form = $this->createForm(new EventThreatType(),$event);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('no_create_threat_family');
        }

        return $this->render('NOThreatBundle:Event:update.html.twig', array('form' => $form->createView(),'eventId'=> $eventId,));

    	
    }


    public function deleteThreatFamilyAction($famId){
    	$em = $this->getDoctrine()->getManager();
        $fam = $em->getRepository('NOThreatBundle:ThreatFamily')->find($famId);

        if($fam){
            $em->remove($fam);
            $em->flush();
        }
        return $this->redirectToRoute('no_create_threat_family');
    }

    public function deleteThreatSubFamilyAction($subFamId){
    	$em = $this->getDoctrine()->getManager();
        $subFam = $em->getRepository('NOThreatBundle:ThreatSubFamily')->find($subFamId);

        if($subFam){
            $em->remove($subFam);
            $em->flush();
        }
        return $this->redirectToRoute('no_create_threat_family');
    }

   
}
