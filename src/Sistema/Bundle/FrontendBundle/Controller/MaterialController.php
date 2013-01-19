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

/**
 * @Route("/materiales")
 */
class MaterialController extends Controller
{
    /**
     * @Route("/", name="material_registrar")
     * @Method({"GET"})
     * @Template()
     * 
     */
    public function registrarAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        return [];
    }
    
}

?>
