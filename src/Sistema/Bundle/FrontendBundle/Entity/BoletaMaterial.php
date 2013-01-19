<?php

namespace Sistema\Bundle\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BoletaMaterial
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sistema\Bundle\FrontendBundle\Repository\BoletaMaterialRepository")
 */
class BoletaMaterial
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
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion")
     */
    private $boleta_recepcion;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Sistema\Bundle\FrontendBundle\Entity\Tarifa")
     */
    private $tarifa;

    /**
     * @var float
     *
     * @ORM\Column(name="neto", type="decimal", precision=10, scale=2)
     */
    private $neto;


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
     * @return BoletaMaterial
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
     * Set tarifa
     *
     * @param Sistema\Bundle\FrontendBundle\Entity\Tarifa $tarifa
     * @return BoletaMaterial
     */
    public function setTarifa(\Sistema\Bundle\FrontendBundle\Entity\Tarifa $tarifa)
    {
        $this->tarifa = $tarifa;
    
        return $this;
    }

    /**
     * Get tarifa
     *
     * @return Sistema\Bundle\FrontendBundle\Entity\Tarifa
     */
    public function getTarifa()
    {
        return $this->tarifa;
    }

    /**
     * Set neto
     *
     * @param float $neto
     * @return BoletaMaterial
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
}
