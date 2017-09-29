<?php

namespace Base\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Base\Model\Constantes;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class tabelaAlunoEmEstagio extends AbstractHelper{
    protected $td;
    protected $th;
    protected $numeroPagina;

    public function __invoke($thValue, $tdValue, $numeroPagina) {
        $this->th = $thValue;
        $this->td = $tdValue;
        $this->numeroPagina = $numeroPagina;
        $html  =        '';
        $html .=        '<table class="table  lista-clientes" >';
        $html .= $this->tdTh($this->th, $this->td, $this->numeroPagina);
        $html .= '</table>';
        return $html;
    }
    public function tdTh($valueTh = [],$valueTd = [], $numeroPagina = []){
        $html   =  '<tr>';
        foreach ($valueTh as $l){
        $html   .= '<th>'.$l.'</th>';}
        $html   .= '</tr>';
        foreach ($valueTd as $l){
            if($l->getSituacao()== '0'):
                $html   .= '<tr style="background-color: #a52525; color: white">';
                $html   .= '<td><a href="'.$this->view->url(Constantes::rotaPerfilAlunoDefault,['controller'=>  Constantes::administrador, 'action'=>  Constantes::perfilAluno, 'id'=>$l->getIdalunovaga(),'page'=>$numeroPagina]).'"><i class="glyphicon glyphicon-user"></i></a> '.$l->getAluno().'</td>';
                $html   .= '<td>'.$l->getEmpresa().'</td>';
                $html   .= '<td>'.$l->getAgente().'</td>';
                $html   .= '</tr>';
                elseif($l->getSituacao()== '1'):
                    $html   .= '<tr style="background-color: #d4fcd4">';
                    $html   .= '<td><a href="'.$this->view->url(Constantes::rotaPerfilAlunoDefault,['controller'=>  Constantes::administrador, 'action'=>  Constantes::perfilAluno, 'id'=>$l->getIdalunovaga(),'page'=>$numeroPagina]).'"><i class="glyphicon glyphicon-user"></i></a> '.$l->getAluno().'</td>';
                    $html   .= '<td>'.$l->getEmpresa().'</td>';
                    $html   .= '<td>'.$l->getAgente().'</td>';
                    $html   .= '</tr>';  
            endif;
        }
        return $html;
    }
}
