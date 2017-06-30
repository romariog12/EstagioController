<?php

namespace Base\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Base\Model\Entity;

class MensagemRepository extends \Doctrine\ORM\EntityRepository {
    
    public function findByStatusAndIdEmpresa($status, $idDestinatario){
        $selecionarMensagem = $this->createQueryBuilder('u')
                ->select('u.status','l')
                ->from(Entity::mensagem, 'l')
                ->where('l.status = :a1','l.iddestinatario = :a2')
                ->setParameters(new ArrayCollection([
                    new Parameter('a1', $status),
                    new Parameter('a2', $idDestinatario)
                ]))
                ->getQuery()
                ->getResult();
        return $selecionarMensagem;
    }
}
