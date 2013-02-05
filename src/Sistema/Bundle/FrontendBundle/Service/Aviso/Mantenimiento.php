<?php
namespace Sistema\Bundle\FrontendBundle\Service\Aviso;

class Mantenimiento implements AvisoInterface
{
    //put your code here
    private $manager;
    private $factory;
    private $avisos;
    
    public function __construct($manager, $factory)
    {
        $this->manager = $manager;
        $this->factory = $factory;
        $this->avisos = [];
    }
    
    public function getAvisosMantenimiento($dias)
    {
        $unidades = $this->manager->getUnidadesConMantenimientoPreventivo($dias);
        return $this->getAvisos($unidades);
    }
    
    public function getAvisos($unidades)
    {
        foreach($unidades as $unidad)
        {
            $this->avisos[] = $this->factory->getAviso($unidad, $unidad->getFechaMantenimiento());
        }
        
        return $this->avisos;
    }
    
    
    
}

?>
