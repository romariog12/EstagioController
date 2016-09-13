<?php

namespace Vaga\Entity;

class VagaRepository extends \Doctrine\ORM\EntityRepository{
    
    public function findByRecisaoAndCursoVaga($recisao, $curso) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.recisao', 'l')
                        ->from('Vaga\Entity\Vaga','l')
                        ->where('l.cursoVaga = :a1','l.recisao = :a2')
                        ->setParameter('a1', $curso)
                        ->setParameter('a2', $recisao)->getQuery()->getResult();
        return $userLogin;
    }
        public function findByAnoVagaAndMesVaga($anoVaga, $mesVaga ) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from('Vaga\Entity\Vaga','l')
                        ->where('l.anoVaga = :a1','l.mesVaga = :a3')
                        ->setParameter('a1', $anoVaga)
                        
                        ->setParameter('a3', $mesVaga)->getQuery()->getResult();
        return $userLogin;
    }
    public function findByAnoVagaAndCursoVaga($anoVaga, $cursoVaga ) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from('Vaga\Entity\Vaga','l')
                        ->where('l.anoVaga = :a1','l.cursoVaga = :a3')
                        ->setParameter('a1', $anoVaga)
                        
                        ->setParameter('a3', $cursoVaga)->getQuery()->getResult();
        return $userLogin;
    }
     
} 

