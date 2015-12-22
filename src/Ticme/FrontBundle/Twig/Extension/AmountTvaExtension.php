<?php
namespace Ticme\FrontBundle\Twig\Extension;

class AmountTvaExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('amountTva', array($this,'amountTva')));
    }

    function amountTva($priceHT,$tva)
    {
        return round((($priceHT / $tva) - $priceHT),2);
    }

    public function getName()
    {
        return 'amount_tva_extension';
    }
}