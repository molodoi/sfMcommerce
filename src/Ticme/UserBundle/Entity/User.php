<?php


namespace Ticme\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="um_user")
 * @ORM\Entity(repositoryClass="Ticme\UserBundle\Repository\UserRepository")
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
     * @ORM\OneToMany(targetEntity="Ticme\BackBundle\Entity\Product", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $products;

    /**
     * @ORM\OneToMany(targetEntity="Ticme\BackBundle\Entity\Ordering", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity="Ticme\BackBundle\Entity\Address", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $address;

    public function __construct()
    {
        parent::__construct();
        $this->products = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->address = new ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \Ticme\BackBundle\Entity\Product $product
     *
     * @return User
     */
    public function addProduct(\Ticme\BackBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \Ticme\BackBundle\Entity\Product $product
     */
    public function removeProduct(\Ticme\BackBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add address
     *
     * @param \Ticme\BackBundle\Entity\Address $address
     *
     * @return User
     */
    public function addAddress(\Ticme\BackBundle\Entity\Address $address)
    {
        $this->address[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Ticme\BackBundle\Entity\Address $address
     */
    public function removeAddress(\Ticme\BackBundle\Entity\Address $address)
    {
        $this->address->removeElement($address);
    }

    /**
     * Get address
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add order
     *
     * @param \Ticme\BackBundle\Entity\Ordering $order
     *
     * @return User
     */
    public function addOrder(\Ticme\BackBundle\Entity\Ordering $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Ticme\BackBundle\Entity\Ordering $order
     */
    public function removeOrder(\Ticme\BackBundle\Entity\Ordering $order)
    {
        $this->orders->removeElement($order);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
