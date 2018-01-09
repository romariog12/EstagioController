<?php
namespace Vaga\Form;
use Zend\Form\Form;

/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class LancarDocumentoForm extends Form {
    
    
    public function __construct() {
        parent::__construct("lancarDocumento", array()); 
        $this->setAttributes([
            'class'=>"form form-group",
            'id'=> 'my-form'
        ]);
         
         $this->add(array(
             
             'name' => 'inicioEnc',
             'type' => 'date',
             'options' => array(
                'label'=> 'Inicio'
             ),
         ));
         $this->add(array(
             'name' => 'fimEnc',
             'type' => 'date',
             'options' => array(
                'label'=> 'Fim'
             ),
         ));
         $this->add(array(
             'type' => 'submit',
             'name' => 'lançar',
         ));
         $this->add(array(
             'type' => 'submit',
             'name' => 'salvar',
             'attributes' => array(
                 'class' =>'btn  btn-success',
            
             ),
         ));
         
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'documento',
             'options' => array(
                    'disable_inarray_validator' => true,
                    'value_options' => array(
                        '' =>   '',
                        'Termo de Compromisso' => 'Termo de Compromisso',
                        'Termo Aditivo' => 'Termo Aditivo',
                         
                     ),
             )    
     ));
    }
}
    
