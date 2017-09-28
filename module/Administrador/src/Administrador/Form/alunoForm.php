<?php
namespace Administrador\Form;
use Zend\Form\Form;

/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 **/

class alunoForm extends Form{
    public function __construct() {
        parent::__construct('aluno');
        $this->setAttributes([
            'id'=> 'alunoForm'
        ]);
        $this->add([
            'type'=>'text',
            'name'=>'nome',
        ]);
         $this->add([
            'type'=>'text',
            'name'=>'matricula',
            'id'=>'matricula',
            'class'=>'form-control'
        ]);
          $this->add([
            'type'=>'text',
            'name'=>'cpf',
            'id'=>'cpf',
            'class'=>'form-control'
        ]);
           $this->add([
            'type'=>'text',
            'name'=>'email',
            'id'=>'email',
            'class'=>'form-control'
        ]);
           $this->add([
            'type'=>'text',
            'name'=>'telefone',
            'id'=>'telefone',
               'attributes' => array(
                 'class' =>'form-control'
            
             )
           
        ]);
            $this->add([
                'name' => 'curso',
                'type' => 'Zend\Form\Element\Select',
                'attributes' => [
                    'class' =>'form-control'
                 ],
                'options'=> [
                    'disable_inarray_validator' => true,
                ]
        ]);
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
