<?php

namespace Ticme\FrontBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Ticme\BackBundle\Entity\User;

class AddressController extends BaseController
{
    public function cityAction(Request $request, $zipcode){
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $cityZipcode = $em->getRepository('TicmeUserBundle:City')->findBy(
                array('cityZipcode' => $zipcode)
            );

            if ($cityZipcode) {
                $cities = array();
                foreach($cityZipcode as $city) {
                    $cities[] = $city->getCityName();
                }
            } else {
                $cities = null;
            }

            $response = new JsonResponse();
            return $response->setData(array('cities' => $cities));
        } else {
            throw new NotFoundHttpException("Page not found");
        }
    }

    public function showCurrentUserAddressAction(){
        return $this->render('TicmeFrontBundle:Address:address.html.twig',
            array(
                'user' => $this->getUser()
            )
        );
    }
}
