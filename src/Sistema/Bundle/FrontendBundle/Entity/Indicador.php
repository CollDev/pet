<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicador
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\IndicadorRepository")
 */
class Indicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="estandar", type="string", length=200)
     */
    private $estandar;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="tipo_id", type="integer", nullable=true)
     * 
     */
    private $tipo_id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tipo_indicador", type="string", length=200, nullable=true)
     */
    private $tipo_indicador;
    
    /**
     * @var float
     * 
     * @ORM\Column(name="inferior", type="decimal", precision=10, scale=2, nullable=true )
     */
    private $inferior;

    /**
     * @var float
     * 
     * @ORM\Column(name="superior", type="decimal", precision=10, scale=2, nullable=true )
     */
    private $superior;
            
    /**
     * @var float
     * 
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $valor;
    
     /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=200, nullable=true)
     */
    private $observacion;
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Indicador
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set estandar
     *
     * @param string $estandar
     * @return Indicador
     */
    public function setEstandar($estandar)
    {
        $this->estandar = $estandar;
    
        return $this;
    }

    /**
     * Get estandar
     *
     * @return string 
     */
    public function getEstandar()
    {
        return $this->estandar;
    }
    
    /*
     * Get tipo_id
     * 
     * @return integer
     */
    public function getTipoId() {
        return $this->tipo_id;
    }
    
    /**
     * Set tipo_id
     * 
     * @param integer $tipo_id
     * @return Indicador
     */
    public function setTipoId($tipo_id) {
        $this->tipo_id = $tipo_id;
        
        return $this;
    }
    
    /*
     * Get tipo_indicador
     * 
     * @return string
     */
    public function getTipoIndicador() {
        return $this->tipo_indicador;
    }
    
    /**
     * Set tipo_indicador
     * 
     * @param string $tipo_indicador
     * @return Indicador
     */
    public function setTipoIndicador($tipo_indicador) {
        $this->tipo_indicador = $tipo_indicador;
        
        return $this;
    }

        /**
     * Get inferior
     *
     * @return float
     */
    public function getInferior() {
        return $this->inferior;
    }
    
    /**
     * Set inferior
     *
     * @param float $inferior
     * @return Indicador
     */
    public function setInferior($inferior) {
        $this->inferior = $inferior;
        
        return $this;
    }
    
    /**
     * Get superior
     *
     * @return float
     */
    public function getSuperior() {
        return $this->superior;
    }

    /**
     * Set superior
     *
     * @param float $superior
     * @return Indicador
     */
    public function setSuperior($superior) {
        $this->superior = $superior;
        
        return $this;
    }
     
    /**
     * Get valor
     *
     * @return float
     */   
    public function getValor() {
        return $this->valor;
    }
    
    /**
     * Set valor
     *
     * @param float $valor
     * @return Indicador
     */
    public function setValor($valor) {
        $this->valor = $valor;
    }
    
    /**
     * Set observacion
     *
     * @param string $observacion
     * @return Indicador
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;
    
        return $this;
    }

    /**
     * Get observacion
     *
     * @return string 
     */
    public function getObservacion()
    {
        return $this->observacion;
    }



}
