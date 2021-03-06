<?php

namespace Sistema\Bundle\FrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * FacturaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FacturaRepository extends EntityRepository
{
    public function buscarFacturas($criteria)
    {
        $qb = $this->createQueryBuilder("f");
        
        foreach ($criteria as $field => $value) {
            if (!$this->getClassMetadata()->hasField($field)) {
                continue;
            }
            if(!empty($value)) {
                
                    $qb ->andWhere($qb->expr()->eq('f.'.$field, ':f_'.$field))
                    ->setParameter('f_'.$field, $value);
            }
        }
        return $qb->getQuery()->getResult();
    }
}
