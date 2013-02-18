<?php

namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
use Sistema\Bundle\FrontendBundle\Entity\PedidoDetalle;

class PedidoManager extends BaseManager
{
    public function __construct(ObjectManager $om, $fqnClass)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($fqnClass);
        $this->class = $fqnClass;
    }
    
    public function guardarConDetalle($form)
    {
        $nuevoPedido = $this->crearEntidad();
        $pedido = $form->getData();
        $nuevoPedido->setFechaProgramacion($pedido->getFechaProgramacion());
        $nuevoPedido->setEstado($pedido->getEstado());
        $nuevoPedido->setCliente($pedido->getCliente());
        
        $pedidoDetalle = new PedidoDetalle();
        $pedidoDetalle->setCantidad($form->get('cantidad')->getData());
        $pedidoDetalle->setImporte($form->get('importe')->getData());
        $pedidoDetalle->setMaterial($form->get('material')->getData());
        
        $pedidoDetalle->setPedido($nuevoPedido);
        
        $this->objectManager->persist($nuevoPedido);
        $this->objectManager->persist($pedidoDetalle);
        $this->objectManager->flush();
        
    }
    
    public function actualizarFactura($form)
    {
        $nroPedido = $form->get('nro_pedido')->getData();
        $factura = $form->get('factura')->getData();
        
        $pedido = $this->repository->find($nroPedido);
        if(!is_null($pedido)) {
            $pedido->setFactura($factura);
            $this->guardar($pedido);
            return $pedido;
        }
        return null;
    }
    
    
}

?>
