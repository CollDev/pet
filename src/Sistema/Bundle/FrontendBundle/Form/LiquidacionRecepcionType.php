<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LiquidacionRecepcionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha_liguidacion')
            ->add('fecha_inicio')
            ->add('fecha_fin')
            ->add('importe')
            ->add('cliente')
            ->add('estado')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\Bundle\FrontendBundle\Entity\LiquidacionRecepcion'
        ));
    }

    public function getName()
    {
        return 'sistema_bundle_frontendbundle_liquidacionrecepciontype';
    }
}
