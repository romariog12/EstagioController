<?php

namespace Administrador\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * Description of AdministradorRepository
 *
 * @author romario
 */

class AlunoPresencialRepository extends EntityRepository{
    
    public function findByNomeL($nome) {
        $qb = $this->createQueryBuilder('u')
                        ->select('u.nome', 'l')
                        ->from('Administrador\Entity\AlunoPresencial','l')
                        ->where('l.nome LIKE :a1')
                        ->setParameter('a1', '%'.$nome.'%')->getQuery()->getResult();
        
                return $qb;      
        
    }  
     public function findByMatriculaAndCurso($matricula, $curso) {
        $qb = $this->createQueryBuilder('u')
                        ->select('u.matricula', 'l')
                        ->from('Administrador\Entity\AlunoPresencial','l')
                        ->where('l.matricula = :a1','l.curso = :a2')
                        ->setParameter('a1', $matricula)
                        ->setParameter('a2', $curso)
                ->getQuery()->getResult();
        
                return $qb;      
        
    }  
    public function findByNomeAndCurso($nome, $curso) {
        $qb = $this->createQueryBuilder('u')
                        ->select('u.nome', 'l')
                        ->from('Administrador\Entity\AlunoPresencial','l')
                        ->where('l.nome LIKE :a1','l.curso = :a2')
                        ->setParameter('a1', '%'.$nome.'%')
                        ->setParameter('a2', $curso)
                ->getQuery()->getResult();
        
                return $qb;      
        
    }  
     public function findAll() {
         return $this->findBy(array(), array('aluno' => 'ASC'));
    }
}
