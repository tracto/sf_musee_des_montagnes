<?php

namespace TdS\MuseeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Sonata\MediaBundle\Entity\Media;
use Application\Sonata\MediaBundle\Entity\Gallery;

/**
 * Presentation
 *
 * @ORM\Table(name="presentation")
 * @ORM\Entity(repositoryClass="TdS\MuseeBundle\Repository\PresentationRepository")
 */
class Presentation
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
     *
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $imageMain;


    /**
     * @ORM\OneToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery", cascade={"all"})
     */
    protected $galerie;


    /**
     * @var string
     *
     * @ORM\Column(name="chapo", type="text")
     */
    private $chapo;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", nullable=true)
     */
    private $contenu;


    


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    public function setImageMain(Media $imageMain=null)
    {
        $this->imageMain = $imageMain;

    }


    public function getImageMain()
    {
        return $this->imageMain;
    }



    public function setGalerie(Gallery $galerie=null)
    {
        $this->galerie = $galerie;

    }


    public function getGalerie()
    {
        return $this->galerie;
    }


    /**
     * Set chapo
     *
     * @param string $chapo
     *
     * @return Presentation
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;

        return $this;
    }

    /**
     * Get chapo
     *
     * @return string
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Presentation
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }
}

