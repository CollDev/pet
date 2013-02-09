<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecepcionMaterialManager
 *
 * @author Administrator
 */
namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;

class RecepcionMaterialManager extends BaseManager
{
    public function __construct(ObjectManager $om, $fqnClass)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($fqnClass);
        $this->class = $fqnClass;
    }
    
    public function editar($recepcionMaterialId, $recepcionMaterial)
    {
        $recepcionMaterialExistente = $this->repository->find($recepcionMaterialId);
        if(isset($recepcionMaterialExistente)) {
        $recepcionMaterialExistente->setBoletaRecepcion($recepcionMaterial->getBoletaRecepcion());
        $recepcionMaterialExistente->setMaterial($recepcionMaterial->getMaterial());
        $recepcionMaterialExistente->setUnidadMedida($recepcionMaterial->getUnidadMedida());
        $recepcionMaterialExistente->setCantidad($recepcionMaterial->getCantidad());
        $recepcionMaterialExistente->setFechaIngreso($recepcionMaterial->getFechaIngreso());
        
        $this->guardar($recepcionMaterialExistente);
        }
    }
    
    public function eliminarById($recepcionMaterialId)
    {
        $recepcionMaterialExistente = $this->repository->find($recepcionMaterialId);
        $this->eliminar($recepcionMaterialExistente);
    }
    
    public function analizarIndicadores($fechas)
    {
      $indicadores = $this->repository->analizarIndicadores($fechas);
      
      $indicadoresNormalizados = $this->normalizarIndicadores($indicadores);
      return $indicadoresNormalizados;
    }
    
    private function normalizarIndicadores($indicadores)
    {
        $sumatoria = function ($resultado, $indicador) {
             $resultado= $resultado + $indicador['total'];
             return $resultado;
        };
        $total = array_reduce($indicadores, $sumatoria, 0);
        
        $normalizar = function($indicador) use ($total) {
            $indicador['total'] = number_format(100*$indicador['total']/$total, 0);
            return $indicador;
        };
        $indicadoresNormalizados = array_map($normalizar, $indicadores);
        return $indicadoresNormalizados;
    }
}

?>
