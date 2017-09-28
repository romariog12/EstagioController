<?php
namespace Administrador\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class Aluno implements InputFilterAwareInterface{
   
    public $nome;
    public $matricula;
    public $cpf;
    public $email;
    public $telefone;
    public $curso;
    protected $inputFilter;
    
    public function exchangeArray($data)
     {
         $this->nome     = (isset($data['nome']))     ? $data['nome']     : null;
         $this->matricula = (isset($data['matricula'])) ? $data['matricula'] : null;
         $this->cpf  = (isset($data['cpf']))  ? $data['cpf']  : null;
         $this->email  = (isset($data['email']))  ? $data['email']  : null;
         $this->telefone  = (isset($data['telefone']))  ? $data['telefone']  : null;
         $this->curso  = (isset($data['curso']))  ? $data['curso']  : null;
     }

    public function getInputFilter() {
        if (!$this->inputFilter) {
           $inputFilter = new InputFilter();
           $inputFilter->add([
               'name'=> 'nome',
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
               'name'=> 'matricula',
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
               'name'=> 'cpf',
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
               'name'=> 'curso',
               'filters'=>[
                       ['name' => 'StripTags'],
                       ['name' => 'StringTrim']
                ],
                'validators' => [
                        [
                            'name'    => 'StringLength',
                            'options' =>[
                                'encoding' => 'UTF-8'
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
