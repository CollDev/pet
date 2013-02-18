<?php
namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;

class ClienteManager extends BaseManager
{
    
    public function __construct(ObjectManager $om, $fqnClass)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($fqnClass);
        $this->class = $fqnClass;
    }
    
    public function validarClave($form)
    {
        $clave = $form->get('clave')->getData();
        if($clave == '1234') {
            return true;
        }
        else {
            return false;
        }
    }
}

?>
