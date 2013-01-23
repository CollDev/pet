<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PedidoDetalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad')
            ->add('importe')
            ->add('pedido')
            ->add('material')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\Bundle\FrontendBundle\Entity\PedidoDetalle'
        ));
    }

    public function getName()
    {
        return 'sistema_bundle_frontendbundle_pedidodetalletype';
    }
}
