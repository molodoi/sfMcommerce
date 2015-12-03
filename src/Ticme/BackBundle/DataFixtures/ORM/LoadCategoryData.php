<?php
namespace Wa\BackBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Ticme\BackBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $cat = new Category();
        $cat->setTitle('Catégorie 0');
        $cat->setDescription('Description Catégorie 0');
        $manager->persist($cat);

        for ($i = 1; $i <= 25; $i++){
            $category = new Category();
            $category->setTitle('Catégorie '.$i);
            $category->setDescription('Description Catégorie '.$i);
            $category->setCreatedAt(new \DateTime('NOW'));
            $category->setUpdatedAt(new \DateTime('NOW'));
            $manager->persist($category);
        }

        $manager->flush();
        $this->addReference('cat', $cat );
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }

}