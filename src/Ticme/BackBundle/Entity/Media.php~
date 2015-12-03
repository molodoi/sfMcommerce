<?php

namespace Ticme\BackBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Category
 * @ORM\Table(name="um_media")
 * @ORM\Entity(repositoryClass="Ticme\BackBundle\Repository\MediaRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Media
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * Stocke le chemin relatif du fichier et est persistée dans la base de données.
     * @var string
     *
     * @ORM\Column( type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * Est un champ « virtuel » pour gérer l’upload de fichier dans le formulaire
     *
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg", "image/png", "image/gif"},
     *     mimeTypesMessage = "Please upload a valid Image type jpeg, png, gif"
     * )
     */
    private $file;

    /*
     * Permet de gérer la suppression de l'ancien fichier dans le cas d'une modification d'image / editAction du controller des entités reliés
     *
     * @var string
     */
    private $oldFile;

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

    public function getId()
    {
        return $this->id;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getOldFile()
    {
        return $this->oldFile;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @param mixed $file
     *
     * @return File
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if($this->path != null){
            $this->oldFile = $this->path;
        }

        if ($oldFile = $this->getAbsolutePath()) {
            unlink($oldFile);
        }

        $this->updatedAt = new \DateTime();
        return $this;
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
     * Retourne null ou le chemin absolu du fichier
     * @return null|string
     */
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    /**
     * Retourne le chemin web et peut être utilisé dans un template pour ajouter un lien vers le fichier uploadé
     * @return null|string
     */
    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche le document/image dans la vue.
        return 'uploads/categories';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        //$this->oldFile = $this->getPath();
        if (null !== $this->file) {
            // génération d'un un nom unique pour l'image
            $this->path = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->file) {
            return;
        }

        // S'il y a une erreur lors du déplacement du fichier, une exception va automatiquement être lancée par la méthode move().
        //Cela va empêcher proprement l'entité d'être persistée dans la base de données si erreur il y a
        $this->file->move($this->getUploadRootDir(), $this->path);

        if(empty($this->name)){
            $this->setName( $this->file->getClientOriginalName() );
        }

        //le transfert est effectué on détruit la variable $file = la superglobale $_FILES qui est la variable de téléchargement de fichier via HTTP
        unset($this->file);
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->path = $this->getAbsolutePath();
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if(file_exists($this->path)){
            unlink($this->path);
        }
    }

    public function __toString()
    {
        return $this->getName();
    }
}
