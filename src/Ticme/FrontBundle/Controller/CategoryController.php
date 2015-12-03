<?php

namespace Ticme\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ticme\BackBundle\Entity\Category;
use Ticme\BackBundle\Form\CategoryType;

class CategoryController extends Controller
{
    public function categorieMenuAction()
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('TicmeBackBundle:Category');

        $categories = $repository->findAll();

        if (null === $categories) {
            throw new NotFoundHttpException("Aucuns produits.");
        }

        return $this->render('TicmeFrontBundle:Category/Slots:frontmenucategory.html.twig',array(
            'categories' => $categories
        ));
    }



}
