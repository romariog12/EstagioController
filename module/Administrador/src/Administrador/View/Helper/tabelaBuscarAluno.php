<?php

namespace Administrador\View\Helper;


use Zend\View\Helper\AbstractHelper;
use Base\Model\Constantes;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 **/
class tabelaBuscarAluno extends AbstractHelper{
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
            $html   .= '<td>'.$l[0]->getNome().'</td>';
            $html   .= '<td>'.$l[0]->getCurso().'</td>';
            $html   .= '<td>'.$l[0]->getMatricula().'</td>';
            $html   .= '<td><a href="'.$this->view->url(Constantes::rotaPerfilAlunoDefault, ['controller' => Constantes::administrador, 'action' => Constantes::perfilAluno, 'id'=>$l[0]->getidaluno(),]).'"><i class="glyphicon glyphicon-user"></i></a></td>';
            $html   .= '</tr>';
        }
        return $html;
    }
}
