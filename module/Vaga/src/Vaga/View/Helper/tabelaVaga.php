<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Vaga\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * Description of tabelaVaga
 *
 * @author romario
 */
class tabelaVaga extends AbstractHelper{
    protected $td;
    protected $th;
    protected $situacao;

    public function __invoke($thValue, $tdValue, $situacao = false) {
        $this->th = $thValue;
        $this->td = $tdValue;
        $this->situacao = $situacao;
        $html  =        '';
        $html .=        '<table class="table" >';
        $html .= $this->tdTh($this->th, $this->td,  $this->situacao);
        $html .= '</table>';
        return $html;
    }
    public function tdTh($valueTh = [],$valueTd = []){
        $quantidadeTh = count($valueTh) -1;
        $quantidadeTd = count($valueTd) -1;
        $html    = ''; 
        $html   .=  '<tr>';
        foreach ($valueTh as $l){
        $html   .= '<th>'.$l.'</th>';
        }
        $html   .= '</tr>';
        for($count1  = 0; $count1 <= $quantidadeTd; $count1++){
        $html   .= '<tr>';  
        for($count = 0 ; $count <= $quantidadeTh; $count++){
        $html   .= '<td>'.$valueTd[$count1][$count].'</td>';
        }
        $html   .= '</tr>';
        }
        return $html;  
    }
}
