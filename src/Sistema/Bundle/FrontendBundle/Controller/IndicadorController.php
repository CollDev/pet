<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sistema\Bundle\FrontendBundle\Form\IncidenciaType;

/**
 * @Route("/indicadores")
 */
class IndicadorController extends Controller
{
    /**
     * @Route("/analizar", name="indicador_analizar")
     * @Template()
     */
    public function analizarIndicadoresAction()
    {
        
        $request = $this->getRequest();
        $recepcionMaterialManager = $this->get('recepcion_material.manager');
        
        $form = $this->createFormBuilder()
                ->add('fecha_inicio','date', ['widget' => 'single_text'])
                ->add('fecha_fin','date', ['widget' => 'single_text'])
                ->getForm()
                ;
        $mensaje = "";
        $indicadores = [];
        if ($request->isMethod('POST')) {

            $form->bind($request);
            
            if ($form->isValid()) {
                
                $fechas = $form->getData();
                
                if($this->isFechaCorrecta($fechas)) {
                    $indicadores = $recepcionMaterialManager->analizarIndicadores($fechas);
                    
                }
                else {
                    
                    $mensaje ="Corrija las fechas, no son válidas";
                }
                
        
            }                
        }
        
        return ['form' => $form->createView(), 'mensaje' => $mensaje, 
            'indicadores' => $indicadores];
        
    }
    
    private function isFechaCorrecta($fechas)
    {
        $fechaInicio = $fechas['fecha_inicio'];
        $fechaFin = $fechas['fecha_fin'];
        
        $intervalo = date_diff($fechaInicio, $fechaFin);
        $valorIntervalo = $intervalo->format('%R');
        return ($valorIntervalo != '-') ;
    }
    
}

?>
