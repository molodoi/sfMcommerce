<?php

namespace Ticme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ticme\UserBundle\Entity\User;
use Ticme\UserBundle\Form\Type\UserType;

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

    public function editAction(User $user, Request $request)
    {
        if (!$user) {
            throw new NotFoundHttpException("Le user id n'existe pas.");
        }

        $formUser = $this->createForm(new UserType(), $user);

        $formUser->handleRequest($request);
        $roles = $formUser['roleList'];

        $formUser->get('password')->getData();



        if($formUser->isValid()){

            $em = $this->getDoctrine()->getManager();

            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);

            $password = $formUser->get('password')->getData();

            $user->setPassword($encoder->encodePassword($password, $user->getSalt()));

            $user->addRole($formUser->get('roleList')->getData());

            $em->persist($user);



            $em->flush();

            return $this->redirectToRoute('ticme_back_user_list');

        }

        return $this->render('TicmeUserBundle:User:edit.html.twig',
            array(
                'formUser' => $formUser->createView()
            )
        );
    }
}
