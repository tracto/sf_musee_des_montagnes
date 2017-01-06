<?php

namespace TdS\MuseeBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="TdS\MuseeBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\Column(name="enonce", type="text")
     */
    private $enonce;



    /**
     * @ORM\OneToMany(targetEntity="TdS\MuseeBundle\Entity\Reponse", mappedBy="question")
     */
    private $reponses; 



    public function __construct()
    {
        $this->reponses = new ArrayCollection();
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
     * Set enonce
     *
     * @param string $enonce
     *
     * @return Question
     */
    public function setEnonce($enonce)
    {
        $this->enonce = $enonce;

        return $this;
    }

    /**
     * Get enonce
     *
     * @return string
     */
    public function getEnonce()
    {
        return $this->enonce;
    }



    public function addReponse(Reponse $reponse)
    {
        $this->reponses[] = $reponse;
        $reponse->setQuestion($this);
        return $this;
    }

    public function removeReponse(Reponse $reponse)
    {
        $this->reponses->removeElement($reponse);
    }

    public function getReponses()
    {
        return $this->reponses;
    }
}

