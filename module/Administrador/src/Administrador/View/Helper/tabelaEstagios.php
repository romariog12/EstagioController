<?php

namespace Vaga\View\Helper;


use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 **/
class tabelaEstagios extends AbstractHelper{
    protected $td;
    protected $th;
    protected $numeroPagina;

    public function __invoke($thValue, $tdValue, $numeroPagina) {
        $this->th = $thValue;
        $this->td = $tdValue;
        $this->numeroPagina = $numeroPagina;
        $html  =        '';
        $html .=        '<table class="table table-bordered table-striped lista-clientes" >';
        $html .= $this->tdTh($this->th, $this->td, $this->numeroPagina);
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
            $html   .= '<tr>';
            $html   .= '<td><i class="fa fa-square situacao-'.$l->getSituacao().'" aria-hidden="true"></i> '.$l->getEmpresa().'</td>';
            $html   .= '<td><a href="'.$this->view->url('vagaPresencial/default', ['controller' => 'vagapresencial', 'action' => 'lancarcontratos','id'=>$l->getIdalunovaga(), 'idVaga'=>$l->getidvaga(),'curso'=>$l->getIdempresavaga()]).'" class="btn"><i class="fa fa-reorder"></i></a></td></td>';
            $html   .= '<a  class="btn" href="'.$this->view->url('deleteVagaPresencial', ['action' => 'excluirvaga', 'iddelete' => $l->getidVaga()]).'"><i class=" glyphicon glyphicon-remove" ></i></a>';
            $html   .= '</tr>';
        }
        return $html;
    }
}
