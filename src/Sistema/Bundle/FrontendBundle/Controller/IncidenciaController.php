<?php

namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Sistema\Bundle\FrontendBundle\Form\IncidenciaType;
use Sistema\Bundle\FrontendBundle\Repository\EstadoRepository;

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
        $fechaInicio = $request->query->get('fecha_inicio', '');
        $fechaFin = $request->query->get('fecha_fin', '');
        $data = ['fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin];
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
        
        return ['form' => $form->createView(), 'mensaje' => $mensaje, 'data' => $data];
    }
    
    /**
     * @Route("/editar", name="incidencia_editar")
     * @Template()
     */
    public function editarAction()
    {

        $request = $this->getRequest();
        $incidenciaManager = $this->get('incidencia.manager');
        
        $fechaInicio = $request->query->get('fecha_inicio', '');
        $fechaFin = $request->query->get('fecha_fin', '');
        $accion = 'editar';
        
        $data = ['fechaInicio' => $fechaInicio, 'fechaFin' => $fechaFin,
            'accion' => $accion];
        
        $incidenciaId = $request->query->get('id', '');
        
        if($incidenciaId != '') {
            $incidencia = $incidenciaManager->findByPk($incidenciaId);
        }
        else {
            $incidencia = $incidenciaManager->crearEntidad();
        }
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
        
        return ['form' => $form->createView(), 'mensaje' => $mensaje, 'data' => $data];
    }
    
    /**
     * @Route("/eliminar", name="incidencia_eliminar")
     * 
     */
    public function eliminiarAction()
    {
        $request = $this->getRequest();
        $incidenciaManager = $this->get('incidencia.manager');
        $incidencia = $incidenciaManager->crearEntidad();
        $form = $this->createForm(new IncidenciaType(), $incidencia);
        
        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->isValid()) {
                $accion = $form->get('accion')->getData();
                if(!empty($accion) && $accion =="eliminar") {
                    $incidenciaId = $form->get('nro_incidencia')->getData();
                    $incidenciaManager->eliminarById($incidenciaId);
                }
                else {
                    return new Reponse("Error al procesar la transacción");
                }
            }
        }
        
        return new Response("Registro Eliminado");
    }
    
    /**
     * @Route("/listar", name="incidencia_listar")
     * @Template()
     */
    public function listarAction()
    {
        $request = $this->getRequest();
        $fechaInicio = $request->query->get('fecha_inicio', ''  );
        $fechaFin = $request->query->get('fecha_fin', '' );
        $incidenciaManager = $this->get('incidencia.manager');
        $searchForm = $this->createFormBuilder()
                ->add('fecha_inicio','date', ['widget' => 'single_text', 'required'=> true, 'data' => new \DateTime($fechaInicio)  ])
                ->add('fecha_fin','date', ['widget' => 'single_text', 'required'=> true, 'data' => new \DateTime($fechaFin) ])
                ->getForm();
        $incidencias = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
               
            }
        }
        return [ 'form' => $searchForm->createView() ];

    }
    
    /**
     * @Route("/listarGrilla", defaults={"_format"="xml"}, name="incidencia_listar_grilla")
     * @Method({"GET"})
     * @Template()
     */
    public function listarGrillaAction()
    {
        $request = $this->getRequest();
        $fechaInicio = $request->query->get('fecha_inicio', new \DateTime(),'' );
        $fechaFin = $request->query->get('fecha_fin', new \DateTime(),'' );
        $incidenciaManager = $this->get('incidencia.manager');
        $incidencias = [];
         if($request->getMethod()== 'GET') {
            $incidencias = $incidenciaManager
                ->buscarIncidenciasPorFecha($fechaInicio, $fechaFin);
        }
        
        return ['incidencias' => $incidencias ];
        
    }
    
    /**
     * @Route("/resolver", name="incidencia_resolver")
     * @Template()
     */
    public function resolverAction()
    {
        $request = $this->getRequest();
        $id = $request->query->get('id', 0);
        $incidenciaManager = $this->get('incidencia.manager');
        
        $searchForm = $this->createFormBuilder()
                ->add('id','text', ['required'=> true, 'data' => $id, 'attr' => ['readonly' => true] ])
                ->add('fecha_resolucion','date', ['required'=> true, 'widget' => 'single_text','data' => new \DateTime()  ])
                ->add('solucion','textarea', ['required'=> true ])
                ->add('estado', 'entity', 
                        [ 'class' => 'FrontendBundle:Estado',
                'property' => 'nombre',
                'query_builder' => function(EstadoRepository $estadoRepository) {
                    return $estadoRepository->getEstadosResolucionIncidencia();
                }]
                )
                ->getForm();
        
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
        
            }
        }
        return [ 'form' => $searchForm->createView() ];
    }
    
    /**
     * @Route("/procesarResolucion", name="incidencia_procesar_resolucion")
     * @Template()
     */
    public function procesarResoluctionAction()
    {
        $request = $this->getRequest();
        $incidenciaManager = $this->get('incidencia.manager');
        
        $searchForm = $this->createFormBuilder()
                ->add('id','text', ['required'=> true, 'attr' => ['readonly' => true] ])
                ->add('fecha_resolucion','date', ['required'=> true, 'widget' => 'single_text' ])
                ->add('solucion','textarea', ['required'=> true ])
                ->add('estado', 'entity', 
                        [ 'class' => 'FrontendBundle:Estado',
                'property' => 'nombre',
                'query_builder' => function(EstadoRepository $estadoRepository) {
                    return $estadoRepository->getEstadosResolucionIncidencia();
                }]
                )
                ->getForm();
                
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            $resultado = "No se pudo resolver Incidencia";
            if( $searchForm->isValid()) {
                $success = $incidenciaManager->resolverIncidencia($searchForm);
                if($success) {
                    $resultado = "Incidencia Resuelta";
                }
            }
        }

        return new Response($resultado);
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
