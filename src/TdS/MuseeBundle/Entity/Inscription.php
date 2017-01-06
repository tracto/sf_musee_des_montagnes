<?php

namespace TdS\MuseeBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Inscription
 *
 * @ORM\Table(name="inscription")
 * @ORM\Entity(repositoryClass="TdS\MuseeBundle\Repository\InscriptionRepository")
 */
class Inscription
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;


    /**
     * @Assert\Email(
     *     message = "Cette adresse email '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     * @ORM\Column(name="email", type="string", length=255)
     */
     protected $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="titreMontagne", type="string", length=255)
     */
    private $titreMontagne;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateInscription", type="datetime")
     */
    private $dateInscription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;



  
    public function __construct()
    {
        $this->dateInscription = new \Datetime();
    }
  


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Inscription
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Inscription
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }


    /**
     * Set email
     *
     * @param string $prenom
     *
     * @return Inscription
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }



    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Inscription
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set titreMontagne
     *
     * @param string $titreMontagne
     *
     * @return Inscription
     */
    public function setTitreMontagne($titreMontagne)
    {
        $this->titreMontagne = $titreMontagne;

        return $this;
    }

    /**
     * Get titreMontagne
     *
     * @return string
     */
    public function getTitreMontagne()
    {
        return $this->titreMontagne;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return Inscription
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
     * Set description
     *
     * @param string $description
     *
     * @return Inscription
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
}

