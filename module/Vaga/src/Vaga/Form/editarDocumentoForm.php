<?php
namespace Vaga\Form;
use Zend\Form\Form;

/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
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
                        'Termo de Compromisso' => 'Termo de Compromisso',
                        'Termo Aditivo' => 'Termo Aditivo'
                         
                     ),
             )    
     ));
         $this->add(array(
             'name' => 'salvar',
             'type' => 'submit'
         ));
    }
}
    
