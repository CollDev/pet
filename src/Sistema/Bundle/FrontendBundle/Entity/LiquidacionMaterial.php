<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LiquidacionMaterial
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\LiquidacionMaterialRepository")
 */
class LiquidacionMaterial
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
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Cliente")
     */
    private $cliente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_liquidacion", type="datetime")
     */
    private $fecha_liquidacion;

    /**
     * @var float
     *
     * @ORM\Column(name="importe", type="decimal", precision=10, scale=2)
     */
    private $importe;


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
     * Set cliente
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Cliente $cliente
     * @return LiquidacionMaterial
     */
    public function setCliente(\Sistema\Bundle\FrontendBundle\Entity\Cliente $cliente)
    {
        $this->cliente = $cliente;
    
        return $this;
    }

    /**
     * Get cliente
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set fecha_liquidacion
     *
     * @param \DateTime $fechaLiquidacion
     * @return LiquidacionMaterial
     */
    public function setFechaLiquidacion($fechaLiquidacion)
    {
        $this->fecha_liquidacion = $fechaLiquidacion;
    
        return $this;
    }

    /**
     * Get fecha_liquidacion
     *
     * @return \DateTime 
     */
    public function getFechaLiquidacion()
    {
        return $this->fecha_liquidacion;
    }

    /**
     * Set importe
     *
     * @param float $importe
     * @return LiquidacionMaterial
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;
    
        return $this;
    }

    /**
     * Get importe
     *
     * @return float 
     */
    public function getImporte()
    {
        return $this->importe;
    }
}
