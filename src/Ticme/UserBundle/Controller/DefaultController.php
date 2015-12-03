<?php

namespace Ticme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TicmeUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
