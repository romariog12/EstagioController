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
class agentes extends AbstractHelper{
    protected $agentes = [];
    public function __invoke($agentes =[]) {
        
        foreach ($agentes as $l){
            $this->agentes['N/C'] = 'N/C';
            $this->agentes[$l->getAgente()] = $l->getAgente();
        }
        return $this->agentes;
    }
}
