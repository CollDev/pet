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
        
        
        $pedido = $form->getData();
        
        $nroPedido = $form->get('nro_pedido')->getData();
        if(is_null($nroPedido)) {
            $nuevoPedido = $this->crearEntidad();
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
            
            $pedidoProcesado = $nuevoPedido;
        }
        else {
            $pedidoExistente = $this->repository->find($nroPedido);
            $pedidoExistente->setFechaProgramacion($pedido->getFechaProgramacion());
            $pedidoExistente->setEstado($pedido->getEstado());
            $pedidoExistente->setCliente($pedido->getCliente());
            
            $pedidoDetalleExistente = $this->objectManager
                    ->getRepository('FrontendBundle:PedidoDetalle')
                    ->findOneBy(['pedido' => $pedidoExistente->getId() ]);
            $pedidoDetalleExistente->setCantidad($form->get('cantidad')->getData());
            $pedidoDetalleExistente->setImporte($form->get('importe')->getData());
            $pedidoDetalleExistente->setMaterial($form->get('material')->getData());
            
            $this->objectManager->persist($pedidoExistente);
            $this->objectManager->persist($pedidoDetalleExistente);
            $this->objectManager->flush();   
            
            $pedidoProcesado = $pedidoExistente;
        }
        
       return $pedidoProcesado; 
        
    }
    
    public function eliminarPedido($form)
    {
        $nroPedido = $form->get('nro_pedido')->getData();
        $mensaje = "";
        if(!is_null($nroPedido)) {
            $pedidoExistente = $this->repository->find($nroPedido);
            $pedidoDetalleExistente = $this->objectManager
                    ->getRepository('FrontendBundle:PedidoDetalle')
                    ->findOneBy(['pedido' => $pedidoExistente->getId() ]);
            $this->objectManager->remove($pedidoExistente);
            $this->objectManager->remove($pedidoDetalleExistente);
            $this->objectManager->flush();   
            
            $mensaje = "Registro Eliminado";
        }
        else {
           $mensaje = "No se pudo eliminar el Registro";
        }
        
        return $mensaje;
    }
    
    public function actualizarFactura($form)
    {
        $nroPedido = $form->get('nro_pedido')->getData();
        $factura = $form->get('factura')->getData();
        $estadoRepository = $this->objectManager->getRepository('FrontendBundle:Estado');
        $estadoAtendido = $estadoRepository->findOneBy(['nombre' => 'Atendido']);
        $pedido = $this->repository->find($nroPedido);
        if(!is_null($pedido)) {
            $pedido->setFactura($factura);
            $pedido->setEstado($estadoAtendido);
            $this->guardar($pedido);
            return $pedido;
        }
        return null;
    }
    
    public function buscarPedidosPorFecha($form)
    {
        $fechaInicio = $form->get('fecha_inicio')->getData();
        $fechaFin = $form->get('fecha_fin')->getData();
        $clienteId = $form->get('cliente')->getData();
        $pedidosConDetalle = [];
        $pedidos = $this->repository->buscarPedidosPorFecha($clienteId,
                $fechaInicio, $fechaFin);
        $pedidoDetalleRepository = $this->objectManager
                ->getRepository('FrontendBundle:PedidoDetalle');
        
        $pedidosConDetalle = $pedidoDetalleRepository->buscarPedidos($pedidos);
        
        return $pedidosConDetalle;
                
    }
    
    public function confirmarPedido($pedidoId)
    {
        $pedido = $this->repository->find($pedidoId);
        $estadoRepository = $this->objectManager->getRepository('FrontendBundle:Estado');
        $estadoConfirmado = $estadoRepository->findOneBy(['nombre' => 'Confirmado']);
        if(!is_null($pedido)) {
            $pedido->setEstado($estadoConfirmado);
            $this->guardar($pedido);
        }
        return $pedido;
    }
    
}

?>
