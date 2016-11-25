<?php

namespace Vaga\Entity;

class VagaRepository extends \Doctrine\ORM\EntityRepository{
    
    public function findByRecisaoAndCursoVaga($recisao, $curso) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.recisao', 'l')
                        ->from('Vaga\Entity\Vaga','l')
                        ->where('l.cursoVaga = :a1','l.recisao = :a2')
                        ->setParameter('a1', $curso)
                        ->setParameter('a2', $recisao)->getQuery()->getResult();
        return $result;
    }
        public function findByAnoVagaAndMesVaga($anoVaga, $mesVaga ) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from('Vaga\Entity\Vaga','l')
                        ->where('l.anoVaga = :a1','l.mesVaga = :a3 ')
                        ->setParameter('a1', $anoVaga)
                        
                        ->setParameter('a3', $mesVaga)->getQuery()->getResult();
        return $result;
    }
    public function findByAnoVagaAndCursoVaga($anoVaga, $cursoVaga ) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from('Vaga\Entity\Vaga','l')
                        ->where('l.anoVaga = :a1','l.cursoVaga = :a3')
                        ->setParameter('a1', $anoVaga)       
                        ->setParameter('a3', $cursoVaga)->getQuery()->getResult();
        return $result;
    }
    public function findByAnoVagaAndTipo ($anoVaga, $tipo ) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.idencaminhamento', 'l')
                        ->from('Vaga\Entity\Encaminhamento','l')
                        ->where('l.anoDocumento = :a1','l.relatorio LIKE :a2')
                        ->setParameter('a1', $anoVaga)
                        ->setParameter('a2', '%'.$tipo.'%')
                        ->getQuery()->getResult();
        return $result;
    }
    public function findByAnoDocumentoAndTipoAndCurso ($anoVaga, $tipo,$curso ) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.idencaminhamento', 'l')
                        ->from('Vaga\Entity\Encaminhamento','l')
                        ->where('l.anoDocumento = :a1','l.relatorio LIKE :a2','l.cursoDocumento = :a3 ')
                        ->setParameter('a1', $anoVaga)
                        ->setParameter('a2', '%'.$tipo.'%')
                        ->setParameter('a3', $curso)
                        ->getQuery()->getResult();
        return $result;
    }
    public function findByAnoVagaAndMesVagaAndCursoVaga($anoVaga, $mesVaga, $cursoVaga) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.idvaga', 'l')
                        ->from('Vaga\Entity\Vaga','l')
                        ->where('l.anoVaga = :a1','l.mesVaga = :a2 ','l.cursoVaga = :a3 ')
                        ->setParameter('a1', $anoVaga)   
                        ->setParameter('a2', $mesVaga)
                        ->setParameter('a3', $cursoVaga)
                ->getQuery()->getResult();
        return $result;
    }
    
} 

