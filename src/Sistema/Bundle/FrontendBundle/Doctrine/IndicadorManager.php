<?php
namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;

class IndicadorManager extends BaseManager
{
    const TOPE_MAXIMO = 18000;
    
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
            
            if($indicador->getNombre() == 'Tope') {
                $valor = $this->procesarTope();
                $indicador->setValor($valor);
                $indicador->setTipoId(1);
                $indicador->setTipoIndicador("Indicador de Tope");
                $this->guardar($indicador);
                $estado = $this->calcularEstadoDirecto($indicador);
                $falta = self::TOPE_MAXIMO - $valor;
                $observacion = $falta. ' ' . $indicador->getObservacion();
                
            }
            else if($indicador->getNombre() == 'Mantenimiento') {
                $valor = $this->procesarMantenimiento();
                $indicador->setValor($valor);
                $indicador->setTipoId(2);
                $indicador->setTipoIndicador("Indicador de Mantenimiento");
                $this->guardar($indicador);
                $estado = $this->calcularEstadoIndirecto($indicador);
                $observacion = $indicador->getValor(). ' ' . $indicador->getObservacion();
            }
            else if($indicador->getNombre() == 'Nro Unidades') {
                
                $valor = $this->procesarUnidades();
                $indicador->setValor($valor);
                $indicador->setTipoId(2);
                $indicador->setTipoIndicador("Indicador de Mantenimiento");
                $this->guardar($indicador);
                $estado = $this->calcularEstadoDirecto($indicador);
                $observacion = $indicador->getValor(). ' ' . $indicador->getObservacion();
            }
            else if($indicador->getTipoId() == 4) {
                $estado = $this->calcularEstadoIndirecto($indicador);
                $observacion = $indicador->getValor(). ' ' . $indicador->getObservacion();
            }
            else {
                $estado = $this->calcularEstadoDirecto($indicador);
                $observacion = $indicador->getValor(). ' ' . $indicador->getObservacion();
            }
            
            
            if(!isset($indicadoresReporte[$indicador->getTipoId()])) {
                $indicadoresReporte[$indicador->getTipoId()] = [];
                $indicadoresReporte[$indicador->getTipoId()]['titulo'] = $indicador->getTipoIndicador();
                
            }
            
            $indicadoresReporte[$indicador->getTipoId()]['data'][] = ['nombre' => $nombre, 'valor' =>$indicador->getValor(), 'inferior' => $indicador->getInferior(),
                'superior'=> $indicador->getSuperior(), 'estado' => $estado,
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
            
            if($signo == 0 || $dias == 0) {
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
    
    public function generarIndicadoresIncidencia($incidencias)
    {
        foreach($incidencias as $incidencia) {
            
            if($this->repository->indicadorExiste($incidencia['nombre'])) {
                $indicador = $this->repository->findOneBy(['nombre' => $incidencia['nombre']]);
                $indicador->setValor($incidencia['total']);
                $indicador->setTipoId(3);
                $indicador->setTipoIndicador("Indicador de Incidencias");
                $this->guardar($indicador);
            }
            else {
                $indicador = $this->crearEntidad();
                $indicador->setNombre($incidencia['nombre']);
                $indicador->setValor($incidencia['total']);
                $indicador->setTipoId(3);
                $indicador->setTipoIndicador("Indicador de Incidencias");
                $indicador->setEstandar('SI');
                $this->guardar($indicador);
                
            }
        }
    }
   
    public function generarIndicadoresStock($stocks)
    {
        foreach($stocks as $stock) {
            
            if($this->repository->indicadorExiste($stock->getNombre())) {
                $indicador = $this->repository->findOneBy(['nombre' => $stock->getNombre()]);
                $indicador->setValor($stock->getStock());
                 $indicador->setTipoId(4);
                $indicador->setTipoIndicador("Indicador de Stock de Materiales");
                $this->guardar($indicador);
            }
            else {
                $indicador = $this->crearEntidad();
                $indicador->setNombre($stock->getNombre());
                $indicador->setValor($stock->getStock());
                 $indicador->setTipoId(4);
                $indicador->setTipoIndicador("Indicador de Stock de Materiales");
                $indicador->setEstandar('SI');
                $this->guardar($indicador);
                
            }
        }
    }
    
    
    public function obtenerIndicadores()
    {
        $indicadores = $this->repository->findAll();
        
        $indicadoresReporte = [];
        
        foreach($indicadores as $indicador) {
            $nombre = $indicador->getNombre();
            if($nombre == 'Mantenimiento') {
                $estado = $this->calcularEstadoIndirecto($indicador);    
            }
            else {
                $estado = $this->calcularEstadoDirecto($indicador);
            }
            $observacion = $indicador->getValor(). ' ' . $indicador->getObservacion();
            
            
           if(!isset($indicadoresReporte[$indicador->getTipoId()])) {
                $indicadoresReporte[$indicador->getTipoId()] = [];
                $indicadoresReporte[$indicador->getTipoId()]['titulo'] = $indicador->getTipoIndicador();
                
            }
            
            $indicadoresReporte[$indicador->getTipoId()]['data'][] = ['nombre' => $nombre, 'valor' =>$indicador->getValor(), 'inferior' => $indicador->getInferior(),
                'superior'=> $indicador->getSuperior(), 'estado' => $estado,
                'observacion' => $observacion];
        }
        return $indicadoresReporte;        
        
    }
    
    public function getStocks()
    {
         $materialRepository = $this->objectManager
                ->getRepository('FrontendBundle:Material');
         
         return $materialRepository->getMateriales()->getQuery()->getResult();
    }
}

?>
