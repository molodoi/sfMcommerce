<?php

namespace Ticme\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $allProducts = $em->getRepository('TicmeBackBundle:Product')->findAll();

        if (null === $allProducts) {
            throw new NotFoundHttpException("Aucuns produits.");
        }

        if(empty($page)){
            $page = $request->query->getInt('page', 1);
        }

        $paginator = $this->get('knp_paginator');
        $products = $paginator->paginate(
            $allProducts,
            $page,
            5
        );
        return $this->render('TicmeFrontBundle:Default:index.html.twig',
            array(
                'products' => $products,
                'page' => $page
            )
        );
    }
}
