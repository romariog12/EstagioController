<?php

namespace Aluno\Entity;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;


class AlunoGateway extends AbstractTableGateway {
    
    public  function  __construct () 
   { 
             $this -> table  =  'aluno' ; 
             $this -> featureSet  =  new  Feature\FeatureSet(); 
             $this -> featureSet -> addFeature ( new  Feature\GlobalAdapterFeature ()); 
             $this -> initialize(); 
   } 
  
    
    
    
    
}
