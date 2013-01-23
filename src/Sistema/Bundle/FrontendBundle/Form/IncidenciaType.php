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
            ->add('fecha_incidencia')
            ->add('maquinaria')
            ->add('observacion')
            ->add('tipo_incidencia')
            ->add('estado')
            ->add('unidad')
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
