<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecepcionMaterial
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\RecepcionMaterialRepository")
 */
class RecepcionMaterial
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
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion")
     */
    private $boleta_recepcion;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Material")
     */
    private $material;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime")
     */
    private $fecha_ingreso;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\UnidadMedida")
     */
    private $unidad_medida;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad", type="decimal", precision=10, scale=2 )
     */
    private $cantidad;


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
     * Set boleta_recepcion
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion $boletaRecepcion
     * @return RecepcionMaterial
     */
    public function setBoletaRecepcion(\Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion $boletaRecepcion)
    {
        $this->boleta_recepcion = $boletaRecepcion;
    
        return $this;
    }

    /**
     * Get boleta_recepcion
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion 
     */
    public function getBoletaRecepcion()
    {
        return $this->boleta_recepcion;
    }

    /**
     * Set material
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Material $material
     * @return RecepcionMaterial
     */
    public function setMaterial(\Sistema\Bundle\FrontendBundle\Entity\Material $material)
    {
        $this->material = $material;
    
        return $this;
    }

    /**
     * Get material
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\Material
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set fecha_ingreso
     *
     * @param \DateTime $fechaIngreso
     * @return RecepcionMaterial
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
     * Set unidad_medida
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\UnidadMedida $unidadMedida
     * @return RecepcionMaterial
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
     * Set cantidad
     *
     * @param float $cantidad
     * @return RecepcionMaterial
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }
}
