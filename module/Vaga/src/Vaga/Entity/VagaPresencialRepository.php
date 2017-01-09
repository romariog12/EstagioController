<?php

namespace Vaga\Entity;
use Base\Model\Entity;

class VagaPresencialRepository extends \Doctrine\ORM\EntityRepository{
    
    public function findByRecisaoAndCursoVaga($recisao, $curso) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.recisao', 'l')
                        ->from(Entity::vagaPresencial,'l')
                        ->where('l.cursoVaga = :a1','l.recisao = :a2')
                        ->setParameter('a1', $curso)
                        ->setParameter('a2', $recisao)->getQuery()->getResult();
        return $result;
    }
        public function findByAnoVagaAndMesVaga($anoVaga, $mesVaga ) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from(Entity::vagaPresencial,'l')
                        ->where('l.anoVaga = :a1','l.mesVaga = :a3 ')
                        ->setParameter('a1', $anoVaga)
                        
                        ->setParameter('a3', $mesVaga)->getQuery()->getResult();
        return $userLogin;
    }
    public function findByAnoVagaAndCursoVaga($anoVaga, $cursoVaga ) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from(Entity::vagaPresencial,'l')
                        ->where('l.anoVaga = :a1','l.cursoVaga = :a3')
                        ->setParameter('a1', $anoVaga)       
                        ->setParameter('a3', $cursoVaga)->getQuery()->getResult();
        return $userLogin;
    }
 
    
    public function findByAnoVagaAndMesVagaAndCursoVaga($anoVaga, $mesVaga, $cursoVaga) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from(Entity::vagaPresencial,'l')
                        ->where('l.anoVaga = :a1','l.mesVaga = :a2 ','l.cursoVaga = :a3 ')
                        ->setParameter('a1', $anoVaga)   
                        ->setParameter('a2', $mesVaga)
                        ->setParameter('a3', $cursoVaga)
                ->getQuery()->getResult();
        return $result;
    }
     public function findByRecisaoAndEmpresa($recisao, $empresa) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.recisao', 'l')
                        ->from(Entity::vagaPresencial,'l')
                        ->where('l.empresa = :a1','l.recisao = :a2')
                        ->setParameter('a1', $empresa)
                        ->setParameter('a2', $recisao)->getQuery()->getResult();
        return $result;
    }
    public function findByRecisaoAndIdAlunoVaga($recisao, $idAlunoVaga) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.recisao', 'l')
                        ->from(Entity::vagaPresencial,'l')
                        ->where('l.idalunovaga = :a1','l.recisao = :a2')
                        ->setParameter('a2', $recisao)
                        ->setParameter('a1', $idAlunoVaga)
                        ->getQuery()->getResult();
        return $result;
    }
    public function findAll() {
         return $this->findBy(array(), array('empresa' => 'ASC'));
    }
} 

