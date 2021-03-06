<?php

namespace Sistema\Bundle\FrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ResponsableRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResponsableRepository extends EntityRepository
{
    public function getResponsables()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('r')
                ->from('FrontendBundle:Responsable', 'r');
        return $queryBuilder;
    }
}
