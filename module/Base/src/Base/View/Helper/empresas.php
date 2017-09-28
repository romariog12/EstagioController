<?php

namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class empresas extends AbstractHelper{
    protected $emrpesas = [];
    public function __invoke($empresas =[]) {
        foreach ($empresas as $l){
            $this->emrpesas[$l->getEmpresa()] = $l->getEmpresa();
        }
        return $this->emrpesas;
    }
}
