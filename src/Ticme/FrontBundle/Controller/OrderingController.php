<?php

namespace Ticme\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Ticme\BackBundle\Entity\Ordering;

class OrderingController extends BaseController
{

    /**
     * Retourne tous les éléments d'une commande dans un array sérialisé $order avec toutes les données que l'ont aura besoin correctement rangées
     * @param Request $request
     * @return array $order
     */
    public function facture(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $generator = $this->container->get('security.secure_random');
        $session = $request->getSession();
        $address = $session->get('address');
        $cart = $session->get('cart');
        $order = array();
        $totalHT = 0;
        $totalTVA = 0;

        $billing = $em->getRepository('TicmeBackBundle:Address')->find($address['billing']);
        $delivery = $em->getRepository('TicmeBackBundle:Address')->find($address['delivery']);
        $products = $em->getRepository('TicmeBackBundle:Product')->findArray(array_keys($session->get('cart')));

        foreach($products as $product)
        {
            //prix HT x la quantité
            $prixHT = ($product->getPriceHt() * $cart[$product->getId()]);
            //prix TTC x la quantité / par le coef multiplicateur de tva
            $prixTTC = ($product->getPriceHt() * $cart[$product->getId()] / $product->getTva()->getMulti());

            $totalHT += $prixHT;

            //On calcul la tva soit on crée soit on ajoute selon la valeur du taux
            if (!isset($order['tva']['%'.$product->getTva()->getValue()])){
                $order['tva']['%'.$product->getTva()->getValue()] = round($prixTTC - $prixHT,2);
            }else{
                $order['tva']['%'.$product->getTva()->getValue()] += round($prixTTC - $prixHT,2);
            }

            $totalTVA += round($prixTTC - $prixHT,2);

            $order['product'][$product->getId()] = array(
                'reference' => $product->getTitle(),
                'quantite' => $cart[$product->getId()],
                'prixHT' => round($product->getPriceHt(),2),
                'prixTTC' => round($product->getPriceHt() / $product->getTva()->getMulti(),2)
            );
        }

        $order['delivery'] = array(
            'lastname' => $delivery->getLastname(),
            'name' => $delivery->getName(),
            'phone' => $delivery->getPhone(),
            'address' => $delivery->getAddress(),
            'zipcode' => $delivery->getZipcode(),
            'city' => $delivery->getCity(),
            'country' => $delivery->getCountry(),
            'complement' => $delivery->getComplement()
        );

        $order['billing'] = array(
            'lastname' => $billing->getLastname(),
            'name' => $billing->getName(),
            'phone' => $billing->getPhone(),
            'address' => $billing->getAddress(),
            'zipcode' => $billing->getZipcode(),
            'city' => $billing->getCity(),
            'country' => $billing->getCountry(),
            'complement' => $billing->getComplement()
        );

        $order['prixHT'] = round($totalHT,2);
        $order['prixTTC'] = round($totalHT + $totalTVA,2);
        $order['token'] = bin2hex($generator->nextBytes(20));

        return $order;
    }

    /**
     * Methode de préparation de la commande On récupère toutes les infos et on les stockes en bdd
     * @param Request $request
     * @return Response
     */
    public function prepareOrderAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();

        //die(dump($session->has('order')));
        //Pour éviter de stocker 2 fois la commande en bdd on va la stocker en session pour permettre les aller/retour
        //On vérifie si la variable de session commande existe sinon on instancie un objet commande


        if (!$session->has('order')){
            $order = new Ordering();
        }else{
            //Si elle existe on récupère la commande en base depuis la variable commande en session
            $order = $em->getRepository('TicmeBackBundle:Ordering')->find($session->get('order'));
        }

        $order->setCreatedAt(new \DateTime());
        $order->setUpdatedAt(new \DateTime());
        $order->setUser($this->container->get('security.context')->getToken()->getUser());
        $order->setValidated(0);
        $order->setReference(0);
        $order->setContorder($this->facture($request));

        //Si la session commande n'existe pas alors on crée la session et on persist pour créer un nouvel enregistrement en bdd
        if (!$session->has('order')) {
            $em->persist($order);
            $session->set('order',$order);
        }

        //Sinon on flush qui mettra à jour ou enregistrera une nouvelle commande
        $em->flush();
        return new Response($order->getId());
    }

    /*
     * Cette methode remplace l'api banque.
     */
    public function validationOrderAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $order = $em->getRepository('TicmeBackBundle:Ordering')->find($id);

        if (!$order || $order->getValidated() == 1){
            throw $this->createNotFoundException('La commande n\'existe pas');
        }

        $order->setValidated(false);
        $order->setReference($this->container->get('setNewReference')->reference()); //Service
        //$order->setReference(1); //Service
        $em->flush();

        $session = $this->container->get('session');
        $session->remove('address');
        $session->remove('cart');
        $session->remove('order');

        //Ici le mail de validation
        $message = \Swift_Message::newInstance()
            ->setSubject('Validation de votre commande')
            ->setFrom(array('contact@ticme.fr' => "Ticme"))
            ->setTo($order->getUser()->getEmailCanonical())
            ->setCharset('utf-8')
            ->setContentType('text/html')
            ->setBody($this->renderView('TicmeFrontBundle:Mail:validationCommande.html.twig',array('user' => $order->getUser())));

        $this->get('mailer')->send($message);

        $this->get('session')->getFlashBag()->add('success','Votre commande est validé avec succès');
        return $this->redirect($this->generateUrl('ticme_front_homepage'));
    }

}