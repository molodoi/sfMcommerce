<?php
namespace Wa\BackBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ticme\BackBundle\Entity\Product;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 25; $i++){

            $product = new Product();

            $product->setTitle('Produit'.$i);
            $product->setDescription('Description du produit'.$i);
            $product->setPriceHt('5');
            $product->setTva();
            $product->setCategory($this->getReference('cat'));
            $product->setTva($this->getReference('tva'));
            $product->setUser($this->getReference('user'));
            $product->setAvailable(1);
            $product->setCreatedAt(new \DateTime('NOW'));
            $product->setUpdatedAt(new \DateTime('NOW'));

            $manager->persist($product);
        }

        $manager->flush();

    }

    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }

}