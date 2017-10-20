<?php

namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class painel extends AbstractHelper{
    
    public function __invoke($class) {
        return '<div class="panel panel-'.$class.'"> '.$this->view->content.' </div>';
    }
}
