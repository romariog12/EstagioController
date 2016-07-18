<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Administrador\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * Description of AdministradorRepository
 *
 * @author romario
 */
class AdministradorRepository extends EntityRepository{
    
    public function findByLoginAndPassword($login, $password) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.login','u.senha', 'l')
                        ->from('Administrador\Entity\Administrador','l')
                        ->where('l.login = :a1','l.senha = :a2')
                        ->setParameter('a1', $login)->setParameter('a2', $password)->getQuery()->getResult();
        if (!is_null($userLogin)) {
                return $userLogin;
            
        }
        return false;
    }
    
}
