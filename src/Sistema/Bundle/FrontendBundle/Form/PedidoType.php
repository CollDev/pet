<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Sistema\Bundle\FrontendBundle\Repository\EstadoRepository;
use Sistema\Bundle\FrontendBundle\Repository\MaterialRepository;

use Sistema\Bundle\FrontendBundle\Form\EventListener\checkCantidadMayorAStockPedidoSuscriber;

class PedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $subscriber = new checkCantidadMayorAStockPedidoSuscriber($builder->getFormFactory());
        $builder->addEventSubscriber($subscriber);
        
        $builder
            ->add('fecha_programacion', 'date', ['label' => 'Fecha', 
                'widget' => 'single_text', 'required' => true])
            ->add('cliente', 'cliente_selector', ['attr' => ['readonly' => true]])
            ->add('estado', 'entity', [ 'class' => 'FrontendBundle:Estado',
                'property' => 'nombre',
                'query_builder' => function(EstadoRepository $estadoRepository) {
                    return $estadoRepository->getEstadosPedido();
                },
                'attr' => [ 'readonly' => true ],
                'required' => true ] 
                )
            
            ->add('material','entity', ['class' => 'FrontendBundle:Material',
                'property' => 'nombre',
                'query_builder' => function(MaterialRepository $materialRepository) {
                    return $materialRepository->getMateriales();
                },
                'required' => true,
                'mapped' => false]
                )
            ->add('cantidad', 'integer', ['mapped' => false, 
                'constraints' => [
                new Assert\NotBlank(),
                new Assert\Type(['type' => 'int', 'message' => 'El valor debe ser un entero']),
                new Assert\Min(['limit' => 1, 'message' => 'El valor debe ser mayor que 0'])
                ] 
                ])
            ->add('importe', 'text', ['mapped' => false, 'attr' => ['readonly' => true]])
            ->add('nro_pedido','text', ['mapped' => false, 
                'attr' => ['readonly' => true, 
                    'placeholder' => 'Autogenerado'], 'label' => 'Nro. Pedido' ])
                
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
