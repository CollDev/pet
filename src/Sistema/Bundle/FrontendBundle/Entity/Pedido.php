<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\PedidoRepository")
 */
class Pedido
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
     * @ORM\Column(name="fecha_programacion", type="datetime")
     */
    private $fecha_programacion;

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
     * Set cliente
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Cliente $cliente
     * @return Pedido
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
     * Set fecha_programacion
     *
     * @param \DateTime $fechaProgramacion
     * @return Pedido
     */
    public function setFechaProgramacion($fechaProgramacion)
    {
        $this->fecha_programacion = $fechaProgramacion;
    
        return $this;
    }

    /**
     * Get fecha_programacion
     *
     * @return \DateTime 
     */
    public function getFechaProgramacion()
    {
        return $this->fecha_programacion;
    }

    /**
     * Set estado
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Estado $estado
     * @return Pedido
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
