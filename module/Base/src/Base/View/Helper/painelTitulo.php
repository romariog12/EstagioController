<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;

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
