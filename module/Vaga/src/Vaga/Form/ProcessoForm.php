<?php
namespace Vaga\Form;
use Zend\Form\Form;

/**
 * Description of LancarDocumentoForm
 *
 * @author romario
 */
class ProcessoForm extends Form {
    
    
    public function __construct() {
        parent::__construct("processo", array()); 
        $this->setAttributes([
            'class'=>"form form-group",
            'id'=> 'processoForm'
        ]);
    $this->add(array(
   'type' => 'Zend\Form\Element\Checkbox',
   'name' => 'operacao1',
   ));
   $this->add(array(
   'type' => 'Zend\Form\Element\Checkbox',
   'name' => 'operacao2',

   ));
   $this->add(array(
   'type' => 'Zend\Form\Element\Checkbox',
   'name' => 'operacao3',
   ));
   $this->add(array(
   'type' => 'Zend\Form\Element\Checkbox',
   'name' => 'operacao4',
   ));    
     }
    }
    
