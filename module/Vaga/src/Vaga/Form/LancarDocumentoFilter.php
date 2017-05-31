<?php
namespace Vaga\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
/**
 * Description of LancarDocumentoFilter
 *
 * @author romario
 */
class LancarDocumentoFilter extends Form{
    public function __construct() {
        $inicio = new Input("inicioEnc");
        $inicio->setRequired(true);
        $inicio->getFilterChain()
                ->attach(new \Zend\Filter\StringTrim())
                ->attach( new \Zend\Filter\StripTags());
        $inicio->getValidatorChain()->attach(new \Zend\Validator\NotEmpty());
        $this->add($inicio);  
    }
}
