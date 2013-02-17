<?php
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sistema\Bundle\FrontendBundle\Form\PedidoType;
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
                $mensaje ="Registro ingresado exitosamente";
            }
        }
        
        return ['form' => $form->createView(), 'mensaje' => $mensaje];
    
    }
    
}

?>
