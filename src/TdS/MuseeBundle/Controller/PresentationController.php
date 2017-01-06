<?php

namespace TdS\MuseeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PresentationController extends Controller
{
    /**
     * @Route("/")
     */
    public function viewAction($id){
    	$em=$this->getDoctrine()->getManager();
    	$presentation=$em->getRepository('TdSMuseeBundle:Presentation')
    					   ->findOneById($id);
        return $this->render('TdSMuseeBundle:presentation:view.html.twig',array('presentation'=>$presentation));
    }
}