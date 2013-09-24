<?php
namespace Sistema\Bundle\FrontendBundle\Service\Aviso;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tope
 *
 * @author Administrator
 */
class Tope implements AvisoInterface
{
    const TOPE_MAXIMO = 5000;
    //put your code here
    private $manager;
    private $factory;
    private $avisos;
    private $dias;
    
    public function __construct($manager, $factory)
    {
        $this->manager = $manager;
        $this->factory = $factory;
        $this->avisos = [];
    }
    
    public function getAvisosTope($dias)
    {
        $tope = $this->manager->getUltimoTope();
        $this->dias = $dias;
        return $this->getAvisos([$tope]);
    }
    
    public function getAvisos($topes)
    {
        foreach($topes as $tope)
        {
            $this->avisos[] = $this->factory->getAviso($tope->getDescripcion(), 
                    $this->getFechaAviso($tope));
        }
        
        return $this->avisos;
    }
    
    private function getFechaAviso($tope)
    {
        $fechaAviso = $this->manager->proyectarFechaAviso($tope, 
                self::TOPE_MAXIMO, $this->dias);
        return $fechaAviso;
    }
    
}

?>
