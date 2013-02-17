<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BoletaRecepcion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\BoletaRecepcionRepository")
 */
class BoletaRecepcion
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
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Unidad")
     */
    private $unidad;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime")
     */
    private $fecha_ingreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_salida", type="datetime")
     */
    private $fecha_salida;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="decimal", precision=10, scale=2)
     */
    private $total;

    /**
     * @var float
     *
     * @ORM\Column(name="tara", type="decimal", precision=10, scale=2)
     */
    private $tara;

    /**
     * @var float
     *
     * @ORM\Column(name="neto", type="decimal", precision=10, scale=2)
     */
    private $neto;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Estado")
     */
    private $estado;

    /**
     * Set id
     * 
     * @param integer $id
     * @return BoletaRecepcion
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }

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
     * @return BoletaRecepcion
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
     * Set vehiculo
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Unidad $unidad
     * @return BoletaRecepcion
     */
    public function setUnidad(\Sistema\Bundle\FrontendBundle\Entity\Unidad $unidad)
    {
        $this->unidad = $unidad;
    
        return $this;
    }

    /**
     * Get unidad
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\Unidad
     */
    public function getUnidad()
    {
        return $this->unidad;
    }

    /**
     * Set fecha_ingreso
     *
     * @param \DateTime $fechaIngreso
     * @return BoletaRecepcion
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fecha_ingreso = $fechaIngreso;
    
        return $this;
    }

    /**
     * Get fecha_ingreso
     *
     * @return \DateTime 
     */
    public function getFechaIngreso()
    {
        return $this->fecha_ingreso;
    }

    /**
     * Set fecha_salida
     *
     * @param \DateTime $fechaSalida
     * @return BoletaRecepcion
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fecha_salida = $fechaSalida;
    
        return $this;
    }

    /**
     * Get fecha_salida
     *
     * @return \DateTime 
     */
    public function getFechaSalida()
    {
        return $this->fecha_salida;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return BoletaRecepcion
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set tara
     *
     * @param float $tara
     * @return BoletaRecepcion
     */
    public function setTara($tara)
    {
        $this->tara = $tara;
    
        return $this;
    }

    /**
     * Get tara
     *
     * @return float 
     */
    public function getTara()
    {
        return $this->tara;
    }

    /**
     * Set neto
     *
     * @param float $neto
     * @return BoletaRecepcion
     */
    public function setNeto($neto)
    {
        $this->neto = $neto;
    
        return $this;
    }

    /**
     * Get neto
     *
     * @return float 
     */
    public function getNeto()
    {
        return $this->neto;
    }
    
    /**
     * Set estado
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Estado $estado
     * @return BoletaRecepcion
     */
    public function setEstado($estado) {
        
        $this->estado = $estado;
        
        return $this;
    }
    
    /**
     * @return  Sistema\Bundle\FrontendBundle\Entity\Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
    
    public function __construct()
    {
        $this->fecha_ingreso = new \DateTime();
        
    }
    
    public function __toString()
    {
        return 'BR-'.$this->getId();
    }    
}
