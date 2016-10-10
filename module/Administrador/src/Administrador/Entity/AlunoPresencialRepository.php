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
}
