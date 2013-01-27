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
     * @Route("/registrar", name="material_registrar")
     * @Method({"GET", "POST"})
     * @Template()
     * 
     */
    public function registrarAction()
    {
        $request = $this->getRequest();
        $recepcionMaterialManager = $this->get('recepcion_material.manager');
        $recepcionMaterial = $recepcionMaterialManager->crearEntidad();
        $form = $this->createForm(new RecepcionMaterialType(), $recepcionMaterial);
        
        
        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->isValid()) {
                $accion = $form->get('accion')->getData();
                $recepcionMaterial = $form->getData();
                
                if(empty($accion)) {
                    $recepcionMaterialManager->guardar($recepcionMaterial);
                }
                else {
                    $recepcionMaterialId = $form->get('recepcion_material')->getData();
                    $recepcionMaterialManager->editar($recepcionMaterialId, $recepcionMaterial);
                }
                
                //return $this->render('FrontendBundle:Material:formularioMaterial.html.twig', ['form' => $form->createView()] );
                //$this->redirect($url);
            }                
        }

        
        return ['form' => $form->createView()];
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
