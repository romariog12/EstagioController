<?php

namespace Vaga\Entity;

class DocumentoPresencialRepository extends \Doctrine\ORM\EntityRepository{
    
   
     public function findBySituacaoAndTipo($situacao, $tipo) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.entregue', 'l')
                        ->from('Vaga\Entity\DocumentoPresencial','l')
                        ->where('l.entregue = :a1','l.relatorio = :a2')
                        ->setParameter('a1', $situacao)
                        ->setParameter('a2', $tipo)->getQuery()->getResult();
        return $result;
    }
    public function findByIdvagaDocumentoAndSituacao($idVagaDocumento, $situacao) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.idvagaDocumento', 'l')
                        ->from('Vaga\Entity\DocumentoPresencial','l')
                        ->where('l.idvagaDocumento = :a1','l.entregue = :a2')
                        ->setParameter('a1', $idVagaDocumento)
                        ->setParameter('a2', $situacao)->getQuery()->getResult();
        return $result;
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
} 

