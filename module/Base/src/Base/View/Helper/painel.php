<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class painel extends AbstractHelper{
    protected $painel = '<div class="panel panel-';
    
    public function __invoke($class) {
        return $this->painel.$class.'">';
    }
}
