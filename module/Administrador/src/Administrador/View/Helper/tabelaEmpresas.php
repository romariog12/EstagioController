<?php

namespace Administrador\View\Helper;

use Base\Model\Constantes;
use Zend\View\Helper\AbstractHelper;
/**
 * @author: Romário Macedo
 * romariomacedo18@gmail.com
 *
 **/
class tabelaEmpresas extends AbstractHelper{
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
            $html   .= '<td> <a href="'. $this->view->url(Constantes::rotaPerfilEmpresaDefault, ['controller' => Constantes::administrador, 'action' => Constantes::perfilEmpresa, 'id'=>$l->getIdempresa(),]).'"><i class="glyphicon glyphicon-user"></i></a> '. $l->getEmpresa().'</td>';
            $html   .= '<td>'.$l->getTelefone().'</td>';
            $html   .= '<td><a href="'.$this->view->url(Constantes::rotaEmpresaDefault, ['controller'=>  Constantes::administrador, 'action'=>  Constantes::editarEmpresa, 'id'=>$l->getIdempresa(),'page'=>$numeroPagina]).'"><i class=" glyphicon glyphicon-edit"></i></a></td>';
            $html   .= '<td><a onclick="return confirm("Tem certeza que deseja deletar este registro?")" style="color: #c81616" href="'. $this->view->url(Constantes::excluir,['action'=>  Constantes::excluirEmpresa, 'id'=>$l->getIdempresa(),'page'=>$numeroPagina] ).'"><i  class=" glyphicon glyphicon-remove"></i></a></td>';
            $html   .= '</tr>';
        }
        return $html;
    }
}
