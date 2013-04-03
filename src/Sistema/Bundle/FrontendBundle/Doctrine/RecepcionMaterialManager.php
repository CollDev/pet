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
    
    public function guardarMaterial($recepcionMaterial, $usuario)
    {
        $recepcionMaterial->setUsuario($usuario);
        $this->guardar($recepcionMaterial);
        $material = $recepcionMaterial->getMaterial();
        $this->aumentarStock($material->getId(),
                $recepcionMaterial->getCantidad());
    }
            
    
    public function editar($recepcionMaterialId, $recepcionMaterial, $usuario)
    {
        $recepcionMaterialExistente = $this->repository->find($recepcionMaterialId);
        $cantidadExistente = $recepcionMaterialExistente->getCantidad();
        if(isset($recepcionMaterialExistente)) {
        $recepcionMaterialExistente->setBoletaRecepcion($recepcionMaterial->getBoletaRecepcion());
        $recepcionMaterialExistente->setMaterial($recepcionMaterial->getMaterial());
        $recepcionMaterialExistente->setUnidadMedida($recepcionMaterial->getUnidadMedida());
        $recepcionMaterialExistente->setCantidad($recepcionMaterial->getCantidad());
        $recepcionMaterialExistente->setFechaIngreso($recepcionMaterial->getFechaIngreso());
        $recepcionMaterialExistente->setUsuario($usuario);
        $this->guardar($recepcionMaterialExistente);
        $cantidad = $recepcionMaterial->getCantidad();
        if($cantidad >= $cantidadExistente) {
            $this->aumentarStock($recepcionMaterialExistente->getMaterial()->getId(), 
                $cantidad - $cantidadExistente);
        }
        else {
            $this->disminuirStock($recepcionMaterialExistente->getMaterial()->getId(), 
                $cantidadExistente - $cantidad );
        }
        
        }
    }
    
    public function eliminarById($recepcionMaterialId)
    {
        $recepcionMaterialExistente = $this->repository->find($recepcionMaterialId);
        $this->eliminar($recepcionMaterialExistente);
        $this->disminuirStock($recepcionMaterialExistente->getMaterial()->getId(),
                $recepcionMaterialExistente->getCantidad());
    }
    
    
    public function analizarIndicadores($fechas)
    {
      $indicadores = $this->repository->analizarIndicadores($fechas);
      
      $indicadoresNormalizados = $this->normalizarIndicadores($indicadores);
      return $indicadoresNormalizados;
    }
    
    public function aumentarStock($materialId, $cantidad)
    {
        $materialRepository = $this->objectManager->getRepository('FrontendBundle:Material');
        $material = $materialRepository->find($materialId);
        $stock = $material->getStock();
        $material->setStock($stock + $cantidad);
        
        $this->guardar($material);
    }
    
    public function disminuirStock($materialId, $cantidad)
    {
        $materialRepository = $this->objectManager->getRepository('FrontendBundle:Material');
        $material = $materialRepository->find($materialId);
        $stock = $material->getStock();
        $material->setStock($stock - $cantidad);
        $this->guardar($material);
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
    
    public function getBoletaRecepcionByPk($id)
    {
        $boletaRecepcionRepository = $this->objectManager->getRepository('FrontendBundle:BoletaRecepcion');
        return $boletaRecepcionRepository->find($id);
    }
    
    public function esMaterialUnico($miRecepcionMaterial)
    {
        $boletaRecepcion = $miRecepcionMaterial->getBoletaRecepcion();
        $materialCandidato = $miRecepcionMaterial->getMaterial();
        $recepcionesMaterial = $this->repository->getRecepcionMaterialesPorBoletaRecepcionId($boletaRecepcion->getId());
        foreach($recepcionesMaterial as $recepcionMaterial) {
            $material = $recepcionMaterial->getMaterial();
            if ($material->getNombre() == $materialCandidato->getNombre()) 
            {
                return false;
            }
        }
        return true;
    }
}

?>
