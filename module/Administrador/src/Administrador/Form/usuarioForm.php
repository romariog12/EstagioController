<?php
namespace Administrador\Form;
use Zend\Form\Form;

/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 **/

class usuarioForm extends Form{
    public function __construct() {
        parent::__construct('usuario');
        $this->setAttributes([
            'id'=> 'cadastrarUsuarioForm'
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
            'name'=>'login',
            'id'=>'login',
            'class'=>'form-control'
        ]);
           $this->add([
            'type'=>'text',
            'name'=>'cargo',
            'id'=>'cargo',
            'class'=>'form-control'
        ]);
           $this->add([
            'type'=>'password',
            'name'=>'senha',
            'id'=>'senha',
               'attributes' => array(
                 'class' =>'form-control'
            
             )
           
        ]);
            $this->add([
                'name' => 'nivel',
                'type' => 'Zend\Form\Element\Select',
                'attributes' => [
                    'class' =>'form-control'
                 ],
                'options'=> [
                    'disable_inarray_validator' => true,
                    'value_options' => array(
                        '' =>   '',
                        '1' => 'Administrador',
                        '2' => 'Usuário comum',
                         
                     ),
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
