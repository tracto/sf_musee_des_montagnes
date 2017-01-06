<?php

namespace TdS\MuseeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Sonata\MediaBundle\Entity\Media;
use TdS\MuseeBundle\Entity\Auteur;
use TdS\MuseeBundle\Entity\Technique;

/**
 * Montagne
 *
 * @ORM\Table(name="montagne")
 * @ORM\Entity(repositoryClass="TdS\MuseeBundle\Repository\MontagneRepository")
 */
class Montagne
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     *
     * @ORM\OneToOne(targetEntity="TdS\MuseeBundle\Entity\Auteur", cascade={"persist"})
     */
    private $auteur;




    /**
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $image;



    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateInscription", type="datetimetz")
     */
    private $dateInscription;


    /**
     * @var \Date
     *
     * @ORM\Column(name="dateRealisation", type="date")
     */
    private $dateRealisation;

    

    

    /**
     * @var string
     *
     * @ORM\Column(name="grandeur", type="string", length=4, nullable=false)
     */
    private $grandeur;


    /**
     * @var string
     *
     * @ORM\Column(name="dimensions", type="string", length=255, nullable=true)
     */
    private $dimensions;


    /** 
    * @ORM\ManyToOne(targetEntity="TdS\MuseeBundle\Entity\Technique", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $technique;



    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;


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
     * Set titre
     *
     * @param string $titre
     * @return Montagne
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Montagne
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }


    
    public function setImage(Media $image=null)
    {
        $this->image = $image;

    }

    
    public function getImage()
    {
        return $this->image;
    }


    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     * @return Montagne
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime 
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }



    /**
     * Set dateRealisation
     *
     * @param \DateTime $dateRealisation
     * @return Montagne
     */
    public function setDateRealisation($dateRealisation)
    {
        $this->dateRealisation = $dateRealisation;

        return $this;
    }

    /**
     * Get dateRealisation
     *
     * @return \Date 
     */
    public function getDateRealisation()
    {
        return $this->dateRealisation;
    }

    
    /**
     * Set grandeur
     *
     * @param string $grandeur
     * @return Montagne
     */
    public function setGrandeur($grandeur)
    {
        $this->grandeur = $grandeur;

        return $this;
    }

    /**
     * Get grandeur
     *
     * @return string 
     */
    public function getGrandeur()
    {
        return $this->grandeur;
    }



    /**
     * Set dimensions
     *
     * @param string $dimensions
     * @return Montagne
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * Get dimensions
     *
     * @return string 
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }


    


    public function setTechnique(Technique $technique)
    {
        $this->technique = $technique;
        return $this;
    }

    public function getTechnique()
    {
        return $this->technique;
    }


    

    /**
     * Set description
     *
     * @param string $description
     * @return Montagne
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
     * Set note
     *
     * @param string $note
     * @return Montagne
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }
}
