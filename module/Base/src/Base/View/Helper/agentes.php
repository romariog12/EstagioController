<?php


namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class agentes extends AbstractHelper{
    protected $agentes = [];
    public function __invoke($agentes =[]) {
        
        foreach ($agentes as $l){
            $this->agentes['N/C'] = 'N/C';
            $this->agentes[$l->getAgente()] = $l->getAgente();
        }
        return $this->agentes;
    }
}
