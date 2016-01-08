<?php

namespace Ticme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BillingController extends Controller
{
    public function facturesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $facture = $em->getRepository('TicmeBackBundle:Ordering')->byFacture($this->getUser());

        return $this->render('TicmeFrontBundle:Order:facture.html.twig', array(
            'factures' => $facture,
        ));
    }

    public function facturesPDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $facture = $em->getRepository('TicmeBackBundle:Ordering')->findOneBy(
            array(
                'user' => $this->getUser(),
                'validated' => 1,
                'id' => $id,
            )

        );

        if(!$facture){
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('ticme_front_factures'));
        }

        //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
        $content = $this->container->get('setNewFacture')->facture($facture)->Output('facture_'.$facture->getReference().'.pdf', true);
        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename=facture_'.$facture->getReference().'.pdf');



        return $response;
    }
}
