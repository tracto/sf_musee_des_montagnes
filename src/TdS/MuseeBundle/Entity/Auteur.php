<?php

namespace TdS\MuseeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auteur
 *
 * @ORM\Table(name="auteur")
 * @ORM\Entity(repositoryClass="TdS\MuseeBundle\Repository\AuteurRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Auteur
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
     * @ORM\Column(name="nom", type="string", nullable=false)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255, nullable=false)
     */
    private $sexe;


    /**
     * @var string
     *
     * @ORM\Column(name="siteweb", type="string", length=255, nullable=true)
     */
    private $siteweb;



    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;


    /**
     * @var text
     *
     * @ORM\Column(name="adresse", type="text", nullable=true)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="codepostal", type="integer", nullable=true)
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;



    /**
     * Set nom
     *
     * @param string $nom
     * @return Auteur
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
     * Set age
     *
     * @param integer $age
     * @return Auteur
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Auteur
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }


    /**
     * Set siteweb
     *
     * @param string $siteweb
     * @return Auteur
     */
    public function setSiteweb($siteweb)
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    /**
     * Get siteweb
     *
     * @return string 
     */
    public function getSiteweb()
    {
        return $this->siteweb;
    }


    /**
     * Set email
     *
     * @param string $email
     * @return Auteur
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
     * Set adresse
     *
     * @param text $adresse
     * @return Auteur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return text 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }


    /**
     * Set codepostal
     *
     * @param integer $codepostal
     * @return Auteur
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return integer 
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }



    /**
     * Set ville
     *
     * @param string $ville
     * @return Auteur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

}