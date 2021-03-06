<?php

namespace Sistema\Bundle\FrontendBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * IndicadorRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class IndicadorRepository extends EntityRepository
{
    public function indicadorExiste($nombre)
    {
        $indicador = $this->findOneBy(['nombre' => $nombre]);
        $existe = false;
        if(!is_null($indicador)) {
            $existe = true;
        }
        return $existe;
    }
            
}
