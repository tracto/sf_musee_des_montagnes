<?php

namespace TdS\MuseeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use TdS\MuseeBundle\Entity\Montagne;
use TdS\MuseeBundle\Entity\Article;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(){
    	$em=$this->getDoctrine()->getManager();

    	$presentation=$em->getRepository('TdSMuseeBundle:Presentation')
    					   ->findOneById('1');

    	$montagnes=$em->getRepository('TdSMuseeBundle:Montagne')
    					   ->find3random();

        $countF=$em->getRepository('TdSMuseeBundle:Auteur')
                           ->findbysexe('F');

        $countH=$em->getRepository('TdSMuseeBundle:Auteur')
                           ->findbysexe('H');

        $auteurs=$em->getRepository('TdSMuseeBundle:Auteur')
                           ->findAll();
        $auteursJson = $this->container->get('serializer')->serialize($auteurs, 'json');

    	$articles=$em->getRepository('TdSMuseeBundle:Article')
    					     ->findBy(
                        array(),                        // Critere
                        array('date' => 'desc'),        // Tri
                        2,                              // Limite
                        0                               // Offset
                    );

    	$editions=$em->getRepository('TdSMuseeBundle:Edition')
    					   ->findAll();
    	
        return $this->render('TdSMuseeBundle:Default:index.html.twig',
        	array('presentation'=>$presentation,
        		  'montagnes'=>$montagnes,
                  'countF'=>$countF,
                  'countH'=>$countH,
                  'auteurs'=>$auteurs,
        		  'articles'=>$articles,
        		  'editions'=>$editions,
                  'auteursJson'=> $auteursJson
        			));
    }
}
