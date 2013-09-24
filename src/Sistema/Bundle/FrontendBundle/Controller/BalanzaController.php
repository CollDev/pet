<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BalanzaController
 *
 * @author Administrator
 */
namespace Sistema\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;

/**
 *  @Route("/balanza")
 */
class BalanzaController extends Controller
{
    /**
     * @Route("/peso", name="balanza_peso")
     * 
     */
    public function obtenerPeso()
    {
        $rootDir = $this->get('kernel')->getRootDir();
        $peso = $this->getPesoBalanza($rootDir);
        return new Response($peso);
    }
    
    private function getPesoBalanza($rootDir)
    {
        $balazaDir = $rootDir.'/../data/balanza';
        $finder = new Finder();
        $finder->files()->in($balazaDir);

        foreach ($finder as $file) {
            $balanzaPeso = $file->getContents();
            break;
        }
        return trim($balanzaPeso);
    }
}

?>
