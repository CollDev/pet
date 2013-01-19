<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MovimientoIndicador
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\MovimientoIndicadorRepository")
 */
class MovimientoIndicador
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
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Indicador")
     */
    private $indicador;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor", type="integer")
     */
    private $valor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_movimiento", type="datetime")
     */
    private $fecha_movimiento;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Estado")
     */
    private $estado;


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
     * Set indicador
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Indicador $indicador
     * @return MovimientoIndicador
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
     * Set valor
     *
     * @param integer $valor
     * @return MovimientoIndicador
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return integer 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set fecha_movimiento
     *
     * @param \DateTime $fechaMovimiento
     * @return MovimientoIndicador
     */
    public function setFechaMovimiento($fechaMovimiento)
    {
        $this->fecha_movimiento = $fechaMovimiento;
    
        return $this;
    }

    /**
     * Get fecha_movimiento
     *
     * @return \DateTime 
     */
    public function getFechaMovimiento()
    {
        return $this->fecha_movimiento;
    }

    /**
     * Set estado
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Estado $estado
     * @return MovimientoIndicador
     */
    public function setEstado(\Sistema\Bundle\FrontendBundle\Entity\Estado $estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
