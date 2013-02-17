<?php
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sistema\Bundle\FrontendBundle\Entity\Material;

/**
 * @Route("/stock")
 */
class StockController extends Controller
{
    /**
     * @Route("verificar", name="stock_verificar")
     * @Template()
     */
    public function verificarStockAction()
    {
        $request = $this->getRequest();
        $materialId = $request->query->get('id',0);
        
        $materialRepository = $this->get('material.repository');
        $materiales = $materialRepository->findBy(['id' => $materialId]);
        return ['materiales' => $materiales];
    }
  
}

?>
