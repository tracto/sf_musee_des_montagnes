<?php

namespace TdS\MuseeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MontagneController extends Controller
{
    /**
     * @Route("/")
     */

    public function listAction(){
    	$em=$this->getDoctrine()->getManager();
    	$montagnesListe=$em->getRepository('TdSMuseeBundle:Montagne')
    					   ->findAll();
        return $this->render('TdSMuseeBundle:Montagne:list.html.twig',array('montagnesListe'=>$montagnesListe));
    }


    public function viewAction($id){
    	$em=$this->getDoctrine()->getManager();
    	$montagne=$em->getRepository('TdSMuseeBundle:Montagne')
    					   ->findOneById($id);
        return $this->render('TdSMuseeBundle:Montagne:view.html.twig',array('montagne'=>$montagne));
    }
}
