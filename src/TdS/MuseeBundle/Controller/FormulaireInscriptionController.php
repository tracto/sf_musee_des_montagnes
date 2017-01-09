<?php

namespace TdS\MuseeBundle\Controller;

use TdS\MuseeBundle\Entity\Inscription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormulaireInscriptionController extends Controller
{
    /**
     * @Route("/")
     */
    public function addAction(Request $request){
    	$inscription=new Inscription();
    	

    	$form = $this->get('form.factory')->createBuilder('form', $inscription)
    		->add('nom', 'text')
    		->add('prenom', 'text')
    		->add('dateNaissance',BirthdayType::class, array(
    			     'placeholder' => array(
        		     'year' => 'année', 'month' => 'mois', 'day' => 'jour',
    		)))
    		->add('email', 'text')
    		->add('titreMontagne', 'text')
    		->add('description', 'textarea')
    		->add('valider','submit')
    		->getForm()
    	;

    	$form->handleRequest($request);

    	if($form->isValid()){
    		$em=$this->getDoctrine()->getManager();
    		$em->persist($inscription);
    		$em->flush();

    		// On redirige vers la page de visualisation de l'annonce nouvellement créée
      		return $this->redirect($this->generateUrl('tds_musee_validation_inscription', array('id' => $inscription->getId())));
    	}
    	
    	
        return $this->render('TdSMuseeBundle:Questionnaire:formulaireinscription.html.twig',array('form' => $form->createView())
        	);
    }


    public function valideAction($id, Request $request){
    	$em=$this->getDoctrine()->getManager();
    	$inscription=$em->getRepository('TdSMuseeBundle:Inscription')
    					   ->findOneById($id);
        return $this->render('TdSMuseeBundle:Questionnaire:valideInscription.html.twig',array('inscription'=>$inscription));
    }
}
