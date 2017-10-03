<?php

namespace Administrador\View\Helper;


use Zend\View\Helper\AbstractHelper;
use Base\Model\Constantes;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 **/
class tabelaBuscarEmpresa extends AbstractHelper{
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
            $html   .= '<tr>';
            $html   .= '<td>'.$l[0]->getEmpresa().'</td>';
            $html   .= '<td>'.$l[0]->getCnpj().'</td>';
            $html   .= '<td><a href="'.$this->view->url(Constantes::rotaPerfilEmpresaDefault, ['controller' => Constantes::administrador, 'action' => Constantes::perfilEmpresa, 'id'=>$l[0]->getIdEmpresa(),]).'"><i class="glyphicon glyphicon-user"></i></a></td>';
            $html   .= '</tr>';
        }
        return $html;
    }
}
