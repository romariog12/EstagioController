<?php

namespace Base\View\Helper;


use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class tabelaEstagios extends AbstractHelper{
    protected $td;
    protected $th;

    public function __invoke($thValue, $tdValue) {
        $this->th = $thValue;
        $this->td = $tdValue;
        $html  =        '';
        $html .=        '<table class="table  lista-clientes" >';
        $html .= $this->tdTh($this->th, $this->td);
        $html .= '</table>';
        return $html;
    }
    public function tdTh($valueTh = [],$valueTd = []){
        $html   =  '<tr>';
        foreach ($valueTh as $l){
        $html   .= '<th>'.$l.'</th>';}
        $html   .= '</tr>';
        foreach ($valueTd as $l){
            if($l->getSituacao()== '0'):
                $html   .= '<tr style="background-color: #a52525; color: white">';
                $html   .= '<td>'.$l->getEmpresa().'</td>';
                $html   .= '<td><a href="'.$this->view->url('vagaPresencial/default', ['controller' => 'vagapresencial', 'action' => 'lancarcontratos','id'=>$l->getIdalunovaga(), 'idVaga'=>$l->getidvaga(),'curso'=>$l->getIdempresavaga()]).'" class="btn"><i class="fa fa-reorder"></i></a></td></td>';
                $html   .= '<td><a  class="btn" href="'.$this->view->url('deleteVagaPresencial', ['action' => 'excluirvaga', 'iddelete' => $l->getidVaga()]).'"><i class=" glyphicon glyphicon-remove" ></i></a></td>';
                $html   .= '</tr>';
                elseif($l->getSituacao()== '1'):
                    $html   .= '<tr style="background-color: #d4fcd4">';
                    $html   .= '<td>'.$l->getEmpresa().'</td>';
                    $html   .= '<td><a href="'.$this->view->url('vagaPresencial/default', ['controller' => 'vagapresencial', 'action' => 'lancarcontratos','id'=>$l->getIdalunovaga(), 'idVaga'=>$l->getidvaga(),'curso'=>$l->getIdempresavaga()]).'" class="btn"><i class="fa fa-reorder"></i></a></td></td>';
                    $html   .= '<td><a  class="btn" href="'.$this->view->url('deleteVagaPresencial', ['action' => 'excluirvaga', 'iddelete' => $l->getidVaga()]).'"><i class=" glyphicon glyphicon-remove" ></i></a></td>';
                    $html   .= '</tr>';   
            endif;
        }
        return $html;
    }
}
