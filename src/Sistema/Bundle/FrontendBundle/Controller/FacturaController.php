<?php
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sistema\Bundle\FrontendBundle\Entity\Factura;

/**
 * @Route("/facturas")
 */
class FacturaController extends Controller
{
    /**
     * @Route("/buscar", name="factura_buscar")
     * @Template()
     * 
     */
    public function buscarAction()
    {
        $request = $this->getRequest();
        $facturaRepository = $this->get('factura.repository');
        
        $searchForm = $this->createFormBuilder()
                ->add('id','text', ['required'=> false ])
                ->getForm();
        $facturas = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $facturas = $facturaRepository
                    ->buscarFacturas($searchForm->getData());
            }
        }
        return [ 'form' => $searchForm->createView() ];
    }
    
    /**
     * @Route("ajaxListar", name="factura_ajax_listar")
     * @Template()
     */
    public function ajaxListarFacturasAction()
    {
        $request = $this->getRequest();
        $facturaRepository = $this->get('factura.repository');
        
        $factura = new Factura();
        $searchForm = $this->createFormBuilder()
                ->add('id','text', ['required'=> false ])
                ->getForm();
        $facturas = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $facturas = $facturaRepository
                    ->buscarFacturas($searchForm->getData());                
            }
        }
        return [ 'form' => $searchForm->createView(), 
             'facturas' =>  $facturas ];
    }

}

?>
