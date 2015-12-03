<?php
namespace Wa\BackBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ticme\BackBundle\Entity\Tva;

class LoadTvaData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /*for ($i = 1; $i <= 25; $i++){*/
            $tva = new Tva();
            $tva->setMulti('0.833');
            $tva->setTitle('TVA 20%');
            $tva->setValue('20');
            $tva->setCreatedAt(new \DateTime('NOW'));
            $tva->setUpdatedAt(new \DateTime('NOW'));
            $manager->persist($tva);
        /*}*/

        $manager->flush();
        $this->addReference('tva', $tva );
    }

    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }

}