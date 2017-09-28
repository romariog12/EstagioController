<?php
namespace Vaga\Form;
use Zend\Form\Form;

/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class editarAcompanhamentoForm extends Form {
    
    
    public function __construct() {
        parent::__construct("editarAcompanhamentoForm", array()); 
        $this->setAttributes([
            'class'=>"form form-group",
            'id'=> 'editarDocumentoForm'
        ]);
         
         $this->add(array(
             'name' => 'editarInicio',
             'type' => 'text',
             'options' => array(
                'label'=> 'Inicio'
             ),
         ));
         $this->add(array(
             'name' => 'editarFim',
             'type' => 'text',
             'options' => array(
                'label'=> 'Fim'
             ),
         ));
         $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'editarPeriodo',
             'options' => array(
                    'disable_inarray_validator' => true,
                    'value_options' => array(
                        '1º Relatório' => '1º Relatório',
                        '2º Relatório' => '2º Relatório',
                        '3º Relatório' => '3º Relatório',
                        '4º Relatório' => '4º Relatório'
                     ),
             )    
     ));
           $this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'acompanhante',
             'options' => array(
                    'disable_inarray_validator' => true,
                    'value_options' => array(
                        'Instituição de Ensino' => 'Instituição de Ensino',
                        'Empresa Concedente' => 'Empresa Concedente',
                        'Agente de Integração' => 'Agente de Integração'
                     ),
             )    
     ));
         $this->add(array(
             'name' => 'salvar',
             'type' => 'submit'
         ));
    }
}
    
