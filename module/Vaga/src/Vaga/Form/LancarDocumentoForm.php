<?php
namespace Vaga\Form;
use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Description of LancarDocumentoForm
 *
 * @author romario
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
                     'value_options' => array(
                        '' =>   '',
                        'TCE' => 'TCE',
                        'TA' => 'TA',
                     ),
             )    
     ));
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'relatorioInstituicao',
             'options' => array(
                     'value_options' => array(
                        ''=>   '',
                        'instituicao' => 'Institui',
                        'empresa' => '2º RT Instituição',
                       

                     ),
             )    
     ));
         
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
    
