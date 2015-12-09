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
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('TicmeBackBundle:Category')->findCategoryWithActiveAndWithProduct();

        if (null === $categories) {
            throw new NotFoundHttpException("Aucuns produits.");
        }

        return $this->render('TicmeFrontBundle:Category:Partials/frontmenucategory.html.twig',array(
            'categories' => $categories
        ));
    }

    public function showAction(Category $category, Request $request)
    {
        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return $this->render('TicmeFrontBundle:Category:show.html.twig',
            array(
                'category' => $category
            )
        );
    }
    public function showByProductsAction(Category $category, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('TicmeBackBundle:Category')->findAll();

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        return $this->render('TicmeFrontBundle:Category:show.html.twig',
            array(
                'category' => $category
            )
        );
    }

}
