<?php
namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;

class EstadoManager extends BaseManager
{
    public function __construct(ObjectManager $om, $fqnClass)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($fqnClass);
        $this->class = $fqnClass;
    }
    
    public function noExistenEstados()
    {
        $estados = $this->repository->findAll();
        $estadosEsperados = ['Pendiente', 'Confirmado', 'Atendido'];
        
        foreach($estados as $estado) {
            $nombreEstados[] = $estado->getNombre();
        }
        
        $noExisten = false;
        
        foreach($estadosEsperados as $estadoEsperado) {
            if(!in_array($estadoEsperado, $nombreEstados)) {
                $noExisten = true;
                break;
            }
        }
        
        return $noExisten;
    }
    
    public function crearEstados()
    {
        $estadosEsperados = ['Pendiente', 'Confirmado', 'Atendido'];
        
        foreach($estadosEsperados as $estadoEsperado) {
            $estado = $this->repository->findOneBy(['nombre' => $estadoEsperado]);
            if(is_null($estado)) {
                $newEstado = $this->crearEntidad();
                $newEstado->setNombre($estadoEsperado);
                $this->guardar($newEstado);
            }
        }
        
    }
    
    
    
}

?>
