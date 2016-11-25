<?php

namespace Oportunidade\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * Description of UsuarioRepository
 *
 * @author romario
 */

class OportunidadeRepository extends EntityRepository{
    
    public function findAll() {
         return $this->findBy(array(), array('data' => 'DESC'));
    }
        
}
