<?php

namespace NOUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NOUserBundle:Default:index.html.twig');
    }
}
