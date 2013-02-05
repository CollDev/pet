<?php
namespace Sistema\Bundle\FrontendBundle\Doctrine;

use Doctrine\Common\Persistence\ObjectManager;

class UnidadManager extends BaseManager
{
    public function __construct(ObjectManager $om, $fqnClass)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($fqnClass);
        $this->class = $fqnClass;
    }
    
    public function getUnidadesConMantenimientoPreventivo($dias)
    {
        $query = $this->repository->getUnidadesConMantenimiento($dias);
        return $query->getResult();
    }
}

?>
