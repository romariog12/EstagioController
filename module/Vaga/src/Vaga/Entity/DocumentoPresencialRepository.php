<?php

namespace Vaga\Entity;
use Base\Model\Entity;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Common\Collections\ArrayCollection;
class DocumentoPresencialRepository extends \Doctrine\ORM\EntityRepository{
    
   
     public function findBySituacaoAndTipo($situacao, $tipo) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.entregue', 'l')
                        ->from(Entity::documentoPresencial,'l')
                        ->where('l.entregue = :a1','l.relatorio = :a2')
                        ->setParameter('a1', $situacao)
                        ->setParameter('a2', $tipo)->getQuery()->getResult();
        return $result;
    }
     public function findBySituacaoAndTipoAndData( $tipo,$data) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.entregue', 'l')
                        ->from(Entity::documentoPresencial,'l')
                        ->where('l.relatorio LIKE :a2','l.fim = :a3')
                       
                        ->setParameter('a2', '%'.$tipo.'%')
                        ->setParameter('a3', $data)
                        ->getQuery()->getResult();
        return $result;
    }
    public function findByIdvagaDocumentoAndSituacao($idVagaDocumento, $situacao) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.idvagaDocumento', 'l')
                        ->from(Entity::documentoPresencial,'l')
                        ->where('l.idvagaDocumento = :a1','l.entregue = :a2')
                        ->setParameter('a1', $idVagaDocumento)
                        ->setParameter('a2', $situacao)->getQuery()->getResult();
        return $result;
    }
    public function findByFimAndIdEmpresa(\DateTime $vencimento1,
            \DateTime$vencimento2,
            \DateTime$vencimento3,
            \DateTime$vencimento4,
            \DateTime$vencimento5,
            $idEmpresa) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.fim', 'l')
                        ->from(Entity::documentoPresencial,'l')
                        ->where('l.idempresaDocumento = :b1')
                        ->andWhere('l.fim = :a1 OR l.fim = :a2 OR l.fim = :a3 OR l.fim = :a4 OR l.fim = :a5')
                        ->setParameters(new ArrayCollection([
                            new Parameter('a1', $vencimento1),
                            new Parameter('a2', $vencimento2),
                            new Parameter('a3', $vencimento3),
                            new Parameter('a4', $vencimento4),
                            new Parameter('a5', $vencimento5),
                            new Parameter('b1', $idEmpresa)    
                        ]))->getQuery()->getResult();
        return $result;
    }
    public function findByFim(\DateTime $vencimento1,
            \DateTime$vencimento2,
            \DateTime$vencimento3,
            \DateTime$vencimento4,
            \DateTime$vencimento5
            ) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.fim', 'l')
                        ->from(Entity::documentoPresencial,'l')
                        ->andWhere('l.fim = :a1 OR l.fim = :a2 OR l.fim = :a3 OR l.fim = :a4 OR l.fim = :a5')
                        ->setParameters(new ArrayCollection([
                            new Parameter('a1', $vencimento1),
                            new Parameter('a2', $vencimento2),
                            new Parameter('a3', $vencimento3),
                            new Parameter('a4', $vencimento4),
                            new Parameter('a5', $vencimento5),   
                        ]))->getQuery()->getResult();
        return $result;
    }
     public function findByOperacao($operacao1,$operacao2,$operacao3,$operacao4) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.iddocumento', 'l')
                        ->from(Entity::documentoPresencial,'l')
                        ->andWhere('l.operacao1 = :a1 AND l.operacao2 = :a2 AND l.operacao3 = :a3 AND l.operacao4 = :a4')
                        ->setParameters(new ArrayCollection([
                            new Parameter('a1', $operacao1),
                            new Parameter('a2', $operacao2),
                            new Parameter('a3', $operacao3),
                            new Parameter('a4', $operacao4) 
                        ]))->getQuery()->getResult();
        return $result;
    }
    public function findByAnoDocumentoAndTipoAndCurso ($anoVaga, $tipo,$curso ) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.iddocumento', 'l')
                        ->from(Entity::documentoPresencial,'l')
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
                        ->from(Entity::documentoPresencial,'l')
                        ->where('l.anoDocumento = :a1','l.relatorio LIKE :a2')
                        ->setParameter('a1', $anoVaga)
                        ->setParameter('a2', '%'.$tipo.'%')
                        ->getQuery()->getResult();
        return $userLogin;
    }
} 

