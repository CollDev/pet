<?php
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("salida")
 */
class SalidaController extends Controller
{
    /**
     * @Route("/registrar", name="salida_registrar")
     * @Template()
     */
    public function registrarAction()
    {
        $request = $this->getRequest();
        $pedidoManager = $this->get('pedido.manager');
        $mensaje = "";
        $form = $this->createFormBuilder()
                    ->add('nro_pedido','text', ['attr' => ['readOnly' => true]])
                    ->add('factura','text', ['attr' => ['readOnly' => true]])
                    ->getForm();
        
        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->isValid()) {
                $pedidoActualizado = $pedidoManager->actualizarFactura($form);
                if(!is_null($pedidoActualizado)) {
                    $mensaje ="Registro Nro.".$pedidoActualizado->getId()." ingresado exitosamente"
                        ." con factura: ". $pedidoActualizado->getFactura()->getId();
                }
                else {
                    $mensaje ="El Registro no se pudo actualizar correctamente. 
                        Revise que la factura es única y que el pedido exista";
                }
            }
        }
        
        
        return ['form' => $form->createView(), 'mensaje' => $mensaje];
    }
}

?>
