<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * Description of alertaDanger
 *
 * @author romario
 */
class alertaSuccess extends AbstractHelper {
    protected $mensagem;
    public function __invoke($mensagem) {
        $this->mensagem = $mensagem;
        return '<div class="pager alert alert-success" role="alert" >'.$this->mensagem.'</div>';
    }
}
