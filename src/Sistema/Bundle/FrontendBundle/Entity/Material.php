<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Material
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\MaterialRepository")
 */
class Material
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
     * @ORM\Column(name="nombre", type="string", length=200)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock", type="decimal", precision=10, scale=2 )
     */
    private $stock;
    
    /**
     * @var float
     * 
     * @ORM\Column(name="tarifa", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tarifa;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Material
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return Material
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    
        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }
    
    /**
     * 
     * @return float $tarifa
     */
    public function getTarifa() {
        return $this->tarifa;
    }
    
    /**
     * 
     * @param float $tarifa
     * @return $tarifa
     */
    public function setTarifa($tarifa) {
        $this->tarifa = $tarifa;
        
        return $this;
    }

        
    
    public function __toString()
    {
        return $this->nombre;
    }
    
    
}
