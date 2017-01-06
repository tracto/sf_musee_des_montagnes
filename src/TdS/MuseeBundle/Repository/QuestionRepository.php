<?php

namespace TdS\MuseeBundle\Repository;



/**
 * QuestionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuestionRepository extends \Doctrine\ORM\EntityRepository
{
	public function countQuestions(){
		return $this->createQueryBuilder('a')
 			->select('COUNT(a)')
 			->getQuery()
 			->getSingleScalarResult();
 	}
}
