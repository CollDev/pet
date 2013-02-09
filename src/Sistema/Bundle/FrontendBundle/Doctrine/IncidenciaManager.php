<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
/**
 * Description of IncidenciaManager
 *
 * @author Administrator
 */
class IncidenciaManager extends BaseManager
{
    
    public function __construct(ObjectManager $om, $fqnClass)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($fqnClass);
        $this->class = $fqnClass;
    }
    
    public function editar($incidenciaId, $incidencia)
    {
        $incidenciaExistente = $this->repository->find($incidenciaId);
        if(isset($incidenciaExistente)) {
            $incidenciaExistente->setTipoIncidencia($incidencia->getTipoIncidencia());
            $incidenciaExistente->setEstado($incidencia->getEstado());
            $incidenciaExistente->setFechaIncidencia($incidencia->getFechaIncidencia());
            $incidenciaExistente->setObservacion($incidencia->getObservacion());
            $incidenciaExistente->setMAquinaria($incidencia->getMaquinaria());
        
        $this->guardar($incidenciaExistente);
        }
    }
}

?>
