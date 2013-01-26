<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoletaRecepcionToStringTransformer
 *
 * @author Administrator
 */

namespace Sistema\Bundle\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\TaskBundle\Entity\Issue;

class BoletaRecepcionToNumberTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (boletaRecepcion) to a string (number).
     *
     * @param  Issue|null $boletaRecepcion
     * @return string
     */
    public function transform($boletaRecepcion)
    {
        if (null === $boletaRecepcion) {
            return "";
        }

        return $boletaRecepcion->getId();
    }

    /**
     * Transforms a string (number) to an object (boletaRecepcion).
     *
     * @param  string $number
     * @return Issue|null
     * @throws TransformationFailedException if object (boletaRecepcion) is not found.
     */
    public function reverseTransform($number)
    {
        if (!$number) {
            return null;
        }

        $boletaRecepcion = $this->om
            ->getRepository('FrontendBundle:BoletaRecepcion')
            ->findOneBy(array('id' => $number))
        ;

        if (null === $boletaRecepcion) {
            throw new TransformationFailedException(sprintf(
                'Boleta Recepción "%s" no existe!',
                $number
            ));
        }

        return $boletaRecepcion;
    }
}


?>
