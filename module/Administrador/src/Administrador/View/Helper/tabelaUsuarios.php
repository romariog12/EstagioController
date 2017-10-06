<?php

namespace Administrador\View\Helper;

use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 **/
class tabelaUsuarios extends AbstractHelper{
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
        $html    = ''; 
        $html   .=  '<tr>';
        foreach ($valueTh as $l){
        $html   .= '<th>'.$l.'</th>';
        }
        $html   .= '</tr>';
        foreach ($valueTd as $l){
            $html   .= '<tr>';
            $html   .= '<td>'.$l->getNome().'</td>';
            $html   .= '<td>'.$l->getLogin().'</td>';
            $html   .= '<td><a href="'.$this->view->url('usuarios/default', ['controller'=>'administrador','action' => 'editarUsuario', 'id' => $l->getIdusuario()]).'"><i class=" glyphicon glyphicon-edit"></i></a></td>';
            $html   .= '<td><a onclick="return confirm("Tem certeza que deseja deletar este registro?")" style="color: #c81616" class="btn" href="'.$this->view->url('excluirUsuario', ['action' => 'excluirUsuario', 'deleteUsuario' => $l->getIdusuario()]).'"><i class=" glyphicon glyphicon-remove"></i></a></td>';
            $html   .= '</tr>';
        }
        return $html;
    }
}
