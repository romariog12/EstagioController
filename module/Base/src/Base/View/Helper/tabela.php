<?php

namespace Base\View\Helper;


use Zend\View\Helper\AbstractHelper;
/*
 * @Autor Romário Macedo
 * Email: romariomacedo18@gmail.com
 */
class tabela extends AbstractHelper{
    protected $td;
    protected $th;

    public function __invoke($thValue, $tdValue) {
        $this->th = $thValue;
        $this->td = $tdValue;
        $html  =        '';
        $html .=        '<table class="table table-bordered table-striped lista-clientes" >';
        $html .= $this->tdTh($this->th, $this->td);
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
