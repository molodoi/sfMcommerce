<?php

namespace Ticme\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TicmeBackBundle:Default:index.html.twig');
    }
}
