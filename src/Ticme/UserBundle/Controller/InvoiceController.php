<?php

namespace Ticme\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class InvoiceController extends Controller
{
    public function invoicesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invoices = $em->getRepository('TicmeBackBundle:Ordering')->byInvoice($this->getUser());

        return $this->render('TicmeFrontBundle:Order:invoice.html.twig', array(
            'invoices' => $invoices,
        ));
    }

    public function invoicePDFAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $order = $em->getRepository('TicmeBackBundle:Ordering')->findOneBy(
            array(
                'user' => $this->getUser(),
                'validated' => 1,
                'id' => $id,
            )

        );

        if(!$order){
            $this->get('session')->getFlashBag()->add('error', 'Une erreur est survenue');
            return $this->redirect($this->generateUrl('ticme_front_invoices'));
        }

        //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
        $content = $this->container->get('setNewInvoice')->invoice($order)->Output('facture_'.$order->getReference().'.pdf', true);

        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-disposition', 'filename=facture_'.$order->getReference().'.pdf');
        return $response;
    }
}
