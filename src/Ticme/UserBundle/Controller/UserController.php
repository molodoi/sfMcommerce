<?php

namespace Ticme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function listAction(Request $request, $page)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('TicmeUserBundle:User');

        $allUsers = $repository->findAll();

        if (null === $allUsers) {
            throw new NotFoundHttpException("Aucuns users.");
        }

        if(empty($page)){
            $page = $request->query->getInt('page', 1);
        }

        $paginator = $this->get('knp_paginator');
        $users = $paginator->paginate(
            $allUsers,
            $page,
            12
        );

        return $this->render('TicmeUserBundle:User:list.html.twig',array(
            'users' => $users
        ));
    }
}
