<?php
namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;

class IndicadorManager extends BaseManager
{
    const TOPE_MAXIMO = 8000;
    
    public function __construct(ObjectManager $om, $fqnClass)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($fqnClass);
        $this->class = $fqnClass;
    }
    
    public function procesarIndicadores()
    {
        $indicadores = $this->repository->findAll();
        
        $indicadoresReporte = [];
        foreach($indicadores as $indicador)
        {
            $nombre = $indicador->getNombre();
            
            if($indicador->getNombre() == 'Porcentaje Tope') {
                $valor = $this->procesarTope();
                $indicador->setValor($valor);
                $this->guardar($indicador);
                $estado = $this->calcularEstadoDirecto($indicador);
                $falta = self::TOPE_MAXIMO - $valor;
                $observacion = $falta. ' ' . $indicador->getObservacion();
                
            }
            else if($indicador->getNombre() == 'Mantenimiento') {
                $valor = $this->procesarMantenimiento();
                $indicador->setValor($valor);
                $this->guardar($indicador);
                $estado = $this->calcularEstadoIndirecto($indicador);
                $observacion = $indicador->getValor(). ' ' . $indicador->getObservacion();
            }
            else if($indicador->getNombre() == 'Nro Unidades') {
                
                $valor = $this->procesarUnidades();
                $indicador->setValor($valor);
                $this->guardar($indicador);
                $estado = $this->calcularEstadoDirecto($indicador);
                $observacion = $indicador->getValor(). ' ' . $indicador->getObservacion();
            }
            else {
                $estado = $this->calcularEstadoDirecto($indicador);
                $observacion = $indicador->getValor(). ' ' . $indicador->getObservacion();
            }
            
            
            
            
            $indicadoresReporte[] = ['nombre' => $nombre, 'estado' => $estado,
                'observacion' => $observacion];
        }

        return $indicadoresReporte;
    }
    
    private function procesarTope() {
        $topeRepository = $this->objectManager->getRepository('FrontendBundle:Topes');
        $tope = $topeRepository->getUltimoTopeAcumulado();
        return $tope->getAcumulado();
    }
    
    private function procesarMantenimiento()
    {
        $unidadRepository = $this->objectManager->getRepository('FrontendBundle:Unidad');
        $unidades = $unidadRepository->findAll();
        $totalDias = 0;
        $totalUnidades = 0;
        foreach($unidades as $unidad) {
            $intervalo = date_diff(new \DateTime(), $unidad->getFechaMantenimiento() );
            $dias = $intervalo->d;
            $signo = $intervalo->invert;
            
            if($signo == 0 ) {
                $totalDias += $dias;
                $totalUnidades++;
            }
        }
        $promedioDias = ($totalUnidades > 0)? floor($totalDias/$totalUnidades):0;
        return $promedioDias;
        
    }
    
    private function procesarUnidades()
    {
        $indicadorMantenimiento = $this->repository->findOneBy(['nombre' => 'Mantenimiento']);
        $unidadRepository = $this->objectManager->getRepository('FrontendBundle:Unidad');
        $unidades = $unidadRepository->findAll();
        $total = 0;
        foreach($unidades as $unidad) {
            $intervalo = date_diff(new \DateTime(), $unidad->getFechaMantenimiento() );
            
            $dias = ($intervalo->days);
            $signo = $intervalo->invert;
            
            if($signo == 0 ) {
                if ($dias <= $indicadorMantenimiento->getInferior()) {
                    $total++;
                }
            }
        }
               
        return $total;
    }
    
    private function calcularEstadoDirecto($indicador)
    {
        $estado = 'verde';
        $valor = $indicador->getValor();
        $inferior = $indicador->getInferior();
        $superior = $indicador->getSuperior();
        
        if($valor <= $inferior) {
            $estado = 'verde';
        }
        else if ($valor > $inferior && $valor < $superior) {
            $estado = 'amarillo';
        }
        else if($valor >= $superior) {
            $estado = 'rojo';
        }
        
        return $estado;
    }
    
    private function calcularEstadoIndirecto($indicador)
    {
        $estado = 'verde';
        $valor = $indicador->getValor();
        $inferior = $indicador->getInferior();
        $superior = $indicador->getSuperior();
        
        if($valor <= $inferior) {
            $estado = 'rojo';
        }
        else if ($valor > $inferior && $valor < $superior) {
            $estado = 'amarillo';
        }
        else if($valor >= $superior) {
            $estado = 'verde';
        }
        
        return $estado;
        
    }
}

?>
