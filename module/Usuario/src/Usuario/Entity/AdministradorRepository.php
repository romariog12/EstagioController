<?php

namespace Usuario\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * Description of AdministradorRepository
 *
 * @author romario
 */

class AdministradorRepository extends EntityRepository{
    
    public function findByLoginAndPassword($login, $password) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.login','u.senha','u.nivel', 'l')
                        ->from('Usuario\Entity\Administrador','l')
                        ->where('l.login = :a1','l.senha = :a2')
                        ->setParameter('a1', $login)->setParameter('a2', $password)->getQuery()->getResult();
        if (!is_null($userLogin)) {
                return $userLogin;      
        }
        return false;
    }  
}
