<?php

namespace CompanyBundle\Repository;

/**
 * CompanyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompanyRepository extends \Doctrine\ORM\EntityRepository
{
	public function findCompaniesRight($subFamId){
		$qb = $this->createQueryBuilder('c');
			$qb->select('c');
            $qb->innerJoin('c.companyQuestionSubFamAccess','a');
            $qb->where('a.questionSubFamily = :sub');
            $qb->setParameter('sub',$subFamId);
            return $qb->getQuery()->getResult();
	}
}
