<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unidad
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\UnidadRepository")
 */
class Unidad
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
     * @ORM\Column(name="marca", type="string", length=200)
     */
    private $marca;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_mantenimiento", type="datetime")
     */
    private $fecha_mantenimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="kilometraje", type="integer")
     */
    private $kilometraje;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo", type="datetime")
     */
    private $tiempo;

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
     * Set marca
     *
     * @param string $marca
     * @return Unidad
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set fecha_mantenimiento
     *
     * @param \DateTime $fechaMantenimiento
     * @return Unidad
     */
    public function setFechaMantenimiento($fechaMantenimiento)
    {
        $this->fecha_mantenimiento = $fechaMantenimiento;
    
        return $this;
    }

    /**
     * Get fecha_mantenimiento
     *
     * @return \DateTime 
     */
    public function getFechaMantenimiento()
    {
        return $this->fecha_mantenimiento;
    }

    /**
     * Set kilometraje
     *
     * @param integer $kilometraje
     * @return Unidad
     */
    public function setKilometraje($kilometraje)
    {
        $this->kilometraje = $kilometraje;
    
        return $this;
    }

    /**
     * Get kilometraje
     *
     * @return integer 
     */
    public function getKilometraje()
    {
        return $this->kilometraje;
    }

    /**
     * Set tiempo
     *
     * @param \DateTime $tiempo
     * @return Unidad
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;
    
        return $this;
    }

    /**
     * Get tiempo
     *
     * @return \DateTime 
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set estado
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Estado $estado
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
    
    public function __toString()
    {
        return 'Unidad '.$this->getId().'  '.$this->getMarca() ;
    }

}
