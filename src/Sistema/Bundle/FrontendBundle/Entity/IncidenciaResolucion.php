<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IncidenciaResolucion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\IncidenciaResolucionRepository")
 */
class IncidenciaResolucion
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
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Incidencia")
     */
    private $incidencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_resolucion", type="datetime")
     */
    private $fecha_resolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="resolucion", type="string", length=200)
     */
    private $resolucion;


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
     * Set incidencia
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Incidencia $incidencia
     * @return IncidenciaResolucion
     */
    public function setIncidencia(\Sistema\Bundle\FrontendBundle\Entity\Incidencia $incidencia)
    {
        $this->incidencia = $incidencia;
    
        return $this;
    }

    /**
     * Get incidencia
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\Incidencia 
     */
    public function getIncidencia()
    {
        return $this->incidencia;
    }

    /**
     * Set fecha_resolucion
     *
     * @param \DateTime $fechaResolucion
     * @return IncidenciaResolucion
     */
    public function setFechaResolucion($fechaResolucion)
    {
        $this->fecha_resolucion = $fechaResolucion;
    
        return $this;
    }

    /**
     * Get fecha_resolucion
     *
     * @return \DateTime 
     */
    public function getFechaResolucion()
    {
        return $this->fecha_resolucion;
    }

    /**
     * Set resolucion
     *
     * @param string $resolucion
     * @return IncidenciaResolucion
     */
    public function setResolucion($resolucion)
    {
        $this->resolucion = $resolucion;
    
        return $this;
    }

    /**
     * Get resolucion
     *
     * @return string 
     */
    public function getResolucion()
    {
        return $this->resolucion;
    }
}
