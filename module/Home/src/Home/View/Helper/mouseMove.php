<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\View\Helper;
use Zend\View\Helper\AbstractHelper;

/**
 * Description of HomeHelper
 *
 * @author romario
 */
class mouseMove extends AbstractHelper{
    
    protected $funcao;
    protected $valores ;
    
    public function __invoke($funcao, $valores = false) {
        
        $this->funcao = $funcao;
        $this->valores = $valores;
      
        return'onmousemove="'.$funcao.'('.$valores .')"';
    }
    
    
    
}
