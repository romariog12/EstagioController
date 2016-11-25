<?php

namespace Administrador\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * Description of UsuarioRepository
 *
 * @author romario
 */

class EmpresaRepository extends EntityRepository{
    
   public function findByEmpresa($empresa) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.empresa', 'l')
                        ->from('Administrador\Entity\Empresa','l')
                        ->where('l.empresa LIKE :a1')
                 
                        ->setParameter('a1', '%'.$empresa.'%')
                       
                        ->getQuery()->getResult();
        
                return $result;      
        
    }
     public function findByCnpj($cnpj) {
        $result = $this->createQueryBuilder('u')
                        ->select('u.cnpj', 'l')
                        ->from('Administrador\Entity\Empresa','l')
                        ->where('l.cnpj = :a1')
                       
                        ->setParameter('a1', $cnpj)
                        ->getQuery()->getResult();
        
                return $result;      
        
    }  
     public function findAll() {
         return $this->findBy(array(), array('empresa' => 'ASC'));
    }
}