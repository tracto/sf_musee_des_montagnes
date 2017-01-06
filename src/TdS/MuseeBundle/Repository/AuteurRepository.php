<?php

namespace TdS\MuseeBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AuteurRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AuteurRepository extends EntityRepository{

	public function findbysexe($sexe){
	    $queryBuilder = $this->createQueryBuilder('a');

	    $queryBuilder
	    	// ->select('i, RAND() AS HIDDEN r')
    		// ->from('TdSMuseeBundle:Montagne', 'i')
    		// ->orderBy('r', 'ASC')
	    	->select('COUNT(a)')
	    	// ->where('a.sexe = F')
	    	->where('a.sexe = :sexe')
   			->setParameter('sexe', $sexe)
   			
    		;
	    // On récupère la Query à partir du QueryBuilder
	    $query = $queryBuilder->getQuery();

	    // On récupère les résultats à partir de la Query
	    $results = $query->getSingleScalarResult();

	    // On retourne ces résultats
	    return $results;

	}
}