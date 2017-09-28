<?php

namespace Administrador\Form;
use Zend\Form\Form;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class empresaForm extends Form{
    public function __construct() {
        parent::__construct('empresaForm');
        $this->setAttributes([
            'id'=> 'empresaForm'
        ]);
        $this->add([
            'type'=>'text',
            'name'=>'empresa',
        ]);
         $this->add([
            'type'=>'text',
            'name'=>'cnpj',
            'id'=>'cnpj',
            'class'=>'form-control'
        ]);
         $this->add([
            'type'=>'text',
            'name'=>'responsavel',
            'id'=>'responsavel',
               'attributes' => array(
                 'class' =>'form-control'
             )
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
            'class'=>'form-control'
        ]);
           $this->add([
            'type'=>'text',
            'name'=>'endereco',
            'id'=>'endereco',
               'attributes' => array(
                 'class' =>'form-control'
            
             )
        ]);
        $this->add([
            'type'=>'text',
            'name'=>'senha',
            'id'=>'senha',
               'attributes' => array(
                 'class' =>'form-control'
             ) 
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
