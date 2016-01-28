<?php

namespace Ticme\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ticme\BackBundle\Entity\Product;
use Ticme\BackBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends Controller
{
    public function indexAction(Request $request, $page)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('TicmeBackBundle:Product');

        $allProducts = $repository->findAll();

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
            12
        );

        return $this->render('TicmeBackBundle:Product:index.html.twig',array(
            'products' => $products
        ));
    }

    public function listAction(Request $request, $page)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('TicmeBackBundle:Product');

        $allProducts = $repository->findAll();

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
            12
        );

        return $this->render('TicmeBackBundle:Product:list.html.twig',array(
            'products' => $products
        ));
    }

    public function createAction(Request $request)
    {
        $product = new Product();

        $formProduct = $this->createForm(new ProductType(), $product);

        $formProduct->handleRequest($request);

        if($formProduct->isValid()){

            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            $session = $request->getSession();

            $session->getFlashBag()->add('info', 'Produit ajouté');

            return $this->redirectToRoute('ticme_back_product_list');
        }

        return $this->render('TicmeBackBundle:Product:create.html.twig',
            array(
                'formProduct' => $formProduct->createView(),
            )
        );
    }

    public function editAction(Product $product, Request $request)
    {
        $formProduct = $this->createForm(new ProductType(), $product);

        $formProduct->handleRequest($request);

        if($formProduct->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('info', $product->getTitle(). ' modifié');

            return $this->redirectToRoute('ticme_back_product_list');

        }

        return $this->render('TicmeBackBundle:Product:edit.html.twig',
            array(
                'formProduct' => $formProduct->createView(),
                'product' => $product
            )
        );
    }

    public function showAction(Product $product, Request $request)
    {
        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        return $this->render('TicmeBackBundle:Product:show.html.twig',
            array(
                'product' => $product
            )
        );
    }

    public function deleteAction(Product $product, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $title = $product->getTitle();
        $em->remove($product);
        $em->flush();

        if($request->isXmlHttpRequest()){
            return new JsonResponse(array('success' => true));
        }

        $session = $request->getSession();
        $session->getFlashBag()->add('info', $title. ' supprimé');

        return $this->redirectToRoute('ticme_back_product_list');
    }

}
