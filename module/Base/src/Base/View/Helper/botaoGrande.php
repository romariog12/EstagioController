<?php


namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class botaoGrande extends AbstractHelper{
    protected $url;
    protected $nome;
    protected $fa;
    public function __invoke($url, $nome, $fa, $class) {
        $this->url = $url;
        $this->nome = $nome;
        $this->fa = $fa;
        $html   = '<a href="'.  $this->url.'">';
        $html  .= '<span class="btn btn-'.$class.'">';
        $html  .= '<i class="fa '.$this->fa.' fa-2x pull-left"></i>';
        $html  .= $this->nome;
        $html  .= '</span></a>';
        return $html;
    }
}
