<?php
namespace Ticme\FrontBundle\Services;

use Symfony\Component\Security\Core\SecurityContextInterface;

class GetReference
{
    public function __construct($securityContext, $entityManager)
    {
        $this->securityContext = $securityContext;
        $this->em = $entityManager;
    }

    public function reference()
    {
        /*$reference = $this->em->getRepository('TicmeBackBundle:Ordering')->findOneBy(array('validated' => 1), array('id' => 'DESC'),1,1);

        if (!$reference)
            return 1;
        else
            return $reference->getReference() +1;*/
    }
}