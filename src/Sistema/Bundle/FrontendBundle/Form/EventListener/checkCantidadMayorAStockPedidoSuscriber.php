<?php
namespace Sistema\Bundle\FrontendBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class checkCantidadMayorAStockPedidoSuscriber implements EventSubscriberInterface
{
    private $factory;

    public function __construct(FormFactoryInterface $factory)
    {
        $this->factory = $factory;
    }
    
    public static function getSubscribedEvents()
    {
        return array(FormEvents::POST_BIND => 'onPostBind');
    }
    
    public function onPostBind(FormEvent $event)
    {
        $form = $event->getForm();
        
        $cantidad = $form->get('cantidad')->getData();
        $stock = $form->get('material')->getData()->getStock();
        
        $condition = ($cantidad <= $stock);

        if(false === $condition) {
            $form->get('cantidad')
                    ->addError(new FormError('Cantidad es mayor que el Stock Actual ' . $stock));
        }
    }
    

    
}

?>
