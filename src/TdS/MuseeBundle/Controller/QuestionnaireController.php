<?php

namespace TdS\MuseeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class QuestionnaireController extends Controller
{
    /**
     * @Route("/")
     */



    public function viewAction($id){
    	$em=$this->getDoctrine()->getManager();
    	$question=$em->getRepository('TdSMuseeBundle:Question')
    					   ->findOneById($id);

        $countquestions=$em->getRepository('TdSMuseeBundle:Question')
                           ->countQuestions();

        $bonneReponse=$em->getRepository('TdSMuseeBundle:Reponse')
                        ->findBonneReponse($question);
                           
        return $this->render('TdSMuseeBundle:Questionnaire:view.html.twig',array('question'=>$question,'countquestions'=>$countquestions, 'bonneReponse' =>$bonneReponse));
    }
}
