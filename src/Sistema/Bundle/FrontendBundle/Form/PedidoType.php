<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha_programacion')
            ->add('cliente')
            ->add('estado')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\Bundle\FrontendBundle\Entity\Pedido'
        ));
    }

    public function getName()
    {
        return 'sistema_bundle_frontendbundle_pedidotype';
    }
}
