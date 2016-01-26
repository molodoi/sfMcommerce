<?php

namespace Ticme\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tva
 *
 * @ORM\Table(name="um_tva")
 * @ORM\Entity(repositoryClass="Ticme\BackBundle\Repository\TvaRepository")
 */
class Tva
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=125)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="multi", type="float")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="float",
     *     message="La valeur {{ value }} n\'est pas une valeur de type {{ type }}."
     * )
     */
    private $multi;

    /**
     * @var float
     *
     * @ORM\Column(name="value", type="float")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="float",
     *     message="La valeur {{ value }} n\'est pas une valeur de type {{ type }}."
     * )
     */
    private $value;

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
     * Set title
     *
     * @param string $title
     *
     * @return Tva
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set multi
     *
     * @param float $multi
     *
     * @return Tva
     */
    public function setMulti($multi)
    {
        $this->multi = $multi;

        return $this;
    }

    /**
     * Get multi
     *
     * @return float
     */
    public function getMulti()
    {
        return $this->multi;
    }

    /**
     * Set value
     *
     * @param float $value
     *
     * @return Tva
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Tva
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Tva
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

    public function __toString(){
        return $this->getTitle();
    }
}
