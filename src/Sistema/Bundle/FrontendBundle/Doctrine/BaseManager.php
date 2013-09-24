<?php
/**
 * User: Administrator 
 * Date: 06/01/13
 * Time: 02:58 PM
 */
namespace Sistema\Bundle\FrontendBundle\Doctrine;

abstract class BaseManager
{
    protected $objectManager;
    protected $repository;
    protected $class;

    public function crearEntidad()
    {
        return new $this->class;
    }

    public function findByPk($id)
    {
        return $this->repository->findOneBy([ 'id' => $id]);
    }

    public function guardar($entity)
    {
        $this->objectManager->persist($entity);
        $this->objectManager->flush();
    }

    public function eliminar($entity)
    {
        $this->objectManager->remove($entity);
        $this->objectManager->flush();
    }

}
