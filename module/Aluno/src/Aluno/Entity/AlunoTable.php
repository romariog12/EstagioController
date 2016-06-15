<?php
namespace Aluno\Entity;

    use Zend\Db\TableGateway\AbstractTableGateway;
    use Zend\Db\TableGateway\TableGateway;
 
  

    class AlunoTable extends AbstractTableGateway{  
   
    private $TableGateway;
    
        public function __construct(TableGateway $TableGateway ) {
            $this->TableGateway = $TableGateway;
        }
        
      
        
        public function findAll(){
                $resultSet = $this->TableGateway ->select();
                return $resultSet;
        }
        public function findBy(){
            $resultSet = $this->TableGateway ->select();
            
                return $resultSet;
        }
    
}
