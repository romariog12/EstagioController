<?php

namespace Aluno\Entity;
use Zend\Db\TableGateway\Exception\InvalidArgumentException;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;


class TableGateway extends AbstractTableGateway{  

    
    protected $table;
    
    
    public function __construct(Adapter $adapter, ResultSet $resultset, $mapping) {
        
        if (!is_object($mapping)){
            throw new InvalidArgumentException('Mapeamento tem que ser do tipo Objeto');
        }
        $this->adapter = $adapter;
        $this->resultSetPrototype = $resultset;
        $this->resultSetPrototype ->setArrayObjectPrototype('$mapping');
        $this->initialize();
        ;
    } 
   
    
//Seleciona todos registros
    public function fetchAll (){
        return $this->select();
    }
    //
    public function fundBy(Array $aluno = array()){
        $row = $this->select('$aluno')->current();
            if($row){
                return $row;
            }
            else{
                return false;          
            }
    }
    public function save($mapping){
        if (!is_object($mapping)){
            throw new InvalidArgumentException('Mapeamento tem que ser do tipo Objeto');
        }
        
        $id = (int)$mapping-> getId();
        if($id==0 && $this->isset($mapping ->toArray())){
            return true;
        }
        $row = $this->select(['id'=>$id])->current();
        if ($row && $this->isset($mapping ->toArray())){
            return true;
        }else{
        return false;
        }
     } 
     public function remove(Array $usuario=['']){
         if ($this->delete($aluno)) {
            return true;
        } 
        else {
            return false;
        }
    }   
}
