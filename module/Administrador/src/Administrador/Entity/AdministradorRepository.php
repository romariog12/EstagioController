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
                        ->join('u.login', 'l')
                        ->where('l.login = :a1')
                        ->setParameter('a1', $login)->getQuery()->getOneOrNullResult();
        if (!is_null($userLogin)) {
            if ($userLogin->getLogin()->encryptPassword($password) == $userLogin->getLogin()->getSenha()) {
               
                $session = new Session;
                $session->setNome($userLogin->getNome());
                $session->setLogin($userLogin->getLogin()->getLogin());
                $session->setNivel($userLogin->getNivel()->getId());
                return $session;
            }
        }
        return false;
    }
    
    
    
}
