<?php

namespace NOMatriceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use NOMatriceBundle\Form\MatriceType;
use NOMatriceBundle\Form\EcologicalMatriceType;
use NOMatriceBundle\Form\PoliticalMatriceType;
use NOMatriceBundle\Form\EconomicalMatriceType;
use NOMatriceBundle\Form\SocioCulturalMatriceType;
use NOMatriceBundle\Form\LegalMatriceType;
use NOMatriceBundle\Form\TechnologicalMatriceType;
use NOMatriceBundle\Entity\Matrice;
use NOMatriceBundle\Entity\TechnologicalMatrice;
use NOMatriceBundle\Entity\EconomicalMatrice;
use NOMatriceBundle\Entity\EcologicalMatrice;
use NOMatriceBundle\Entity\SocioCulturalMatrice;
use NOMatriceBundle\Entity\LegalMatrice;
use NOMatriceBundle\Entity\PoliticalMatrice;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	$em = $this->getDoctrine()->getManager() ;
    	$company = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId())->getCompany();

    	$form = $this->createForm(new MatriceType(),$company->getMatrice());

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('no_homepage');
        }

        return $this->render('NOMatriceBundle:Default:index.html.twig', array('form' => $form->createView(),'route'=>'no_company_matrice',));
    }


    public function ecologicalAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $company = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId())->getCompany();

        if($company->getMatrice()->getLegalMatrice()){
            $mat = $company->getMatrice()->getEcologicalMatrice();
        }
        else{
            $mat = new EcologicalMatrice();
        }

        $form = $this->createForm(new EcologicalMatriceType(),$mat);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $company->getMatrice()->setEcologicalMatrice($mat);
            $em->merge($company);
            $em->flush();

            return $this->redirectToRoute('no_homepage');
        }

        return $this->render('NOMatriceBundle:Default:index.html.twig', array('form' => $form->createView(),
                                                                              'route'=>'no_company_matrice_ecological',));
    }

    public function economicalAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $company = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId())->getCompany();

        if($company->getMatrice()->getLegalMatrice()){
            $mat = $company->getMatrice()->getEconomicalMatrice();
        }
        else{
            $mat = new EconomicalMatrice();
        }

        $form = $this->createForm(new EconomicalMatriceType(),$mat);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $company->getMatrice()->setEconomicalMatrice($mat);
            $em->merge($company);
            $em->flush();

            return $this->redirectToRoute('no_homepage');
        }

        return $this->render('NOMatriceBundle:Default:index.html.twig', array('form' => $form->createView(),
                                                                              'route'=>'no_company_matrice_economical',));
    }

    public function legalAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $company = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId())->getCompany();

        if($company->getMatrice()->getLegalMatrice()){
            $mat = $company->getMatrice()->getLegalMatrice();
        }
        else{
            $mat = new LegalMatrice();
        }

        $form = $this->createForm(new LegalMatriceType(),$mat);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $company->getMatrice()->setLegalMatrice($mat);
            $em->merge($company);
            $em->flush();

            return $this->redirectToRoute('no_homepage');
        }

        return $this->render('NOMatriceBundle:Default:index.html.twig', array('form' => $form->createView(),
                                                                              'route'=>'no_company_matrice_legal',));
        
    }

    public function politicalAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $company = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId())->getCompany();

        if($company->getMatrice()->getPoliticalMatrice()){
            $mat = $company->getMatrice()->getPoliticalMatrice();
        }
        else{
            $mat = new PoliticalMatrice();
        }

        $form = $this->createForm(new PoliticalMatriceType(),$mat);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $company->getMatrice()->setPoliticalMatrice($mat);
            $em->merge($company);
            $em->flush();

            return $this->redirectToRoute('no_homepage');
        }

        return $this->render('NOMatriceBundle:Default:index.html.twig', array('form' => $form->createView(),
                                                                              'route'=>'no_company_matrice_political',));
    }

    public function socioCulturalAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $company = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId())->getCompany();

        if($company->getMatrice()->getSocioCulturalMatrice()){
            $mat = $company->getMatrice()->getSocioCulturalMatrice();
        }
        else{
            $mat = new SocioCulturalMatrice();
        }

        $form = $this->createForm(new SocioCulturalMatriceType(),$mat);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();

            $company->getMatrice()->setSocioCulturalMatrice($mat);
            $em->merge($company);
            $em->flush();

            return $this->redirectToRoute('no_homepage');
        }

        return $this->render('NOMatriceBundle:Default:index.html.twig', array('form' => $form->createView(),
                                                                              'route'=>'no_company_matrice_sociocultural',));
        
    }

    public function technologicalAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $company = $em->getRepository('NOUserBundle:User')->find($this->getUser()->getId())->getCompany();

        if($company->getMatrice()->getTechnologicalMatrice()){
            $mat = $company->getMatrice()->getTechnologicalMatrice();
        }
        else{
            $mat = new TechnologicalMatrice();
        }
        

        $form = $this->createForm(new TechnologicalMatriceType(),$mat);

        if($request->getMethod() == 'POST' && $form->HandleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $company->getMatrice()->setTechnologicalMatrice($mat);
            $em->merge($company);
            $em->flush();

            return $this->redirectToRoute('no_homepage');
        }

        return $this->render('NOMatriceBundle:Default:index.html.twig', array('form' => $form->createView(),
                                                                              'route'=>'no_company_matrice_technological',));
        
    }
}
