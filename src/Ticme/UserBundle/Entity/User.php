<?php


namespace Ticme\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="um_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Ticme\BackBundle\Entity\Product", mappedBy="user")
     */
    protected $products;

    /**
     * @ORM\OneToMany(targetEntity="Ticme\BackBundle\Entity\Address", mappedBy="user")
     */
    protected $address;


    public function __construct()
    {
        parent::__construct();
        $this->products = new ArrayCollection();
    }
}