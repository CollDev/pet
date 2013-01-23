<?php

namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sistema\Bundle\FrontendBundle\Entity\UnidadMedida;
use Sistema\Bundle\FrontendBundle\Entity\Material;
use Sistema\Bundle\FrontendBundle\Entity\Cliente;
use Sistema\Bundle\FrontendBundle\Entity\Estado;
use Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion;
use Sistema\Bundle\FrontendBundle\Entity\Unidad;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="inicio")
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }
    
    /**
     * @Route("/base")
     * @Template()
     */
    public function baseAction()
    {
        return [];
    }
    
    /**
     * @Route("/cargaDatos")
     * @Template()
     */
    public function cargarDatosAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        /*$unidadMedida = new UnidadMedida();
        $unidadMedida->setNombre('TN');
        $unidadMedida->setValor(1000000);
        $em->persist($unidadMedida);
        
        $unidadMedida2 = new UnidadMedida();
        $unidadMedida2->setNombre('KG');
        $unidadMedida2->setValor(1000);
        $em->persist($unidadMedida2);
        
        
        $material = new Material();
        $material->setNombre('Plastico');
        $material->setStock(100);
        $em->persist($material);
        $material2 = new Material();
        $material2->setNombre('Vidrio');
        $material2->setStock(100);
        $em->persist($material2);

        
        $estado = new Estado();
        $estado->setNombre('Activo');
        $em->persist($estado);
        $em->flush();
        
        $estado2 = new Estado();
        $estado2->setNombre('Inactivo');
        $em->persist($estado2);
         */
        $estado = $em->getRepository('FrontendBundle:Estado')->find(1);
        /*
        $cliente = new Cliente();
        $cliente->setDireccion('Av. Valle 124');
        $cliente->setRuc('12345678901');
        $cliente->setRazonSocial('Valle Distribuciones S.A.C.');
        $cliente->setEstado($estado);
        $em->persist($cliente);
        $em->flush();
        */
        $cliente = $em->getRepository('FrontendBundle:Cliente')->find(1);
        
        $unidad = new Unidad();
        $unidad->setFechaMantenimiento(new \DateTime());
        $unidad->setEstado($estado);
        $unidad->setKilometraje(100);
        $unidad->setMarca('Ford');
        $unidad->setTiempo(new \DateTime());
        $em->persist($unidad);
        $em->flush();
        
        $boletaRecepcion = new BoletaRecepcion();
        $boletaRecepcion->setCliente($cliente);
        $boletaRecepcion->setFechaIngreso(new \DateTime("now"));
        $boletaRecepcion->setFechaSalida(new \DateTime("now"));
        $boletaRecepcion->setNeto(1000.12);
        $boletaRecepcion->setTara(10.2);
        $boletaRecepcion->setTotal(1005.2);
        $boletaRecepcion->setUnidad($unidad);
        $em->persist($boletaRecepcion);
        $em->flush();
        
        return [];
    }
}
