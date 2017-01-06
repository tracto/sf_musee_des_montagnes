<?php

namespace TdS\MuseeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReglementController extends Controller
{
    /**
     * @Route("/")
     */
    public function viewAction($id){
    	$em=$this->getDoctrine()->getManager();
    	$reglement=$em->getRepository('TdSMuseeBundle:Reglement')
    	 				   ->findOneById($id);
        return $this->render('TdSMuseeBundle:reglement:view.html.twig',array('reglement'=>$reglement));
    }
}