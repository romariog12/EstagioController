<?php

namespace Aluno\Entity;
use Doctrine\ORM\EntityRepository;
use Base\Model\Entity;

/**
 * Description of AdministradorRepository
 *
 * @author romario
 */

class AlunoPresencialRepository extends EntityRepository{
    
    public function findByNomeL($nome) {
        $qb = $this->createQueryBuilder('u')
                        ->select('u.nome', 'l')
                        ->from(Entity::alunoPresencial,'l')
                        ->where('l.nome LIKE :a1')
                        ->setParameter('a1', '%'.$nome.'%')
                        ->getQuery()
                        ->getResult();
        
                return $qb;      
        
    }  
     public function findByMatriculaAndCurso($matricula, $curso) {
        $qb = $this->createQueryBuilder('u')
                        ->select('u.matricula', 'l')
                        ->from(Entity::alunoPresencial,'l')
                        ->where('l.matricula = :a1','l.curso = :a2')
                        ->setParameter('a1', $matricula)
                        ->setParameter('a2', $curso)
                        ->getQuery()
                        ->getResult();
        
                return $qb;      
        
    }  
    public function findByNomeAndCurso($nome, $curso) {
        $qb = $this->createQueryBuilder('u')
                        ->select('u.nome', 'l')
                        ->from(Entity::alunoPresencial,'l')
                        ->where('l.nome LIKE :a1','l.curso LIKE :a2')
                        ->setParameter('a1', '%'.$nome.'%')
                        ->setParameter('a2', '%'.$curso.'%')
                        ->getQuery()
                        ->getResult();
        
                return $qb;      
    }
    public function findByCurso($curso) {
        $qb = $this->createQueryBuilder('u')
                        ->select('u.nome', 'l')
                        ->from(Entity::alunoPresencial,'l')
                        ->where('l.curso LIKE :a1')
                        ->setParameter('a1', '%'.$curso.'%')
                        ->getQuery()
                        ->getResult();
        
                return $qb;   
    }
    public function findAll() {
         return $this->findBy(array(), array('nome' => 'ASC'));
    }
    public function findByCpfAndSenha($cpf, $password) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.Cpf', 'u.senha','l')
                        ->from(Entity::alunoPresencial,'l')
                        ->where('l.Cpf = :a1','l.senha = :a2')
                        ->setParameter('a1', $cpf)
                        ->setParameter('a2', $password)
                        ->getQuery()
                        ->getResult();
        if (!is_null($userLogin)) {
                return $userLogin;      
        }
        return false;
    }
}
