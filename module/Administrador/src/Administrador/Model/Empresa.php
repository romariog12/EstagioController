<?php

namespace Administrador\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
/**
 * Description of editarAluno
 *
 * @author romario
 */
class Empresa implements InputFilterAwareInterface{
   
    public $empresa;
    public $cnpj;
    public $responsavel;
    public $email;
    public $telefone;
    public $endereco;
    protected $inputFilter;
    
    public function exchangeArray($data)
     {
         $this->empresa     = (isset($data['empresa']))     ? $data['empresa']     : null;
         $this->cnpj = (isset($data['cnpj'])) ? $data['cnpj'] : null;
         $this->responsavel  = (isset($data['responsavel']))  ? $data['responsavel']  : null;
         $this->email  = (isset($data['email']))  ? $data['email']  : null;
         $this->telefone  = (isset($data['telefone']))  ? $data['telefone']  : null;
         $this->endereco  = (isset($data['endereco']))  ? $data['endereco']  : null;
     }

    public function getInputFilter() {
        if (!$this->inputFilter) {
           $inputFilter = new InputFilter();
           $inputFilter->add([
               'name'=> 'empresa',
               'filters'=>[
                       ['name' => 'StripTags'],
                       ['name' => 'StringTrim']
               ],
              'validators' => [
                        [
                            'name'    => 'StringLength',
                            'options' =>[
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 100
                            ]
                        ],   
                ]
            ]);
           $inputFilter->add([
               'name'=> 'cnpj',
               'filters'=>[
                       ['name' => 'StripTags'],
                       ['name' => 'StringTrim']
               ],
              'validators' => [
                        [
                            'name'    => 'StringLength',
                            'options' =>[
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 100
                            ]
                        ],   
                ]
            ]);
           $inputFilter->add([
               'name'=> 'responsavel',
               'filters'=>[
                       ['name' => 'StripTags'],
                       ['name' => 'StringTrim']
                ],
                'validators' => [
                        [
                            'name'    => 'StringLength',
                            'options' =>[
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 100
                            ]
                        ],   
                ]
            ]);
            $inputFilter->add([
               'name'=> 'email',
               'filters'=>[
                       ['name' => 'StripTags'],
                       ['name' => 'StringTrim']
                ],
                'validators' => [
                        [
                            'name'    => 'StringLength',
                            'options' =>[
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 100
                            ]
                        ],   
                ]
            ]);
             $inputFilter->add([
               'name'=> 'telefone',
               'filters'=>[
                       ['name' => 'StripTags'],
                       ['name' => 'StringTrim']
                ],
                'validators' => [
                        [
                            'name'    => 'StringLength',
                            'options' =>[
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 100
                            ]
                        ],   
                ]
            ]);
              $inputFilter->add([
               'name'=> 'endereco',
               'filters'=>[
                       ['name' => 'StripTags'],
                       ['name' => 'StringTrim']
                ],
                'validators' => [
                        [
                            'name'    => 'StringLength',
                            'options' =>[
                                'encoding' => 'UTF-8',
                                'min'      => 1,
                                'max'      => 100
                            ]
                        ],   
                ]
            ]);
              $this->inputFilter = $inputFilter;
        }
             
         return $this->inputFilter; 
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }
}
