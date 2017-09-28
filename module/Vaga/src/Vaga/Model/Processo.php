<?php


namespace Vaga\Model;

use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class Processo implements InputFilterAwareInterface{
   
    public $operacao1;
    public $operacao2;
    public $operacao3;
    public $operacao4;
    protected $inputFilter; 
    public function exchangeArray($data)
     {
       
         $this->operacao1 = (isset($data['operacao1'])) ? $data['operacao1'] : null;
         $this->operacao2 = (isset($data['operacao2'])) ? $data['operacao2'] : null;
         $this->operacao3 = (isset($data['operacao3'])) ? $data['operacao3'] : null;
         $this->operacao4 = (isset($data['operacao4'])) ? $data['operacao4'] : null;
     }
     
    public function getInputFilter() {
        if (!$this->inputFilter) {
             $inputFilter = new InputFilter();
             $inputFilter->add(array(
                 'name'     => 'operacao1',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $inputFilter->add(array(
                 'name'     => 'operacao2',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'operacao3',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));
              $inputFilter->add(array(
                 'name'     => 'operacao4',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
             ));

             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
         throw new \Exception("Not used");
    }

//put your code here
}
