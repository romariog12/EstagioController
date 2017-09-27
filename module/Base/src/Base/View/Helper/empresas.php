<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * Description of cursos
 *
 * @author romario
 */
class empresas extends AbstractHelper{
    protected $emrpesas = [];
    public function __invoke($empresas =[]) {
        foreach ($empresas as $l){
            $this->emrpesas[$l->getEmpresa()] = $l->getEmpresa();
        }
        return $this->emrpesas;
    }
}
