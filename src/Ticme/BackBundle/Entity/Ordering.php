<?php

namespace Ticme\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ordering
 *
 * @ORM\Table(name="um_ordering")
 * @ORM\Entity(repositoryClass="Ticme\BackBundle\Repository\OrderingRepository")
 */
class Ordering
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validated", type="boolean")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="boolean",
     *     message="La valeur {{ value }} n\'est pas une valeur de type {{ type }}."
     * )
     */
    private $validated;

    /**
     * @var integer
     *
     * @ORM\Column(name="reference", type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur {{ value }} n\'est pas une valeur de type {{ type }}."
     * )
     */
    private $reference;

    /**
     * Cette propriété contient tous les éléments d'une commande
     * @var array
     *
     * @ORM\Column(name="content_order", type="array")
     */
    private $contorder;

    /**
     * @ORM\ManyToOne(targetEntity="Ticme\UserBundle\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * created Time/Date
     *
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * updated Time/Date
     *
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set validated
     *
     * @param boolean $validated
     *
     * @return Ordering
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;

        return $this;
    }

    /**
     * Get validated
     *
     * @return boolean
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Ordering
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set reference
     *
     * @param integer $reference
     *
     * @return Ordering
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return integer
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set products
     *
     * @param array $products
     *
     * @return Ordering
     */
    public function setContorder($contorder)
    {
        $this->contorder = $contorder;

        return $this;
    }

    /**
     * Get products
     *
     * @return array
     */
    public function getContorder()
    {
        return $this->contorder;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Ordering
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set user
     *
     * @param \Ticme\UserBundle\Entity\User $user
     *
     * @return Ordering
     */
    public function setUser(\Ticme\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ticme\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
