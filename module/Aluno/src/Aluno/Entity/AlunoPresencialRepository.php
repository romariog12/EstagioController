<?php

namespace Aluno\Entity;
use Doctrine\ORM\EntityRepository;
use Base\Model\Entity;

/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */

class AlunoPresencialRepository extends EntityRepository{
    
    public function findByNome($nome) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.nome', 'l')
                        ->from(Entity::aluno,'l')
                        ->where('l.nome LIKE :a1')
                        ->setParameter('a1', '%'.$nome.'%')
                        ->getQuery()
                        ->getResult();
        
                return $result;      
        
    }  
    public function findByMatricula($matricula) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.matricula', 'l')
                        ->from(Entity::aluno,'l')
                        ->where('l.matricula = :a1')
                        ->setParameter('a1', $matricula)
                        ->getQuery()
                        ->getResult();
        
                return $result;  
    } 
     public function findByMatriculaAndCurso($matricula, $curso) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.matricula', 'l')
                        ->from(Entity::aluno,'l')
                        ->where('l.matricula = :a1','l.curso = :a2')
                        ->setParameter('a1', $matricula)
                        ->setParameter('a2', $curso)
                        ->getQuery()
                        ->getResult();
        
                return $result;      
        
    }  
    public function findByNomeAndCurso($nome, $curso) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.nome', 'l')
                        ->from(Entity::aluno,'l')
                        ->where('l.nome LIKE :a1','l.curso LIKE :a2')
                        ->setParameter('a1', '%'.$nome.'%')
                        ->setParameter('a2', '%'.$curso.'%')
                        ->getQuery()
                        ->getResult();
        
                return $result;      
    }
    public function findByCurso($curso) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.nome', 'l')
                        ->from(Entity::aluno,'l')
                        ->where('l.curso LIKE :a1')
                        ->setParameter('a1', '%'.$curso.'%')
                        ->getQuery()
                        ->getResult();
        
                return $result;   
    }
    public function findAll() {
         return $this->findBy(array(), array('nome' => 'ASC'));
    }
    public function findByCpfAndSenha($cpf, $password) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.Cpf', 'u.senha','l')
                        ->from(Entity::aluno,'l')
                        ->where('l.Cpf = :a1','l.senha = :a2')
                        ->setParameter('a1', $cpf)
                        ->setParameter('a2', $password)
                        ->getQuery()
                        ->getResult();
        if (!is_null($result)) {
                return $result;      
        }
        return false;
    }
}
