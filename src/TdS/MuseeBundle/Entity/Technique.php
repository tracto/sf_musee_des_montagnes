<?php

namespace TdS\MuseeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Technique
 *
 * @ORM\Table(name="technique")
 * @ORM\Entity(repositoryClass="TdS\MuseeBundle\Repository\TechniqueRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Technique
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
     * @var int
     *
     * @ORM\Column(name="titre", type="string", nullable=true)
     */
    private $titre;



    



    


    /**
     * Set nom
     *
     * @param string $nom
     * @return Technique
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



    

}