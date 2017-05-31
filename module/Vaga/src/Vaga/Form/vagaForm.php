<?php
namespace Vaga\Form;
use Zend\Form\Form;
/**
 * Description of LancarDocumentoForm
 *
 * @author romario
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
        ));
         $this->add(array(
             'name' => 'curso',
             'type' => 'Zend\Form\Element\Select',
         ));
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'agente',
         ));
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'empresa',
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
         $this->add(array(
             'type' => 'submit',
             'name' => 'salvar',
             'attributes' => array(
                 'class' =>'btn  btn-success',
            
             ),
         ));
     }
    }
    
