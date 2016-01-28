<?php

namespace Ticme\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Ticme\BackBundle\Entity\Ordering;
use Ticme\BackBundle\Entity\Address;
use Ticme\BackBundle\Form\AddressType;

class CartController extends BaseController
{
    public function cartTopMenuAction(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('cart'))
            $articles = 0;
        else
            $articles = count($session->get('cart'));

        return $this->render('TicmeFrontBundle:Cart:Partials/cart.html.twig', array('articles' => $articles));
    }

    public function deleteAction($id, Request $request)
    {
        $session = $request->getSession();
        $cart = $session->get('cart');
        if (array_key_exists($id, $cart))
        {
            unset($cart[$id]);
            $session->set('cart',$cart);
            $this->get('session')->getFlashBag()->add('success','Article supprimé avec succès');
        }

        return $this->redirect($this->generateUrl('ticme_front_cart'));

    }

    public function addAction($id, Request $request)
    {
        //On récupère l'objet session
        $session = $request->getSession();
        //On récupère le panier existe en session
        if(!$session->has('cart'))$session->set('cart', array());
        //On récupère la variable du panier
        $cart = $session->get('cart');

        if(array_key_exists($id, $cart)){
            if($request->query->get('qt') != null) $cart[$id] = $request->query->get('qt');
        }else{
            if ($request->query->get('qt') != null)
                $cart[$id] = $request->query->get('qt');
            else
                $cart[$id] = 1;

            $this->get('session')->getFlashBag()->add('success','Article ajouté avec succès');
        }

        $session->set('cart',$cart);

        return $this->redirect($this->generateUrl('ticme_front_cart'));
    }

    public function cartAction(Request $request)
    {
        $session = $request->getSession();
        if (!$session->has('cart')) $session->set('cart', array());

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('TicmeBackBundle:Product')->findArray(array_keys($session->get('cart')));



        return $this->render('TicmeFrontBundle:Cart:cart.html.twig', array('products' => $products,
            'cart' => $session->get('cart')));
    }

    /**
     * Page livraison Indiquez une addresse de livraison et de facturation.
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deliveryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //On récupère l'utilisateur courant pour le lier à nos adresses
        $user = $this->container->get('security.context')->getToken()->getUser();

        //On instancie un objet Adress pour créer le formulaire
        $address = new Address();
        $form = $this->createForm(new AddressType($em), $address);

        $form->handleRequest($request);

        if ($form->isValid()) {
            //On lie le user à l'adresse
            $address->setUser($user);
            $em->persist($address);
            $em->flush();

            return $this->redirect($this->generateUrl('ticme_front_cart_delivery'));
        }

        return $this->render('TicmeFrontBundle:Cart:delivery.html.twig',
            array(
                'user' => $user,
                'form' => $form->createView()
            )
        );
    }


    /**
     * Page Validation étape qui suit l'addresse de livraison
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function validationAction(Request $request)
    {
        if ($request->isMethod('POST')){
            $this->setDeliveryOnSession($request);
        }

        $em = $this->getDoctrine()->getManager();
        $prepareOrder = $this->forward('TicmeFrontBundle:Ordering:prepareOrder');
        $order = $em->getRepository('TicmeBackBundle:Ordering')->find($prepareOrder->getContent());

        return $this->render('TicmeFrontBundle:Cart:validation.html.twig', array('order' => $order));

    }


    public function setDeliveryOnSession(Request $request)
    {
        $session = $request->getSession();

        //Même principe que le panier

        //On vérifie que la session adresse existe si non on la créé sinon on la récupère
        if (!$session->has('address')){
            $session->set('address',array());
        }else{
            $address = $session->get('address');
        }

        //on récupère la valeur des addresses de livraison et facturation qu'on stock dans notre tableau de session
        if ($request->request->get('delivery') != null && $request->request->get('billing') != null)
        {
            $address['delivery'] = $request->request->get('delivery');
            $address['billing'] = $request->request->get('billing');
        } else { //Sinon si les addresses son vides l'utilsateur on redirige vers la
            return $this->redirect($this->generateUrl('ticme_front_cart_validation'));
        }

        //on stocke notre tableau en session
        $session->set('address',$address);
        return $this->redirect($this->generateUrl('ticme_front_cart_validation'));
    }

    public function deleteAddressAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TicmeBackBundle:Address')->find($id);

        if ($this->container->get('security.context')->getToken()->getUser() != $entity->getUser() || !$entity)
            return $this->redirect ($this->generateUrl ('ticme_front_cart_delivery'));

        $em->remove($entity);
        $em->flush();

        return $this->redirect ($this->generateUrl ('ticme_front_cart_delivery'));
    }
}
