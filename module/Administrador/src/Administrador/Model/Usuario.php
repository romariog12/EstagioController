<?php
namespace Administrador\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class Usuario implements InputFilterAwareInterface{
   
    public $nome;
    public $matricula;
    public $cargo;
    public $nivel;
    public $senha;
    public $login;
    protected $inputFilter;
    
    public function exchangeArray($data)
     {
         $this->nome     = (isset($data['nome']))     ? $data['nome']     : null;
         $this->matricula = (isset($data['matricula'])) ? $data['matricula'] : null;
         $this->cargo  = (isset($data['cargo']))  ? $data['cargo']  : null;
         $this->nivel  = (isset($data['nivel']))  ? $data['nivel']  : null;
         $this->senha  = (isset($data['senha']))  ? $data['senha']  : null;
         $this->login  = (isset($data['login']))  ? $data['login']  : null;
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
               'name'=> 'cargo',
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
               'name'=> 'nivel',
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
               'name'=> 'senha',
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
               'name'=> 'login',
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
