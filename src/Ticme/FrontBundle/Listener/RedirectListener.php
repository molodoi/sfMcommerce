<?php
namespace Ticme\FrontBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RedirectListener
{
    public function __construct(ContainerInterface $container, Session $session)
    {
        $this->session = $session;
        $this->router = $container->get('router');
        $this->securityContext = $container->get('security.context');
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        //On récupère la route courante
        $route = $event->getRequest()->attributes->get('_route');
        //On vérifie que la route correspond à la route livraison ou validation, Si oui :
        if ($route == 'ticme_front_cart_delivery' || $route == 'ticme_front_cart_validation') {
            //On vérifie que la variable de session panier éxiste
            if ($this->session->has('cart')) {
                //On compte le nombre d'éléments dans le panier, si il est égale à 0 on ne peut donc pas poursuivre la validation du panier
                //On redirige donc vers la route du panier qui affichera "Aucun articles dans votre panier"
                if (count($this->session->get('cart')) == 0) {
                    $event->setResponse(new RedirectResponse($this->router->generate('ticme_front_cart')));
                }
            }
            /* On vérifie que l'objet utilisateur existe en session (et donc identifié car s'il n'éxiste pas cela veut dire que le user n'est pas connecté)
             * sinon on le redirige vers le formulaire de connexion de FOS
             */
            if (!is_object($this->securityContext->getToken()->getUser())) {
                $this->session->getFlashBag()->add('notification','Vous devez vous identifier');
                /*
                 * L'objet RedirectResponse qui étend l'objet Response que nous connaissons bien, en lui ajoutant l'entête HTTP Location
                 * qu'il faut pour que notre navigateur comprenne qu'il s'agit d'une redirection.
                 */
                $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
            }
        }
    }
}