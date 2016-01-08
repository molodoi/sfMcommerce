<?php
namespace Ticme\FrontBundle\Services;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Security;

use Doctrine\ORM\EntityManager;

class GetReference
{
    public function __construct($securityContext, EntityManager $entityManager)
    {
        $this->securityContext = $securityContext;
        $this->em = $entityManager;
    }

    public function reference()
    {
        //On récupère la dernière commande validée
        $reference = $this->em->getRepository('TicmeBackBundle:Ordering')->findOneBy(array('validated' => 1), array('id' => 'DESC'),1,1);

        if (!$reference){   // si il n'y a pas de reference on est au début pas de facture on return 1
            return 1;
        }else{              //sinon on récupère la référence du dernier élément (commande) et on ajoute 1
            return $reference->getReference() +1;
        }
    }
}