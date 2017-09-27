<?php


namespace Vaga\Model;

use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;
/**
 * Description of LancarDocumento
 *
 * @author romario
 */
class EditarAcompanhamento implements InputFilterAwareInterface{
   
    public $editarInicio;
    public $editarFim;
    public $editarPeriodo;
    public $acompanhante;
    protected $inputFilter; 
    public function exchangeArray($data){
         $this->editarInicio = (isset($data['editarInicio'])) ? $data['editarInicio'] : null;
         $this->editarFim  = (isset($data['editarFim']))  ? $data['editarFim']  : null;
         $this->editarDocumento  = (isset($data['editarPeriodo']))  ? $data['editarPeriodo']  : null;
         $this->acompanhante  = (isset($data['acompanhante']))  ? $data['acompanhante']  : null;
     }
     
    public function getInputFilter() {
        if (!$this->inputFilter) {
             $inputFilter = new InputFilter();
             $inputFilter->add(array(
                 'name'     => 'editarInicio',
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
                 'name'     => 'editarFim',
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
                 'name'     => 'editarPeriodo',
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
}
