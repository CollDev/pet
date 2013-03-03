<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IncidenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nro_incidencia', 'text' , 
                ['attr' => ['class'=> 'inputText', 'readonly' => true, 'placeholder' => 'Autogenerado' ],
                'required' => false, 'mapped' => false ])
            ->add('unidad', null, ['label' => 'Nro Maquinaria', 'required' => true])
            ->add('fecha_incidencia', 'date', ['widget' => 'single_text', 'required' => true  ])
            ->add('observacion', 'textarea')
            ->add('tipo_incidencia', null, ['required' => true ])
            ->add('estado', null, ['required' => true ] )
            ->add('accion', 'hidden', ['mapped' => false, 'data' => ''])
            ->add('incidencia', 'hidden', ['mapped' => false, 'data' => ''])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\Bundle\FrontendBundle\Entity\Incidencia'
        ));
    }

    public function getName()
    {
        return 'sistema_bundle_frontendbundle_incidenciatype';
    }
}
