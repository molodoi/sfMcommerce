<?php

namespace Ticme\BackBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ticme\BackBundle\Validator\Constraints as MyAssert;

/**
 * Product
 *
 * @ORM\Table(name="um_product")
 * @ORM\Entity(repositoryClass="Ticme\BackBundle\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Product
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
     * @ORM\Column(name="title", type="string", length=165)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @MyAssert\CheckUrl()
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="priceHt", type="float")
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="float",
     *     message="La valeur {{ value }} n\'est pas une valeur de type {{ type }}."
     * )
     */
    private $priceHt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="available", type="boolean")
     */
    private $available = true;

    /**
     * @ORM\ManyToOne(targetEntity="Ticme\BackBundle\Entity\Tva", cascade={"persist"})
     * @ORM\JoinColumn(name="tva_id", referencedColumnName="id", onDelete="SET NULL")
     **/
    private $tva;

    /**
     * @ORM\ManyToOne(targetEntity="Ticme\BackBundle\Entity\Category", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="SET NULL")
     **/
    private $category;

    /**
     * @var string
     *
     * @ORM\OneToOne(targetEntity="Ticme\BackBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     *
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Ticme\UserBundle\Entity\User", inversedBy="products")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
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
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=180, unique=true)
     */
    private $slug;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('NOW');
        $this->updatedAt = new \DateTime('NOW');
    }


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
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPriceHt($priceHt)
    {
        $this->priceHt = $priceHt;

        return $this;
    }

    /**
     * Get PriceHt
     *
     * @return float
     */
    public function getPriceHt()
    {
        return $this->priceHt;
    }

    /**
     * Set available
     *
     * @param boolean $available
     *
     * @return Product
     */
    public function setAvailable($available)
    {
        $this->available = $available;

        return $this;
    }

    /**
     * Get available
     *
     * @return boolean
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Set tva
     *
     * @param \Ticme\BackBundle\Entity\Tva $tva
     *
     * @return Product
     */
    public function setTva(\Ticme\BackBundle\Entity\Tva $tva = null)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get tva
     *
     * @return \Ticme\BackBundle\Entity\Tva
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set category
     *
     * @param \Ticme\BackBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\Ticme\BackBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Ticme\BackBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }



    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set user
     *
     * @param \Ticme\UserBundle\Entity\User $user
     *
     * @return Product
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


    /**
     * Set createdAt
     *
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
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
     * Set image
     *
     * @param \Ticme\BackBundle\Entity\Media $image
     *
     * @return Category
     */
    public function setImage(\Ticme\BackBundle\Entity\Media $image = null)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return \Ticme\BackBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }
}
