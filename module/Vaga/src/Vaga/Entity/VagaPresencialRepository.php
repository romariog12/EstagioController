<?php

namespace Vaga\Entity;

class VagaPresencialRepository extends \Doctrine\ORM\EntityRepository{
    
    public function findByRecisaoAndCursoVaga($recisao, $curso) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.recisao', 'l')
                        ->from('Vaga\Entity\VagaPresencial','l')
                        ->where('l.cursoVaga = :a1','l.recisao = :a2')
                        ->setParameter('a1', $curso)
                        ->setParameter('a2', $recisao)->getQuery()->getResult();
        return $userLogin;
    }
        public function findByAnoVagaAndMesVaga($anoVaga, $mesVaga ) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from('Vaga\Entity\VagaPresencial','l')
                        ->where('l.anoVaga = :a1','l.mesVaga = :a3 ')
                        ->setParameter('a1', $anoVaga)
                        
                        ->setParameter('a3', $mesVaga)->getQuery()->getResult();
        return $userLogin;
    }
    public function findByAnoVagaAndCursoVaga($anoVaga, $cursoVaga ) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from('Vaga\Entity\VagaPresencial','l')
                        ->where('l.anoVaga = :a1','l.cursoVaga = :a3')
                        ->setParameter('a1', $anoVaga)       
                        ->setParameter('a3', $cursoVaga)->getQuery()->getResult();
        return $userLogin;
    }
    public function findByAnoVagaAndTipo ($anoVaga, $tipo ) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.iddocumento', 'l')
                        ->from('Vaga\Entity\DocumentoPresencial','l')
                        ->where('l.anoDocumento = :a1','l.relatorio LIKE :a2')
                        ->setParameter('a1', $anoVaga)
                        ->setParameter('a2', '%'.$tipo.'%')
                        ->getQuery()->getResult();
        return $userLogin;
    }
    public function findByAnoDocumentoAndTipoAndCurso ($anoVaga, $tipo,$curso ) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.iddocumento', 'l')
                        ->from('Vaga\Entity\DocumentoPresencial','l')
                        ->where('l.anoDocumento = :a1','l.relatorio LIKE :a2','l.cursoDocumento = :a3 ')
                        ->setParameter('a1', $anoVaga)
                        ->setParameter('a2', '%'.$tipo.'%')
                        ->setParameter('a3', $curso)
                        ->getQuery()->getResult();
        return $userLogin;
    }
    public function findByAnoVagaAndMesVagaAndCursoVaga($anoVaga, $mesVaga, $cursoVaga) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from('Vaga\Entity\VagaPresencial','l')
                        ->where('l.anoVaga = :a1','l.mesVaga = :a2 ','l.cursoVaga = :a3 ')
                        ->setParameter('a1', $anoVaga)   
                        ->setParameter('a2', $mesVaga)
                        ->setParameter('a3', $cursoVaga)
                ->getQuery()->getResult();
        return $result;
    }
     
} 

