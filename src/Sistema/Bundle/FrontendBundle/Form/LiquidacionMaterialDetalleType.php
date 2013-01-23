<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LiquidacionMaterialDetalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('importe')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\Bundle\FrontendBundle\Entity\LiquidacionMaterialDetalle'
        ));
    }

    public function getName()
    {
        return 'sistema_bundle_frontendbundle_liquidacionmaterialdetalletype';
    }
}
