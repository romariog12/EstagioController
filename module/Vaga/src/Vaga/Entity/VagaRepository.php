<?php

namespace Vaga\Entity;

class VagaRepository extends \Doctrine\ORM\EntityRepository{
    
    public function findByIdalunovaga($id){
        $resul = $this->_em->createQueryBuilder('m')
                        >select('')
                         ->from('bundle:entity','m')
                         ->where('m.idAluno = :a1')
                        ->setParameter('a1', $id)->getQuery()->getResult();
        return $resul;
    }
   public function findByIdvagaEncaminhamento($idVaga){
        $resul = $this->_em->createQueryBuilder('m')
                        >select('m.Empresa,m.Agente , m.Incio, m.Fim')
                         ->from('bundle:entity','m')
                         ->where('m.idVaga_Encaminhamento = :a1')
                        ->setParameter('a1', $idVaga)->getQuery()->getResult();
        return $resul;
    }
    
      
    
  
    
}

