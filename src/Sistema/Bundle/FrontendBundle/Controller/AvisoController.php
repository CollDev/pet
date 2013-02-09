<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/avisos")
 */
class AvisoController extends Controller
{
    
    /**
     * @Route("/listar/mantenimiento", name="listar_avisos_mantenimiento")
     * @Template()
     */
    public function listarAvisosMantenimientoAction()
    {
        $aviso = $this->get('aviso_mantenimiento.service');
        $avisos = $aviso->getAvisosMantenimiento(5);
        return ['avisos' => $avisos ];
    }
    
    /**
     * @Route("/listar/tope", name="listar_avisos_tope")
     * @Template()
     */
    public function listarAvisosTopeAction()
    {
        $aviso = $this->get('aviso_tope.service');
        $avisos = $aviso->getAvisosTope(5);
        return ['avisos' => $avisos];
        
    }
    
}

?>
