<?php
namespace Ticme\FrontBundle\Twig\Extension;


class TvaExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('tva', array($this, 'calculTva')),
        );
    }

    public function calculTva($prixHt, $tva)
    {
        return round( $prixHt / $tva, 2);
    }

    public function getName()
    {
        return 'tva_extension';
    }


}