<?php

namespace Sistema\Bundle\FrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UnidadRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UnidadRepository extends EntityRepository
{
    public function getUnidadesConMantenimiento($dias)
    {
        $hoy = new \DateTime();
        $fechaLimite = $hoy->add(new \DateInterval('P'.$dias.'D'));
        
        $query = $this->createQueryBuilder('u')
                ->where('u.fecha_mantenimiento < :fechaLimite 
                    AND u.estado = :activo')
                ->setParameter('fechaLimite', $fechaLimite)
                ->setParameter('activo', 1)
                ->getQuery();
        
        return $query;
    }
}
