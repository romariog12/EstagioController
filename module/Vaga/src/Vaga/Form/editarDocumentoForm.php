<?php
namespace Vaga\Form;
use Zend\Form\Form;

/**
 * Description of LancarDocumentoForm
 *
 * @author romario
 */
class editarDocumentoForm extends Form {
    
    
    public function __construct() {
        parent::__construct("editarDocumentoForm", array()); 
        $this->setAttributes([
            'class'=>"form form-group",
            'id'=> 'editarDocumentoForm'
        ]);
         
         $this->add(array(
             
             'name' => 'editarInicio',
             'type' => 'date',
             'options' => array(
                'label'=> 'Inicio'
             ),
         ));
         $this->add(array(
             'name' => 'editarFim',
             'type' => 'date',
             'options' => array(
                'label'=> 'Fim'
             ),
         ));
         
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'editarDocumento',
             'options' => array(
                    'disable_inarray_validator' => true,
                    'value_options' => array(
                        'TCE' => 'TCE',
                        'TA' => 'TA',
                         
                     ),
             )    
     ));
         $this->add(array(
             'name' => 'salvar',
             'type' => 'submit'
         ));
    }
}
    
