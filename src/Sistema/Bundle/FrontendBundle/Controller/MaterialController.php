<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MaterialController
 *
 * @author Administrator
 */


namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

use Sistema\Bundle\FrontendBundle\Entity\RecepcionMaterial;
use Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion;
use Sistema\Bundle\FrontendBundle\Form\RecepcionMaterialType;
/**
 * @Route("/materiales")
 */
class MaterialController extends Controller
{
    
    /**
     * @Route("/recepcionar", name="material_recepcionar")
     * @Template()
     */
    public function recepcionAction()
    {
        $request = $this->getRequest();
        $boletaRecepcionId = $request->query->get('id',0);
        $formBuilder = $this->createFormBuilder();
        if($boletaRecepcionId != 0) {
            $formBuilder->add('boleta_recepcion','text', [ 'data' => $boletaRecepcionId,  'attr' => ['readonly' => true ] ]);
        }
        else {
            $formBuilder->add('boleta_recepcion','text', [ 'data' => '', 'attr' => ['readonly' => true ] ]);
        }
                    
        $form = $formBuilder->getForm();
        //var_dump($form->createView());exit;
        return ['form' => $form->createView()];
        
        
    }
    /**
     * @Route("/registrar", name="material_registrar")
     * @Method({"GET", "POST"})
     * @Template()
     * 
     */
    public function registrarAction()
    {
        $request = $this->getRequest();
        $boletaRecepcionId = $request->query->get('id',0);
        $accion = $request->query->get('accion',null);
        $recepcionMaterialId = $request->query->get('recepcionMaterial',0);
        $recepcionMaterialManager = $this->get('recepcion_material.manager');
        $boletaRecepcionManager = $this->get('boleta_recepcion.manager');
        $boletaRecepcion = $recepcionMaterialManager->getBoletaRecepcionByPk($boletaRecepcionId);
        
        if($recepcionMaterialId != 0) {
            
            $recepcionMaterial = $recepcionMaterialManager->findByPk($recepcionMaterialId);
        }
        else {
            $recepcionMaterial = $recepcionMaterialManager->crearEntidad();            
        }
        
        if(!is_null($boletaRecepcion)) {
            $recepcionMaterial->setBoletaRecepcion($boletaRecepcion);
            $isBoletaNoCompletada = ($boletaRecepcion->getEstado()->getNombre() == 'Completado')? false : true;
        }
        
        
        $form = $this->createForm(new RecepcionMaterialType($accion, $recepcionMaterialId), $recepcionMaterial);
        
        $mensaje = "";
        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->isValid()) {
                $accion = $form->get('accion')->getData();
                $recepcionMaterial = $form->getData();
                
                
                    
                    if(empty($accion)) {
                        if($recepcionMaterialManager->esMaterialUnico($recepcionMaterial)) {
                           $recepcionMaterialManager->guardarMaterial($recepcionMaterial);
                        }
                        else {
                            $mensaje = "Ya existe ese tipo de material";
                        }
                    }
                    else {
                        $recepcionMaterialId = $form->get('recepcion_material')->getData();
                        $recepcionMaterialManager->editar($recepcionMaterialId, $recepcionMaterial);
                    }
                
                //return $this->render('FrontendBundle:Material:formularioMaterial.html.twig', ['form' => $form->createView()] );
                //$this->redirect($url);
            }                
        }

        
        return ['form' => $form->createView(), 'mensaje' => $mensaje, 'isBoletaNoCompletada' => $isBoletaNoCompletada];
    }
    
    /**
     * @Route("/", defaults={"_format"="xml"}, name="material_listar")
     * @Method({"GET"})
     * @Template()
     */
    public function listarAction()
    {
        $request = $this->getRequest();
        $boletaRecepcionId = $request->query->get('boletaRecepcionId', 0);
        $recepcionMaterialRepository = $this->get('recepcion_material.repository');
        $recepcionMateriales = $recepcionMaterialRepository
            ->getRecepcionMaterialesPorBoletaRecepcionId($boletaRecepcionId);
        
        return ['recepcionMateriales' => $recepcionMateriales ];
    }
    
    /**
     * @Route("/eliminar", name="material_eliminar")
     */
    public function eliminarAction()
    {
        $request = $this->getRequest();
        $recepcionMaterialManager = $this->get('recepcion_material.manager');
        $recepcionMaterial = $recepcionMaterialManager->crearEntidad();
        $form = $this->createForm(new RecepcionMaterialType(), $recepcionMaterial);
        
        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->isValid()) {
                $accion = $form->get('accion')->getData();
                if(!empty($accion) && $accion =="eliminar") {
                    $recepcionMaterialId = $form->get('recepcion_material')->getData();
                    $recepcionMaterialManager->eliminarById($recepcionMaterialId);
                }
                else {
                    return new Reponse("Error al procesar la transacción");
                }
            }
        }
        
        return new Response("Registro Eliminado");
    }
    
    /**
     * @Route("/imprimir", name="material_imprimir")
     * @Template()
     */
    public function imprimirAction()
    {
        $request = $this->getRequest();
        $boletaRecepcionRepository = $this->get('boleta_recepcion.repository');
        $recepcionMaterialRepository = $this->get('recepcion_material.repository');
        
        $recepcionesMaterial = [];
        
        if ($request->isMethod('POST')) {
            $boletaRecepcionId = $request->request->get('boleta_impresion_id');
            $boletaRecepcion = $boletaRecepcionRepository->find($boletaRecepcionId);
            $recepcionesMaterial = $recepcionMaterialRepository
                ->findBy(['boleta_recepcion' =>  $boletaRecepcionId]);
        }
        
        return ['boletaRecepcion' => $boletaRecepcion, 'recepcionesMaterial' => $recepcionesMaterial];
    }
    
}

?>
