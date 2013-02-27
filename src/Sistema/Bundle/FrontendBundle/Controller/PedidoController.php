<?php
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

use Sistema\Bundle\FrontendBundle\Form\PedidoType;
use Sistema\Bundle\FrontendBundle\Entity\Pedido;

/**
 * @Route("/pedidos")
 */
class PedidoController extends Controller
{
    /**
     * @Route("/registrar", name="pedido_registrar")
     * @Template()
     */
    public function registrarAction()
    {
        $request = $this->getRequest();
        $pedidoManager = $this->get('pedido.manager');
        $mensaje = '';
        $pedido = $pedidoManager->crearEntidad();
        $form = $this->createForm(new PedidoType(), $pedido);
        
        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->isValid()) {
                $pedido = $pedidoManager->guardarConDetalle($form);
                $mensaje = "Registro Nro.".$pedido->getId()." procesado exitosamente";
            }
        }
        
        return ['form' => $form->createView(), 'mensaje' => $mensaje];
    
    }
    
    /**
     * @Route("/buscar", name="pedido_buscar")
     * @Template()
     * 
     */
    public function buscarAction()
    {
        $request = $this->getRequest();
        $pedidoRepository = $this->get('pedido.repository');
        
        $searchForm = $this->createFormBuilder()
                ->add('id','text', ['required'=> false ])
                ->getForm();
        $pedidos = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $pedidos = $pedidoRepository
                    ->buscarPedidos($searchForm->getData());
            }
        }
        return [ 'form' => $searchForm->createView() ];
    }
    
    /**
     * @Route("ajaxListar", name="pedido_ajax_listar")
     * @Template()
     */
    public function ajaxListarPedidosAction()
    {
        $request = $this->getRequest();
        $pedidoRepository = $this->get('pedido.repository');
        $pedidoDetalleRepository = $this->get('pedido_detalle.repository');
        $pedido = new Pedido();
        $searchForm = $this->createFormBuilder()
                ->add('id','text')
                ->getForm();
        $pedidos = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $pedidos = $pedidoRepository
                    ->buscarPedidos($searchForm->getData());
                $pedidosConDetalle = $pedidoDetalleRepository
                        ->buscarPedidos($pedidos);
            }
        }
        return [ 'form' => $searchForm->createView(), 
             'pedidos' =>  $pedidosConDetalle ];
    }
    
    /**
     * @Route("/ajaxListarPor", name="pedido_ajax_listar_por")
     * @Template()
     */
    public function ajaxListarPorPedidosAction()
    {
        $request = $this->getRequest();
        $pedidoRepository = $this->get('pedido.repository');
        $pedidoDetalleRepository = $this->get('pedido_detalle.repository');
        $pedido = new Pedido();
        $searchForm = $this->createFormBuilder()
                ->add('id','text')
                ->getForm();
        $pedidos = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $pedidos = $pedidoRepository
                    ->buscarPedidos($searchForm->getData());
                $pedidosConDetalle = $pedidoDetalleRepository
                        ->buscarPedidos($pedidos);
            }
        }
        return [ 'form' => $searchForm->createView(), 
             'pedidos' =>  $pedidosConDetalle ];
    }
    
    /**
     * @Route("/eliminar", name="pedido_eliminar")
     * 
     */
    public function eliminiarAction()
    {
        $request = $this->getRequest();
        $pedidoManager = $this->get('pedido.manager');
        $mensaje ="";
        $pedido = $pedidoManager->crearEntidad();
        $form = $this->createForm(new PedidoType(), $pedido);
        
        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->isValid()) {
                $mensaje = $pedidoManager->eliminarPedido($form);
            }
        }
        return new Response($mensaje);
    }
    
    /**
     * @Route("/preconfirmar", name="pedido_preconfirmar")
     * @Template()
     */
    public function preConfirmarPedidosAction()
    {
        $request = $this->getRequest();
        $clienteManager = $this->get('cliente.manager');
        $mensaje = '';
        
        $form = $this->createFormBuilder()
                    ->add('cliente')
                    ->add('clave', 'password')
                    ->getForm();
        
        if($request->isMethod('POST')) {
            $form->bind($request);
            if($form->isValid()) {
                $esValido = $clienteManager->validarClave($form);
                if($esValido) {
                    $cliente = $form->get('cliente')->getData();
                    $url = $this->generateUrl('pedido_confirmar', ['clienteId' => $cliente]);
                    return $this->redirect($url);
                }
                else {
                    $mensaje = "Clave incorrecta, intente nuevamente";
                }
            }
        }
        
        return ['form' => $form->createView(), 'mensaje' => $mensaje];
    }
    
    /**
     * @Route("/confirmar", name="pedido_confirmar")
     * @Template()
     */
    public function confirmarAction()
    {
        $request = $this->getRequest();
        $clienteId = $request->query->get('clienteId', 0);
        
        $pedidoManager = $this->get('pedido.manager');
        $mensaje = '';
        
        $form = $this->createFormBuilder()
                    ->add('cliente','text', ['attr' => ['class'=> 'inputText', 
                        'readonly' => true], 
                        'data' => $clienteId ])
                    ->add('fecha_inicio', 'date', ['widget' => 'single_text'])
                    ->add('fecha_fin', 'date', ['widget' => 'single_text'])
                    ->getForm();
        $pedidos = [];
        if($request->isMethod('POST')) {
            $form->bind($request);
            if($form->isValid()) {
                $pedidos = $pedidoManager->buscarPedidosPorFecha($form);
                
            }
        }
        else {
            if($clienteId == 0) {
                $url = $this->generateUrl('pedido_preconfirmar');
                return $this->redirect($url);
            }
        }
        
        return ['form' => $form->createView(), 'pedidos' => $pedidos, 'mensaje' => $mensaje];
        
    }
    
    /**
     * @Route("/confirmarFecha", name="pedido_confirmar_fecha")
     */
    public function confirmarFecha()
    {
        $request = $this->getRequest();
        $pedidoManager = $this->get('pedido.manager');
        $pedidoId = $request->query->get('id', 0);
        
        $estado = "";
        if($pedidoId != 0) {
            $pedido = $pedidoManager->confirmarPedido($pedidoId);
            if(!is_null($pedido)) {
                $estado = $pedido->getEstado()->getNombre();
            }
        }
        return new Response($estado);
    }
    
}

?>
 