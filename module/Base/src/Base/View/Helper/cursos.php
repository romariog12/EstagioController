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
class cursos extends AbstractHelper{
    protected $cursos = [];
    public function __invoke($cursos =[]) {
        foreach ($cursos as $l){
            $this->cursos[$l->getIddados()] = $l->getCurso();
        }
        return $this->cursos;
    }
}
