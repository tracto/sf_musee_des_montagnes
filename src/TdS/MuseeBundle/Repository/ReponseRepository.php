<?php

namespace TdS\MuseeBundle\Repository;


use TdS\MuseeBundle\Entity\Question;
/**
 * ReponseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReponseRepository extends \Doctrine\ORM\EntityRepository
{
	public function findBonneReponse(Question $question){
		$queryBuilder = $this->createQueryBuilder('a');
		$queryBuilder
			->where('a.valide = :valide')
       		->setParameter('valide', 1)
			->andwhere('a.question = :question')
  			->setParameter('question', $question)
  			->setMaxResults(1);
       		// ->andWhere('validate', 'test')

       	$query = $queryBuilder->getQuery();

	    // On récupère les résultats à partir de la Query
	    $result = $query->getOneOrNullResult();

	    // On retourne ces résultats
	    return $result;
	}

}
