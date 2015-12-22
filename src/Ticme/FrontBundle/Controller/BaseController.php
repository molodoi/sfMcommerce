<?php
namespace Ticme\FrontBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller{

    public function breadcrumbs($items)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Accueil", $this->generateUrl("ticme_front_homepage"));

        foreach($items as $label => $url)
        {
            if (!empty($url))
            {
                $breadcrumbs->addItem($label, $url);
            }
            else
            {
                $breadcrumbs->addItem($label);
            }
        }

    }
}