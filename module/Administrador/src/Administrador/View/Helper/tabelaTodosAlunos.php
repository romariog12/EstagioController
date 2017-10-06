<?php

namespace Administrador\View\Helper;

use Base\Model\Constantes;
use Zend\View\Helper\AbstractHelper;
/**
 *@author Romário Macedo Portela <romariomacedo18@gmail.com>
 **/
class tabelaTodosAlunos extends AbstractHelper{
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
    public function tdTh($valueTh = [],$valueTd = [], $numeroPagina = []){
        
        $html    = ''; 
        $html   .=  '<tr>';
        foreach ($valueTh as $l){
        $html   .= '<th>'.$l.'</th>';
        }
        $html   .= '</tr>';
        foreach ($valueTd as $l){
            $html   .= '<tr>';
            $html   .= '<td><a href="'.$this->view->url(Constantes::rotaPerfilAlunoDefault,['controller'=>  Constantes::administrador, 'action'=>  Constantes::perfilAluno, 'id'=>$l->getIdaluno()]).'"><i class="glyphicon glyphicon-user"></i></a></td>';
            $html   .= '<td>'.$l->getNome().'</td>';
            $html   .= '<td>'.$l->getMatricula().'</td>';
            $html   .= '<td><a href="'.$this->view->url(Constantes::rotaAdministradorDefault, ['controller'=>Constantes::administrador, 'action'=>  Constantes::editarAluno, 'id'=>$l->getIdaluno(),'page'=>$numeroPagina]).'"><i class=" glyphicon glyphicon-edit"></i></a></td>';
            $html   .= '<td><a onclick="return confirm("Tem certeza que deseja deletar este registro?")" style="color: #c81616" href="'.$this->view->url('excluirAluno',['action'=>'excluirAluno', 'deleteAluno'=>$l->getIdaluno(),'page'=>$numeroPagina]).'"><i  class=" glyphicon glyphicon-remove"></i></a></td>';
            $html   .= '</tr>';
        }
        return $html;
    }
}
