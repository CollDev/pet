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
        
        $recepcionMaterialExistente->setBoletaRecepcion($recepcionMaterial->getBoletaRecepcion());
        $recepcionMaterialExistente->setMaterial($recepcionMaterial->getMaterial());
        $recepcionMaterialExistente->setUnidadMedida($recepcionMaterial->getUnidadMedida());
        $recepcionMaterialExistente->setCantidad($recepcionMaterial->getCantidad());
        $recepcionMaterialExistente->setFechaIngreso($recepcionMaterial->getFechaIngreso());
        
        $this->guardar($recepcionMaterialExistente);
    }
}

?>
