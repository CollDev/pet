<?php


namespace Sistema\Bundle\FrontendBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class FacturaToNumberTransformer implements DataTransformerInterface
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
     * Transforms an object (cliente) to a string (number).
     *
     * @param  Issue|null $Cliente
     * @return string
     */
    public function transform($cliente)
    {
        if (null === $cliente) {
            return "";
        }

        return $cliente->getId();
    }

    /**
     * Transforms a string (number) to an object (factura).
     *
     * @param  string $number
     * @return Issue|null
     * @throws TransformationFailedException if object (factura) is not found.
     */
    public function reverseTransform($number)
    {
        if (!$number) {
            return null;
        }

        $factura = $this->om
            ->getRepository('FrontendBundle:Factura')
            ->findOneBy(array('id' => $number))
        ;

        if (null === $factura) {
            throw new TransformationFailedException(sprintf(
                'Factura "%s" no existe!',
                $number
            ));
        }

        return $factura;
    }
}


?>
