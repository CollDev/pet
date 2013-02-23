<?php

namespace Sistema\Bundle\FrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * EstadoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EstadoRepository extends EntityRepository
{
    public function getEstadoPorNombre($nombre)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('e')
                ->from('FrontendBundle:Estado', 'e')
                ->add('where', $queryBuilder->expr()->eq('e.nombre', ':nombre'))
                ->setParameter('nombre', $nombre);
        return $queryBuilder;
        
    }
    
    public function getEstadosPedido()
    {
        $nombres = ['Pendiente', 'Confirmado','Atendido'];
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('e')
                ->from('FrontendBundle:Estado', 'e')
                ->add('where', $queryBuilder->expr()->in('e.nombre', ':nombres'))
                ->setParameter('nombres', $nombres);
        return $queryBuilder;
        
    }
}
