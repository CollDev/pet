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
            $incidenciaExistente->setUnidad($incidencia->getUnidad());
        
        $this->guardar($incidenciaExistente);
        }
    }
    
    public function eliminarById($id) 
    {
        $incidencia = $this->repository->find($id);
        if(!is_null($incidencia)) {
            $this->eliminar($incidencia);
        }
    }
    
    public function buscarIncidenciasPorFecha($fechaInicio, $fechaFin)
    {
        return $this->repository->buscarIncidenciasPorFecha($fechaInicio, $fechaFin);
    }
    
    public function resolverIncidencia($form) 
    {
        $id = $form->get('id')->getData();
        $incidencia = $this->findByPk($id);
        
        if(!is_null($incidencia)) {
            $fechaResolucion = $form->get('fecha_resolucion')->getData();
            $solucion = $form->get('solucion')->getData();
            $estado = $form->get('estado')->getData();
            
            $incidencia->setFechaResolucion($fechaResolucion);
            $incidencia->setSolucion($solucion);
            $incidencia->setEstado($estado);
            $this->guardar($incidencia);
            return true;
        }
        else {
            return false;
        }
        
    }
}

?>
