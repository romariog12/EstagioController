<?php
namespace Vaga\Form;
use Zend\Form\Form;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class vagaForm extends Form {
    
    
    public function __construct() {
        parent::__construct("vaga", array()); 
        $this->setAttributes([
            'class'=>"form form-group",
            'id'=> 'vagaForm',
            'data-toggle'=>"validator"
        ]);
        $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'aluno',
            'options'=> [
                    'disable_inarray_validator' => true,
                ]
        ));
         $this->add(array(
             'name' => 'curso',
             'type' => 'Zend\Form\Element\Select',
             'options'=> [
                    'disable_inarray_validator' => true,
                ]
         ));
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'agente',
             'options'=> [
                    'disable_inarray_validator' => true,
                ]
         ));
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'empresa',
             'options'=> [
                    'disable_inarray_validator' => true,
                ]
         ));
         $this->add(array(
             'type' => 'text',
             'name' => 'carga',
         ));
         $this->add(array(
             'type' => 'text',
             'name' => 'bolsa',
         ));
         $this->add(array(
             'type' => 'date',
             'name' => 'inicio',
         ));
          $this->add([
                'type' => 'Button',
                'name' => 'salvar',
                'options' => [
                    'label_options' => array(
                    'disable_html_escape' => true,
            )
                ]
        ]);
     }
    }
    
