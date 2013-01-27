<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecepcionMaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('boleta_recepcion', 'boleta_recepcion_selector' , ['attr' => ['class'=> 'inputText', 'readonly' => true ] ])
            ->add('material', null, [ 'required' => true ])
            ->add('unidad_medida', null, [ 'required' => true ] )
            ->add('fecha_ingreso', 'date', ['widget' => 'single_text'])
            ->add('cantidad', 'text', ['attr' => ['class'=> 'inputText', 'readonly' => true ] ])
            ->add('accion', 'hidden', ['mapped' => false, 'data' => ''])
            ->add('recepcion_material', 'hidden', ['mapped' => false, 'data' => ''])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\Bundle\FrontendBundle\Entity\RecepcionMaterial'
        ));
    }

    public function getName()
    {
        return 'sistema_bundle_frontendbundle_recepcionmaterialtype';
    }
}
