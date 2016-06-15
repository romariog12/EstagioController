<?php


namespace Perfil\Entity;


class PerfilRepository extends \Doctrine\ORM\EntityRepository{
    
    public function findByPerfil($empresa){
        $userLogin = $this->createQueryBuilder('m')
                        >select('m.Matricula,m.Nome , m.Id, m.Curso')
                         ->from('bundle:entity','m')
                         ->where('m.Matricula = :a1')
                        ->setParameter('a1', $empresa)->getQuery()->getResult();
        return $userLogin;
    }
    
    
    
    
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

