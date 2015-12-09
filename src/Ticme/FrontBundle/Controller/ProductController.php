<?php

namespace Ticme\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ticme\BackBundle\Entity\Category;
use Ticme\BackBundle\Entity\Product;

class ProductController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('TicmeBackBundle:Product')->findAll();

        if (null === $products) {
            throw new NotFoundHttpException("Aucuns produits.");
        }

        return $this->render('TicmeFrontBundle:Product:Partials/frontmenucategory.html.twig',array(
            'products' => $products
        ));
    }

    public function showAction(Product $product, Request $request)
    {
        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        return $this->render('TicmeFrontBundle:Product:show.html.twig',
            array(
                'product' => $product
            )
        );
    }
    public function showProductByCategoryIdAction(Category $category, Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $allProducts = $em->getRepository('TicmeBackBundle:Product')->byCategory($category);

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
