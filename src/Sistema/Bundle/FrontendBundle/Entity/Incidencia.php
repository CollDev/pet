<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Incidencia
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\IncidenciaRepository")
 */
class Incidencia
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_incidencia", type="datetime")
     */
    private $fecha_incidencia;

    /**
     * @var string
     *
     * @ORM\Column(name="maquinaria", type="string", length=200, nullable=true)
     */
    private $maquinaria;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\TipoIncidencia")
     */
    private $tipo_incidencia;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Estado")
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=200)
     */
    private $observacion;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Unidad")
     */
    private $unidad;


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
     * Set fecha_incidencia
     *
     * @param \DateTime $fechaIncidencia
     * @return Incidencia
     */
    public function setFechaIncidencia($fechaIncidencia)
    {
        $this->fecha_incidencia = $fechaIncidencia;
    
        return $this;
    }

    /**
     * Get fecha_incidencia
     *
     * @return \DateTime 
     */
    public function getFechaIncidencia()
    {
        return $this->fecha_incidencia;
    }

    /**
     * Set maquinaria
     *
     * @param string $maquinaria
     * @return Incidencia
     */
    public function setMaquinaria($maquinaria)
    {
        $this->maquinaria = $maquinaria;
    
        return $this;
    }

    /**
     * Get maquinaria
     *
     * @return string 
     */
    public function getMaquinaria()
    {
        return $this->maquinaria;
    }

    /**
     * Set tipo
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\TipoIncidencia $tipoIncidencia
     * @return Incidencia
     */
    public function setTipoIncidencia(\Sistema\Bundle\FrontendBundle\Entity\TipoIncidencia $tipoIncidencia)
    {
        $this->tipo_incidencia = $tipoIncidencia;
    
        return $this;
    }

    /**
     * Get tipo_incidencia
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\TipoIncidencia 
     */
    public function getTipoIncidencia()
    {
        return $this->tipo_incidencia;
    }

    /**
     * Set estado
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion $estado
     * @return Cliente
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

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return Incidencia
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

    /**
     * Set unidad
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Unidad $unidad
     * @return Incidencia
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
    
    public function __construct()
    {
        $this->fecha_incidencia = new \DateTime();
    }
}
