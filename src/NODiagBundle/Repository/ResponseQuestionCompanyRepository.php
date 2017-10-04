<?php

namespace NODiagBundle\Repository;

/**
 * ResponseQuestionCompanyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResponseQuestionCompanyRepository extends \Doctrine\ORM\EntityRepository
{
	public function findCSFResponses($companyId,$subFamId){
		$qb  = $this->_em->createQueryBuilder();
		$res = $qb->select('r')
             ->from('NODiagBundle:ResponseQuestionCompany', 'r')
             ->innerJoin('r.question','q')
             ->innerJoin('q.subFamily','s')
             ->where('r.company = :comp')
             ->andWhere('s.id = :sub')
             ->setParameter('comp',$companyId)
             ->setParameter('sub',$subFamId)
             ->getQuery()
             ->getResult();
        return $res;
	}

      public function findResponse($compId,$questionId){
            $qb = $this->createQueryBuilder('r');
            $qb->select('r');
            $qb->where('r.question = :quest');
            $qb->andWhere('r.company = :comp ');
            $qb->setParameter('comp',$compId);
            $qb->setParameter('quest',$questionId);

            return $qb->getQuery()->getOneOrNullResult();
      }


      public function findAnsweredQuestionSubFamiliesCount($companyId){
            $qb  = $this->_em->createQueryBuilder();
            $res = $qb->select('COUNT(r.question),s.id')
             ->from('NODiagBundle:ResponseQuestionCompany', 'r')
             ->innerJoin('r.question','q')
             ->innerJoin('q.subFamily','s')
             ->where('r.company = :comp')
             ->andWhere('r.isAnswered = true')
             ->groupBy('s.id')
             ->setParameter('comp',$companyId)
             ->getQuery()
             ->getResult();
        return $res;

      }

      public function findTotalQuestionSubFamiliesCount($companyId){
            $qb  = $this->_em->createQueryBuilder();
            $res = $qb->select('COUNT(r.question),s.id')
             ->from('NODiagBundle:ResponseQuestionCompany', 'r')
             ->innerJoin('r.question','q')
             ->innerJoin('q.subFamily','s')
             ->where('r.company = :comp')
             ->groupBy('s.id')
             ->setParameter('comp',$companyId)
             ->getQuery()
             ->getResult();
        return $res;

      }

      
}
