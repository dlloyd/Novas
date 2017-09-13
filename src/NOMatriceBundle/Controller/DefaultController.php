<?php

namespace NOMatriceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NOMatriceBundle:Default:index.html.twig');
    }
}
