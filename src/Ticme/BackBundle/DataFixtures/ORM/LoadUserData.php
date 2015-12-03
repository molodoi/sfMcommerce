<?php
namespace Wa\BackBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ticme\UserBundle\Entity\User;

class LoadAliceFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setUsername('matt');
        $user->setUsernameCanonical('matt');
        $user->setUsername('admin');
        $user->setEmail('admin@admin.fr');
        $user->setEnabled(1);
        // the 'security.password_encoder' service requires Symfony 2.6 or higher
        $encoder = $this->container->get('security.encoder_factory')->getEncoder(new User());


        $password = $encoder->encodePassword($user, $user->getSalt());
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();

        $this->addReference('user', $user );

    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }

}