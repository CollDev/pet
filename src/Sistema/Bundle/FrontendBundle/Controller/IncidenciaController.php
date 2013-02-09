<?php

namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sistema\Bundle\FrontendBundle\Form\IncidenciaType;

/**
 * @Route("/incidencias")
 */
class IncidenciaController extends Controller
{
    
    /**
     * @Route("/registar", name="incidencia_registrar")
     * @Template()
     */
    public function registrarAction()
    {
        $request = $this->getRequest();
        $incidenciaManager = $this->get('incidencia.manager');
        $incidencia = $incidenciaManager->crearEntidad();
        $form = $this->createForm(new IncidenciaType(), $incidencia);
        $mensaje = "";
        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->isValid()) {
                $accion = $form->get('accion')->getData();
                $incidencia = $form->getData();
                
                if(empty($accion)) {
                    $incidenciaManager->guardar($incidencia);
                    $mensaje ="Registro ingresado exitosamente";
                }
                else {
                    $incidenciaId = $form->get('nro_incidencia')->getData();
                    $incidenciaManager->editar($incidenciaId, $incidencia);
                    $mensaje ="Registro actualizado exitosamente";
                }
        
            }                
        }
        
        return ['form' => $form->createView(), 'mensaje' => $mensaje];
    }
    
    /**
     * @Route("/eliminar", name="incidencia_eliminar")
     * 
     */
    public function eliminiarAction()
    {
        
        return [];
    }
    
    /**
     * @Route("/listar", name="incidencia_listar")
     * 
     */
    public function listarAction()
    {
        return [];
    }
    
    /**
     * @Route("/buscar", name="incidencia_buscar")
     * @Template()
     */
    public function buscarAction()
    {
        $request = $this->getRequest();
        $incidenciaRepository = $this->get('incidencia.repository');
        
        $searchForm = $this->createFormBuilder()
                ->add('id','text', ['required'=> false ])
                ->getForm();
        $incidencias = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $incidencias = $incidenciaRepository
                    ->buscarIncidencia($searchForm->getData());
            }
        }
        return [ 'form' => $searchForm->createView() ];
    }
    
    /**
     * @Route("/ajaxListar", name="incidencia_ajax_listar")
     * @Template()
     */
    public function ajaxListarIncidenciasAction()
    {
       $request = $this->getRequest();
        $incidenciaRepository = $this->get('incidencia.repository');
        
        $searchForm = $this->createFormBuilder()
                ->add('id','text')
                ->getForm();
        $incidencias = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $incidencias = $incidenciaRepository
                    ->buscarIncidencia($searchForm->getData());
            }
        }
        return [ 'form' => $searchForm->createView(), 
             'incidencias' =>  $incidencias ];
    }
    
    
}

?>
