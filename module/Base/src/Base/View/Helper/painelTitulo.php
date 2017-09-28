<?php

namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class painelTitulo extends AbstractHelper{
    public $titulo;
    public function __invoke($titulo = false) {
        $this->titulo = $titulo;
        $html  =  '';
        $html .=  '<div class=" panel-heading ">';
        $html .=   $this->titulo;
        $html .= '</div>';
        return $html;
    }
 
}
