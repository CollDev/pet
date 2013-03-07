<?php

namespace Sistema\Bundle\FrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TopesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TopesRepository extends EntityRepository
{
    public function getUltimoTope()
    {
        return $this->findOneBy([], ['id' => 'DESC']);
    }
    
    public function getQueryTopesDesdeUltimoTopeInicial()
    {
        $topeInicial = $this->findOneBy(['previo' => 0], ['id' => 'DESC']);
        
        $queryBuilder = $this->createQueryBuilder('qb');
        $queryBuilder->select('t')
            ->from('FrontendBundle:Topes', 't')
            ->where('t.id >= :idInicial')
            ->setParameter('idInicial', $topeInicial->getId());
        $query = $queryBuilder->getQuery();
        return $query;
    }
    
    public function getUltimoTopeAcumulado()
    {
        $tope = $this->findOneBy([], ['fecha_registro' => 'DESC']);
        return $tope;
    }
}
