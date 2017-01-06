<?php

namespace TdS\MuseeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EditionController extends Controller
{
    /**
     * @Route("/")
     */

    public function listAction(){
    	$em=$this->getDoctrine()->getManager();
    	$editionsListe=$em->getRepository('TdSMuseeBundle:Edition')
    					   ->findAll();
        return $this->render('TdSMuseeBundle:Edition:list.html.twig',array('editionsListe'=>$editionsListe));
    }

    public function viewAction($id){
    	$em=$this->getDoctrine()->getManager();
    	$edition=$em->getRepository('TdSMuseeBundle:Edition')
    					   ->findOneById($id);
        return $this->render('TdSMuseeBundle:Edition:view.html.twig',array('edition'=>$edition));
    }
}