<?php
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
                $pedidoManager->guardarConDetalle($form);
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
     * @Route("/preconfirmar", name="pedido_preconfirmare")
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
         
            if($form->isValid()) {
                $esValido = $clienteManager->validarClave($form);
                if($esValido) {
                    //$url = $this->generateUrl('pedido_confirmar');
                   //$this->redirect($url);
                }
                else {
                    $mensaje = "Clave incorrecta, intente nuevamente";
                }
            }
        }
        
        return ['form' => $form->createView(), 'mensaje' => $mensaje];
    }
    
}

?>
