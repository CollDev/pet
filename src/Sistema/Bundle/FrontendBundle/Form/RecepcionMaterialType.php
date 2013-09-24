<?php

namespace Sistema\Bundle\FrontendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sistema\Bundle\FrontendBundle\Repository\UnidadMedidaRepository;

class RecepcionMaterialType extends AbstractType
{
    private $accion;
    private $recepcionMaterial;
            
    public function __construct($accion = null, $recepcionMaterial = null) 
    {
        $this->accion = $accion;
        $this->recepcionMaterial = $recepcionMaterial;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('boleta_recepcion', 'boleta_recepcion_selector' , ['attr' => ['class'=> 'inputText required', 'readonly' => true ], 'required' => true ])
            ->add('material', null, [ 'required' => true ])
            ->add('unidad_medida', 'entity', [ 'class' => 'FrontendBundle:UnidadMedida',
                'property' => 'nombre',
                'query_builder' => function(UnidadMedidaRepository $unidadMedidaRepository) {
                    return $unidadMedidaRepository->getUnidadMedidaTonelada();
                },
                'attr' => [ 'readonly' => true ],
                'required' => true ] 
                )
            ->add('fecha_ingreso', 'date', ['widget' => 'single_text', 'required' => true  ])
            ->add('cantidad', 'text', ['attr' => ['class'=> 'inputText required', 'readonly' => true, 'required' => true ] ]);
            
                
         if(!is_null($this->accion)) {
             $builder->add('accion', 'hidden', ['mapped' => false, 'data' => $this->accion]);
         }
         else {
             $builder->add('accion', 'hidden', ['mapped' => false, 'data' => '']);
         }
         if($this->recepcionMaterial == 0 ) {
             $builder->add('recepcion_material', 'hidden', ['mapped' => false, 'data' => '']);
         }
         else {
             $builder->add('recepcion_material', 'hidden', ['mapped' => false, 'data' => $this->recepcionMaterial]);
         }
        
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
