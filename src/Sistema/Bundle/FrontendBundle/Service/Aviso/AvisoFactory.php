<?php
namespace Sistema\Bundle\FrontendBundle\Service\Aviso;

use Sistema\Bundle\FrontendBundle\Service\Aviso\Aviso;

class AvisoFactory
{

    public function getInstance()
    {
        return new AvisoFactory();
    }
    
    public function getAviso($titulo, $fechaAviso)
    {
        return new Aviso($titulo, $fechaAviso);
    }
}

?>
