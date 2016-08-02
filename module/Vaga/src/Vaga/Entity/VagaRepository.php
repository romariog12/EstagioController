<?php

namespace Vaga\Entity;

class VagaRepository extends \Doctrine\ORM\EntityRepository{
    
    public function findByAtivo() {
        $valor = $this->createQueryBuilder('u')
                        ->select('u.recisao', 'l')
                        ->from('Vaga\Entity\Encaminhamento','l')
                        ->where('l.recisao = :a1')
                        ->setParameter('a1','')->getQuery()->getResult();
        return $valor;
       
    }
    
}

