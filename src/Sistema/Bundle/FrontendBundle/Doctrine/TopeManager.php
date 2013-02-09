<?php
namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TopeManager
 *
 * @author Administrator
 */
class TopeManager extends BaseManager
{
    //put your code here
    public function __construct(ObjectManager $om, $fqnClass)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($fqnClass);
        $this->class = $fqnClass;
    }
   
    public function proyectarFechaAviso($tope, $topeMaximo, $dias)
    {
        $topes = $this->repository->getQueryTopesDesdeUltimoTopeInicial()
                    ->getResult();
        $acumuladoPromedioPorDia = $this->calcularTopePromedioPorDia($topes);
        
        $diasParaLlenarTope = 
            $this->calcularDiasParaLlenarTope($acumuladoPromedioPorDia,
                  $tope->getAcumulado(),
                  $topeMaximo);
        
        $fechaAviso = $this->calcularFechaAviso($tope->getFechaRegistro(),
                $diasParaLlenarTope);
        
        return $fechaAviso;
        
    }
    
    private function calcularTopePromedioPorDia($topes)
    {
        $acumulado = 0;
        $totalTopes = (count($topes) > 0)?count($topes):1;
        foreach($topes as $tope) {
            $acumulado += $tope->getAcumulado() - $tope->getPrevio();
        }
        
        return $acumulado/ $totalTopes;
    }
    
    private function calcularDiasParaLlenarTope($acumuladoPromedioPorDia,
            $acumuladoActual, $topeMaximo)
    {
        $porLlenar = $topeMaximo - $acumuladoActual;
        
        $dias = ceil( $porLlenar/$acumuladoPromedioPorDia );
        return $dias;
    }
    
    private function calcularFechaAviso($fechaRegistro, $diasParaLLenarTope)
    {
        $fechaRegistro->add(new \DateInterval('P'.abs($diasParaLLenarTope).'D'));
        return $fechaRegistro;
    }
    
    public function actualizarTope($boletaRecepcion)
    {
        $pesoDesperdicio = $this->calcularDesperdicio($boletaRecepcion);
        
        $tope = $this->getUltimoTope();
        
        $esFechaDiferente = $this->esFechaDiferente($boletaRecepcion->getFechaSalida(), 
                $tope->getFechaRegistro());
        
        if($esFechaDiferente) {
            $tope = $this->crearNuevoTope();
        }
        $this->actualizarAcumulacionDesperdicioATope($pesoDesperdicio, $tope);
        
    }
    
    private function calcularDesperdicio($boletaRecepcion)
    {
        return $boletaRecepcion->getTotal() - $boletaRecepcion->getNeto();
    }
    
    public function getUltimoTope()
    {
        return $this->repository->getUltimoTope();
    }
    
    private function esFechaDiferente($fecha, $fechaAComparar)
    {
        return ($fecha->format('Y-m-d') != $fechaAComparar->format('Y-m-d'));
    }
    
    public function crearNuevoTope()
    {
        $ultimoTope = $this->getUltimoTope();
        $previo = $ultimoTope->getAcumulado();
        $indicador = $this->objectManager
            ->getRepository('FrontendBundle:Indicador')->find(11);
        
        $unidadMedida = $this->objectManager
            ->getRepository('FrontendBundle:UnidadMedida')->find(1);
        
        $tope = $this->crearEntidad();
        $tope->setIndicador($indicador);
        $tope->setUnidadMedida($unidadMedida);
        $tope->setDescripcion('Tope');
        $tope->setAcumulado($previo);
        $tope->setPrevio($previo);
        $hoyExacto = new \DateTime();
        $fechaHoy = new \DateTime($hoyExacto->format('Y-m-d'));
        $tope->setFechaRegistro($fechaHoy);
        $this->guardar($tope);
        
        return $tope;
    }
    
    public function actualizarAcumulacionDesperdicioATope($pesoDesperdicio, $tope)
    {
        $tope->setAcumulado($pesoDesperdicio + $tope->getAcumulado());
        $this->guardar($tope);
    }
}

?>
