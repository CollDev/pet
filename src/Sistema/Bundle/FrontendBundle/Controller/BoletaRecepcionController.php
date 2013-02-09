<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoletaRecepcionController
 *
 * @author Administrator
 */
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion;
/**
 * @Route("/boletaRecepcion")
 */
class BoletaRecepcionController extends Controller
{
    /**
     * @Route("/buscar", name="boleta_recepcion_buscar")
     * @Template()
     */
    public function buscarBoletaAction()
    {
        $request = $this->getRequest();
        $boletaRecepcionRepository = $this->get('boleta_recepcion.repository');
        $boletaRecepcion = new BoletaRecepcion();
        $searchForm = $this->createFormBuilder()
                ->add('id','text', ['required'=> false ])
                //->add('fecha_ingreso', 'date', ['widget' => 'single_text',
                //     'required' => false])
                //->add('fecha_salida', 'date', ['widget' => 'single_text',
                //    'required' => false])
                ->getForm();
        $boletasRecepcion = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $boletasRecepcion = $boletaRecepcionRepository
                    ->buscarBoletasRecepcion($searchForm->getData());
            }
        }
        return [ 'form' => $searchForm->createView() ];
        
    }
    
    /**
     * @Route("/ajaxListar", name="boleta_recepcion_ajax_listar")
     * @Template()
     */
    public function ajaxListarBoletasAction()
    {
        $request = $this->getRequest();
        $boletaRecepcionRepository = $this->get('boleta_recepcion.repository');
        $boletaRecepcion = new BoletaRecepcion();
        $searchForm = $this->createFormBuilder()
                ->add('id','text')
                ->getForm();
        $boletasRecepcion = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $boletasRecepcion = $boletaRecepcionRepository
                    ->buscarBoletasRecepcion($searchForm->getData());
            }
        }
        return [ 'form' => $searchForm->createView(), 
             'boletasRecepcion' =>  $boletasRecepcion ];
            
            //'boletasRecepcion' => implode('->',array_keys($searchForm->getData()))  ];
    }
    
    /**
     * @Route("/completar", name="boleta_recepcion_completar")
     * @Template()
     */
    public function completarAction()
    {
        $request = $this->getRequest();
        $boletaRecepcionManager = $this->get('boleta_recepcion.manager');
        $topeManager = $this->get('tope.manager');
        $boletaRecepcion = new BoletaRecepcion();
        
        $estado = '';
        if($request->getMethod()== 'POST') {
                $boletaRecepcionId = $request->request->get('boleta_impresion_id','');
            if( $boletaRecepcionId !='' ) {
                $boletaRecepcionManager
                    ->completarBoleta($boletaRecepcionId);
                $boletaRecepcion = $boletaRecepcionManager->findByPk($boletaRecepcionId);
                $topeManager->actualizarTope($boletaRecepcion);
                $estado = $boletaRecepcion->getEstado()->getNombre();
            }
        }
        return ['estado' => $estado ];
        
    }
    
}

?>
