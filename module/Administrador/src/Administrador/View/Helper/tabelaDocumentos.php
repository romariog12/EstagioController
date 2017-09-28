<?php

namespace Administrador\View\Helper;


use Zend\View\Helper\AbstractHelper;
/**
 *@author Romário Macedo Portela <romariomacedo18@gmail.com>
 **/
class tabelaDocumentos extends AbstractHelper{
    protected $td;
    protected $th;

    public function __invoke($thValue, $tdValue) {
        $this->th = $thValue;
        $this->td = $tdValue;
        $html  =        '';
        $html .=        '<table class="table" >';
        $html .= $this->tdTh($this->th, $this->td);
        $html .= '</table>';
        return $html;
    }
    public function tdTh($valueTh = [],$valueTd = []){
        
        $html    = ''; 
        $html   .=  '<tr>';
        foreach ($valueTh as $l){
        $html   .= '<th>'.$l.'</th>';
        }
        $html   .= '</tr>';
        foreach ($valueTd as $l){
            $html   .= '<tr style=" background-color: #ffffcc">';
            $html   .= '<td  style=" background-color: #ffcc00; text-align: center; width: 5px; "></td>';
            $html   .= '<td><a href="'.$this->view->url('vagaPresencial/default', ['controller' => 'vagapresencial', 'action' => 'lancarcontratos','id'=>$l[0]->getIdalunoDocumento(), 'idVaga'=>$l[0]->getIdvagaDocumento(),'curso'=>$l[0]->getIdempresaDocumento()]).'"><i class="fa fa-file"></i></a></td>';
            $html   .= '<td>'.date_format($l[0]->getInicio(), 'd/m/Y').'</td>';
            $html   .= '<td>'.date_format($l[0]->getFim(), 'd/m/Y').'</td>';
            $html   .= '</tr>';
        }
        return $html;
    }
}
