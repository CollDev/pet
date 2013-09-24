<?php
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sistema\Bundle\FrontendBundle\Entity\Cliente;

/**
 * @Route("/clientes")
 */
class ClienteController extends Controller
{
    /**
     * @Route("/buscar", name="cliente_buscar")
     * @Template();
     * 
     */
    public function buscarAction()
    {
        $request = $this->getRequest();
        $clienteRepository = $this->get('cliente.repository');
        $cliente = new Cliente();
        $searchForm = $this->createFormBuilder()
                ->add('id','text', ['required'=> false ])
                ->getForm();
        $clientes = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $clientes = $clienteRepository
                    ->buscarClientes($searchForm->getData());
            }
        }
        return [ 'form' => $searchForm->createView() ];
        
    }
    
    /**
     * @Route("/ajaxListar", name="cliente_ajax_listar")
     * @Template()
     */
    public function ajaxListarClientesAction()
    {
       $request = $this->getRequest();
        $clienteRepository = $this->get('cliente.repository');
        $cliente = new Cliente();
        $searchForm = $this->createFormBuilder()
                ->add('id','text')
                ->getForm();
        $clientes = [];
        if($request->getMethod()== 'POST') {
            $searchForm->bind($request);
            
            if( $searchForm->isValid()) {
                $clientes = $clienteRepository
                    ->buscarClientes($searchForm->getData());
            }
        }
        return [ 'form' => $searchForm->createView(), 
             'clientes' =>  $clientes ];
    }
    
}

?>
