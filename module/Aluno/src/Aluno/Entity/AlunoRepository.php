<?php

namespace Aluno\Entity;

class AlunoRepository extends \Doctrine\ORM\EntityRepository
{   
    public function findByMatricula($matricula) {
        $userLogin = $this->createQueryBuilder('m')
                        >select('m.Matricula,m.Nome , m.Id, m.Curso')
                         ->from('bundle:entity','m')
                         ->where('m.Matricula = :a1')
                        ->setParameter('a1', $matricula)->getQuery()->getResult();
        return $userLogin;
    }
        public function findByidaluno($id) {
        $userLogin = $this->createQueryBuilder('m')
                        >select('m.Matricula,m.Nome , m.Id, m.Curso')
                         ->from('bundle:entity','m')
                         ->where('m.idAluno = :a1')
                        ->setParameter('a1', $id)->getQuery()->getResult();
        return $userLogin;
    }
    
}
