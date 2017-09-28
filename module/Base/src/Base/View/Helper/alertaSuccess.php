<?php
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class alertaSuccess extends AbstractHelper {
    protected $mensagem;
    public function __invoke($mensagem) {
        $this->mensagem = $mensagem;
        return '<div class="pager alert alert-success" role="alert" >'.$this->mensagem.'</div>';
    }
}
