<?php

namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sistema\Bundle\FrontendBundle\Entity\UnidadMedida;
use Sistema\Bundle\FrontendBundle\Entity\Material;
use Sistema\Bundle\FrontendBundle\Entity\Cliente;
use Sistema\Bundle\FrontendBundle\Entity\Estado;
use Sistema\Bundle\FrontendBundle\Entity\Indicador;
use Sistema\Bundle\FrontendBundle\Entity\Topes;
use Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion;

use Sistema\Bundle\FrontendBundle\Entity\Unidad;
use Symfony\Component\Security\Core\SecurityContext;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="inicio")
     * @Template()
     */
    public function indexAction()
    {
        $usuario= $this->get('security.context')->getToken()->getUser();
        $isPerfilSupervisor = ($usuario->getPerfil() == 1) ;
        $this->updateDatabase();
        return ['isPerfilSupervisor' => $isPerfilSupervisor];
    }
    
    private function updateDatabase()
    {
        $estadoManager = $this->get('estado.manager');
        if($estadoManager->noExistenEstados()) {
            $estadoManager->crearEstados();
        }
            
    }
    
    public function loginAction()
    {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();
        $error = $peticion->attributes->get(
            SecurityContext::AUTHENTICATION_ERROR,
            $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );
        return $this->render('FrontendBundle:Default:login.html.twig', [
        'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
        'error' => $error, 'title' => 'Sistema Información'
        ]);
    }
    
    /**
     * @Route("/usuario/autenticado", name="usuario_autenticado")
     * @Template()
     */
    public function usuarioAutenticadoAction()
    {
        $usuario= $this->get('security.context')->getToken()->getUser();
        if($usuario->getPerfil() == 1) {
            $nombrePerfil = 'Supervisor';
        }
        else if ($usuario->getPerfil() == 1) {
            $nombrePerfil = 'Usuario';
        }
        else {
            $nombrePerfil = 'Jefe de Planta';
        }
        
        return  ['usuario' => $usuario, 'perfil' => $nombrePerfil ];
    }
    
    /**
     * @Route("/menu/listar", name="menu_listar")
     * @Template()
     */
    public function menuAction()
    {
        $usuario= $this->get('security.context')->getToken()->getUser();
        
        if($usuario->getPerfil() == 1) {
            $nombrePerfil = 'Supervisor';
        }
        else if ($usuario->getPerfil() == 1) {
            $nombrePerfil = 'Usuario';
        }
        else {
            $nombrePerfil = 'Jefe de Planta';
        }
        
        return  ['usuario' => $usuario, 'perfil' => $nombrePerfil ];
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
        /*
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
        */
      /*  
      $indicador = new Indicador();
      $indicador->setNombre('Porcentaje Tope');
      $indicador->setEstandar('SI');
      $em->persist($indicador);
      */
      $unidadMedida = $em->getRepository('FrontendBundle:UnidadMedida')->find(1);
      $indicador = $em->getRepository('FrontendBundle:Indicador')->find(11);
      /*$tope = new Topes();
      $tope->setDescripcion('Tope');
      $tope->setIndicador($indicador);
      $tope->setUnidadMedida($unidadMedida);
      $tope->setAcumulado(10);
      $tope->setPrevio(0);
      $em->persist($tope);
      */
      $tope2 = new Topes();
      $tope2->setDescripcion('Tope');
      $tope2->setIndicador($indicador);
      $tope2->setUnidadMedida($unidadMedida);
      $tope2->setAcumulado(20);
      $tope2->setPrevio(10);
      $em->persist($tope2);
      
      $em->flush();
        
        
        return [];
    }
    
    /**
     * @Route("/cargarTopeDatos", name="carga_tope_datos")
     * 
     */
    public function cargarTopeDatosAction()
    {
      $em = $this->getDoctrine()->getManager(); 
      $indicador = new Indicador();
      $indicador->setNombre('Porcentaje Tope');
      $indicador->setEstandar('SI');
      $em->persist($indicador);
      $unidadMedida = $em->getRepository('FrontendBundle:UnidadMedida')->find(1);
      
      $tope = new Topes();
      $tope->setDescripcion('Tope');
      $tope->setIndicador($indicador);
      $tope->setUnidadMedida($unidadMedida);
      $tope->setAcumulado(10);
      $tope->setPrevio(0);
      $em->persist($tope);
      
      $tope2 = new Topes();
      $tope->setDescripcion('Tope');
      $tope->setIndicador($indicador);
      $tope->setUnidadMedida($unidadMedida);
      $tope->setAcumulado(20);
      $tope->setPrevio(10);
      $em->persist($tope2);
      
      $em->flush();
      
      return $this->render('FrontendBundle:Default:cargaDatos.html.twig', []);
    }
    
    
}
