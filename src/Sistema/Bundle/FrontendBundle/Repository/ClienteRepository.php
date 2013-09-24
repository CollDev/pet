<?php

namespace Sistema\Bundle\FrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ClienteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClienteRepository extends EntityRepository
{
    public function buscarClientes($criteria)
    {
        $qb = $this->createQueryBuilder("c");
        
        foreach ($criteria as $field => $value) {
            if (!$this->getClassMetadata()->hasField($field)) {
                continue;
            }
            if(!empty($value)) {
                
                    $qb ->andWhere($qb->expr()->eq('c.'.$field, ':c_'.$field))
                    ->setParameter('c_'.$field, $value);
            }
        }
        return $qb->getQuery()->getResult();
    }

}
