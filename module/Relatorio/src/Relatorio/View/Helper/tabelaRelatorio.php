<?php
namespace Relatorio\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class tabelaRelatorio extends AbstractHelper{
    protected $td;
    protected $th;
    protected $listaestagiando;


    public function __invoke($th, $td, $listaestagiando) {
        $this->th = $th;
        $this->td = $td;
        $this->listaestagiando = $listaestagiando;
        $html  = '';
        $html .= '<table class="table " id="eficiencia">';
        $html .= $this->tdTh($this->th, $this->td,$this->listaestagiando);
        $html .= '</table>';
        return $html;
    }
     public function tdTh($valueTh = [],$valueTd = [], $listaestagiando=[]){
        $html    = ''; 
        $html .= '<thead>';
        $html   .=  '<tr>';
        foreach ($valueTh as $l){
        $html   .= '<th>'.$l.'</th>';
        }
        $html   .= '</tr>';
        $html .= '</thead>';
        foreach ($valueTd as $l){
            if($listaestagiando[0][$l->getIddados()]/$l->getQuantidadealunos()*100 < $l->getMeta()-0.1):
                $html   .= '<tr style=" background-color:  #feeeee">';
                $html   .= '<td>'.$l->getCurso().'</td>';
                $html   .= '<td>'.$l->getQuantidadealunos().'</td>';
                $html   .= '<td>'.round($l->getQuantidadealunos()*$l->getMeta()/100,2).'</td>';
                $html   .= '<td>'.$listaestagiando[0][$l->getIddados()].'</td>';
                $html   .= '<td>'.round($listaestagiando[0][$l->getIddados()]/($l->getQuantidadealunos()*$l->getMeta()/100)*100,2).'</td>';
                $html   .= '<td><a  href="'.$this->view->url('relatorioPresencial/default', ['controller'=>'relatoriopresencial','action' => 'infopresencial', 'curso' => $l->getIddados(),'curso1' => $l->getCurso(),'aba'=>'1']).'"><i class="glyphicon glyphicon-plus "></i></a></td>';
                $html   .= '</tr>';
            else:
                $html   .= '<tr style=" background-color:  #defdd7" >';
                $html   .= '<td>'.$l->getCurso().'</td>';
                $html   .= '<td>'.$l->getQuantidadealunos().'</td>';
                $html   .= '<td>'.round($l->getQuantidadealunos()*$l->getMeta()/100,2).'</td>';
                $html   .= '<td>'.$listaestagiando[0][$l->getIddados()].'</td>';
                $html   .= '<td>'.round($listaestagiando[0][$l->getIddados()]/($l->getQuantidadealunos()*$l->getMeta()/100)*100,2).'</td>';
                $html   .= '<td><a  href="'.$this->view->url('relatorioPresencial/default', ['controller'=>'relatoriopresencial','action' => 'infopresencial', 'curso' => $l->getIddados(),'curso1' => $l->getCurso(),'aba'=>'1']).'"><i class="glyphicon glyphicon-plus "></i></a></td>';
                $html   .= '</tr>';
            endif;
        }
        return $html;
    }
}
