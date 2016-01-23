<?php
namespace Ticme\FrontBundle\Services;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GetInvoice
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function invoice($invoice)
    {
        $html = $this->container->get('templating')->render('TicmeFrontBundle:Order:invoicePDF.html.twig', array('facture' => $invoice));
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('Ticme');
        $html2pdf->pdf->SetTitle('Facture '.$invoice->getReference());
        $html2pdf->pdf->SetSubject('Facture Ticme');
        $html2pdf->pdf->SetKeywords('facture,ticme');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);

        return $html2pdf;
    }
}