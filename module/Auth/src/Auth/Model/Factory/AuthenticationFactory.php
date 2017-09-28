<?php

namespace Auth\Model\Factory;

use Auth\Model\Adapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Base\Model\Entity;

/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class AuthenticationFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $entityManager = $serviceLocator->get(Entity::em);
        return new AuthenticationService(new Session(), new Adapter($entityManager));
    }
}
