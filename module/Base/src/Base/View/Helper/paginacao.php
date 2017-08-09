<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * Description of paginacao
 *
 * @author romario
 */
class paginacao extends AbstractHelper{
    public function __invoke($numeroPagina, $count) {
    if ($numeroPagina == 1 || $numeroPagina == 0 ){
      $evento1 =   'class="disabled" style="pointer-events: none';
    } 
    else{
        $evento1= '_';
    }
    if ($numeroPagina > 1){
        $evento2 = $numeroPagina - 1;
    }else{
        $evento2 = '?';
    }
    if ($numeroPagina >= $count){ 
        $evento3 = 'class="disabled"'. 'style="pointer-events: none"';      
    }else{
        $evento3= '_';
    }
    $evento4 = $numeroPagina + 1;
    $html   = '';      
    $html  .= '<nav aria-label="Page navigation">';
    $html  .= '<ul  class="pager">';
    $html  .= '<li '.$evento1.'>';
    $html  .= '<a href=" '.$evento2.'" aria-label="Previous">';
    $html  .= '<span aria-hidden="true"><i class="glyphicon glyphicon-chevron-left"> </i></span>';
    $html  .= '</a>';
    $html  .= '</li>';
    $html  .= '<li '.$evento3.' >';
    $html  .= '<a href="'.$evento4.'" aria-label="Next">';
    $html  .= '<span aria-hidden="true"><i class="glyphicon glyphicon-chevron-right"></i></span>';
    $html  .= '</a>';
    $html  .= '</li>';
    $html  .= '</ul>';     
    $html  .= '</nav> ';
    $html  .= '<div class="pager">'. $numeroPagina.' de '.$count .'</div>';
    return $html;
    }
}
