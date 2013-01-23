<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BalanzaController
 *
 * @author Administrator
 */
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 *  @Route("/balanza")
 */
class BalanzaController extends Controller
{
    /**
     * @Route("/peso", name="balanza_peso")
     * 
     */
    public function obtenerPeso()
    {
        $peso = $this->getPesoBalanza();
        return new Response($peso);
    }
    
    private function getPesoBalanza()
    {
        return rand(100,10000);
    }
}

?>
