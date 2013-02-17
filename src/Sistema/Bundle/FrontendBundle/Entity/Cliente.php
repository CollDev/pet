<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\ClienteRepository")
 */
class Cliente
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
     * @ORM\Column(name="razon_social", type="string", length=200)
     */
    private $razon_social;

    /**
     * @var string
     *
     * @ORM\Column(name="ruc", type="string", length=100)
     */
    private $ruc;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=200)
     */
    private $direccion;

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
     * Set razon_social
     *
     * @param string $razonSocial
     * @return Cliente
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razon_social = $razonSocial;
    
        return $this;
    }

    /**
     * Get razon_social
     *
     * @return string 
     */
    public function getRazonSocial()
    {
        return $this->razon_social;
    }

    /**
     * Set ruc
     *
     * @param string $ruc
     * @return Cliente
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;
    
        return $this;
    }

    /**
     * Get ruc
     *
     * @return string 
     */
    public function getRuc()
    {
        return $this->ruc;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Cliente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
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
        return strval($this->id);
    }
}
