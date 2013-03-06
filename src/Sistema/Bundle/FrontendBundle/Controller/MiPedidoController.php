<?php
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


class MiPedidoController extends Controller
{
    
    /**
     * @Route("/listarGrilla", defaults={"_format"="xml"}, name="mi_pedido_listar_grilla")
     */
    public function listarGrillaAction()
    {
        return new Response('<?xml version="1.0" encoding="utf-8"');
    }
    
}

?>
 