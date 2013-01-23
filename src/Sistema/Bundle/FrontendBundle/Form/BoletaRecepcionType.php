<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoletaRecepcionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fecha_ingreso')
            ->add('fecha_salida')
            ->add('total')
            ->add('tara')
            ->add('neto')
            ->add('cliente')
            ->add('unidad')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\Bundle\FrontendBundle\Entity\BoletaRecepcion'
        ));
    }

    public function getName()
    {
        return 'sistema_bundle_frontendbundle_boletarecepciontype';
    }
}
