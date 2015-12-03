<?php

namespace Ticme\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ticme\BackBundle\Entity\Category;
use Ticme\BackBundle\Form\CategoryType;

class CategoryController extends Controller
{
    public function indexAction(Request $request, $page)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('TicmeBackBundle:Category');

        $allCategories = $repository->findAll();

        if (null === $allCategories) {
            throw new NotFoundHttpException("Aucuns produits.");
        }

        if(empty($page)){
            $page = $request->query->getInt('page', 1);
        }

        $paginator = $this->get('knp_paginator');
        $categories = $paginator->paginate(
            $allCategories,
            $page,
            12
        );

        return $this->render('TicmeBackBundle:Category:index.html.twig',array(
            'categories' => $categories
        ));
    }

    public function listAction(Request $request, $page)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('TicmeBackBundle:Category');

        $allCategories = $repository->findAll();

        if (null === $allCategories) {
            throw new NotFoundHttpException("Aucuns produits.");
        }

        if(empty($page)){
            $page = $request->query->getInt('page', 1);
        }

        $paginator = $this->get('knp_paginator');
        $categories = $paginator->paginate(
            $allCategories,
            $page,
            12
        );

        return $this->render('TicmeBackBundle:Category:list.html.twig',array(
            'categories' => $categories
        ));
    }

    public function createAction(Request $request)
    {
        $category = new Category();

        //die(dump($category));

        $formCategory = $this->createForm(new CategoryType(), $category);

        $formCategory->handleRequest($request);

        if($formCategory->isValid()){

            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            /*die(dump($category));*/
            $em->flush();

            $session = $request->getSession();

            $session->getFlashBag()->add('info', 'Catégorie ajouté');

            return $this->redirectToRoute('ticme_back_category_list');
        }

        return $this->render('TicmeBackBundle:Category:create.html.twig',
                array(
                    'formCategory' => $formCategory->createView(),
                )
            );
    }

    public function editAction(Category $category, Request $request)
    {
        $formCategory = $this->createForm(new CategoryType(), $category);

        $formCategory->handleRequest($request);

        if($formCategory->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('info', $category->getTitle(). ' modifié');

            return $this->redirectToRoute('ticme_back_category_list');

        }

        return $this->render('TicmeBackBundle:Category:edit.html.twig',
            array(
                'formCategory' => $formCategory->createView(),
                'categorie' => $category
            )
        );
    }

    public function showAction(Category $category, Request $request)
    {
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        return $this->render('TicmeBackBundle:Category:show.html.twig',
            array(
                'categorie' => $category
            )
        );
    }

    public function deleteAction(Category $category, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $title = $category->getTitle();
        $em->remove($category);
        $em->flush();
        $session = $request->getSession();
        $session->getFlashBag()->add('info', $title. ' supprimé');

        return $this->redirectToRoute('ticme_back_category_list');
    }

}
