<?php
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
namespace Administrador\Entity;
use Doctrine\ORM\EntityRepository;
use Base\Model\Entity;

class AdministradorRepository extends EntityRepository{
    
    public function findByLoginAndPassword($login, $password) {
        $userLogin = $this->createQueryBuilder('u')
                        ->select('u.login','u.senha','u.nivel', 'l')
                        ->from(Entity::administrador,'l')
                        ->where('l.login = :a1','l.senha = :a2')
                        ->setParameter('a1', $login)->setParameter('a2', $password)->getQuery()->getResult();
        if (!is_null($userLogin)) {
                return $userLogin;
            
        }
        return false;
    }
    
}
