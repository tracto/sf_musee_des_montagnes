<?php

namespace TdS\MuseeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/")
     */


    public function listAction(){
    	$em=$this->getDoctrine()->getManager();
    	$articlesListe=$em->getRepository('TdSMuseeBundle:Article')
    					   ->findAll();
        return $this->render('TdSMuseeBundle:Article:list.html.twig',array('articlesListe'=>$articlesListe));
    }

    public function viewAction($id){
    	$em=$this->getDoctrine()->getManager();
    	$article=$em->getRepository('TdSMuseeBundle:Article')
    					   ->findOneById($id);
        return $this->render('TdSMuseeBundle:Article:view.html.twig',array('article'=>$article));
    }
}