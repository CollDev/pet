<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoletaRecepcionManager
 *
 * @author Administrator
 */
namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;

class BoletaRecepcionManager extends BaseManager
{
    public function __construct(ObjectManager $om, $fqnClass)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($fqnClass);
        $this->class = $fqnClass;
    }
    
    public function completarBoleta($boletaRecepcionId)
    {
        $boletaRecepcion = $this->repository->find($boletaRecepcionId);
        
        if(!is_null($boletaRecepcion)) {
            $recepcionManterialRepository = $this->objectManager
                ->getRepository('FrontendBundle:RecepcionMaterial');
        
            $pesoNeto = $recepcionManterialRepository
                ->calcularPesoNetoTotal($boletaRecepcion);
           
           $estado = $this->objectManager
                   ->getRepository('FrontendBundle:Estado')->find(3);
           $boletaRecepcion->setNeto($pesoNeto);
           $boletaRecepcion->setFechaSalida(new \DateTime());
           $boletaRecepcion->setEstado($estado);
           $this->guardar($boletaRecepcion);
        }
    }
    
}

?>
