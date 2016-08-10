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
    
}

