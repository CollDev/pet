<?php
namespace Sistema\Bundle\FrontendBundle\Service\Aviso;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aviso
 *
 * @author Administrator
 */
class Aviso
{
    //put your code here
    private $titulo;
    private $fechaAviso;
    private $dias;
    
    public function __construct($titulo, $fechaAviso)
    {
        $this->titulo = $titulo;
        $this->fechaAviso = $fechaAviso;
        $hoy = new \DateTime();
        $this->dias = date_diff(new \DateTime($hoy->format('Y-m-d')) , $this->fechaAviso)->format('%R%a dias');
    }
    
    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getFechaAviso() {
        return $this->fechaAviso;
    }

    public function setFechaAviso($fechaAviso) {
        $this->fechaAviso = $fechaAviso;
    }

    public function getDias() {
        return $this->dias;
    }

    public function setDias($dias) {
        $this->dias = $dias;
    }


}

?>
