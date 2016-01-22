<?php

namespace Ticme\FrontBundle\Controller;

use Ticme\BackBundle\Entity\User;
use Ticme\BackBundle\Entity\Address;

class AddressController extends BaseController
{
    public function showCurrentUserAddressAction(){



        return $this->render('TicmeFrontBundle:Address:address.html.twig',
            array(
                'user' => $this->getUser()
            )
        );
    }
}
