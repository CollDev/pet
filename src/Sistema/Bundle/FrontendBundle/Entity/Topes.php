<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\TopesRepository")
 */
class Topes
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
     * @ORM\Column(name="descripcion", type="string", length=200)
     */
    private $descripcion;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Indicador")
     */
    private $indicador;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\UnidadMedida")
     */
    private $unidad_medida;

    /**
     * @var float
     *
     * @ORM\Column(name="acumulado", type="decimal", precision=10, scale=2)
     */
    private $acumulado;

    /**
     * @var float
     *
     * @ORM\Column(name="previo", type="decimal", precision=10, scale=2)
     */
    private $previo;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true)
     */
    private $fecha_registro;


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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Topes
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set indicador
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Indicador $indicador
     * @return Topes
     */
    public function setIndicador(\Sistema\Bundle\FrontendBundle\Entity\Indicador $indicador)
    {
        $this->indicador = $indicador;
    
        return $this;
    }

    /**
     * Get indicador
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\Indicador 
     */
    public function getIndicador()
    {
        return $this->indicador;
    }

    /**
     * Set unidad_medida
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\UnidadMedida $unidadMedida
     * @return Topes
     */
    public function setUnidadMedida(\Sistema\Bundle\FrontendBundle\Entity\UnidadMedida $unidadMedida)
    {
        $this->unidad_medida = $unidadMedida;
    
        return $this;
    }

    /**
     * Get unidad_medida
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\UnidadMedida 
     */
    public function getUnidadMedida()
    {
        return $this->unidad_medida;
    }

    /**
     * Set acumulado
     *
     * @param float $acumulado
     * @return Topes
     */
    public function setAcumulado($acumulado)
    {
        $this->acumulado = $acumulado;
    
        return $this;
    }

    /**
     * Get acumulado
     *
     * @return float 
     */
    public function getAcumulado()
    {
        return $this->acumulado;
    }

    /**
     * Set previo
     *
     * @param float $previo
     * @return Topes
     */
    public function setPrevio($previo)
    {
        $this->previo = $previo;
    
        return $this;
    }

    /**
     * Get previo
     *
     * @return float 
     */
    public function getPrevio()
    {
        return $this->previo;
    }

    /**
     * Set fecha_registro
     *
     * @param \DateTime $fecha_registro
     * @return Topes
     */
    public function setFechaRegistro(\DateTime $fecha_registro) {
        $this->fecha_registro = $fecha_registro;
        
        return $this;
    }

    
    /**
     * Get fecha_registro
     * 
     * @return \DateTime
     */
    public function getFechaRegistro() {
        return $this->fecha_registro;
    }


}
