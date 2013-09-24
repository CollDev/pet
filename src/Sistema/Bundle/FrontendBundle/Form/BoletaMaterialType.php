<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoletaMaterialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('neto')
            ->add('boleta_recepcion', 'text', ['attr' => ['class' => 'inputText'] ])
            ->add('tarifa')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sistema\Bundle\FrontendBundle\Entity\BoletaMaterial'
        ));
    }

    public function getName()
    {
        return 'sistema_bundle_frontendbundle_boletamaterialtype';
    }
}
