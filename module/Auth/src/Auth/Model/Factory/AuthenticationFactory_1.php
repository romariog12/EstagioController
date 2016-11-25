<?php

namespace Auth\Model\Factory;

use Auth\Model\Adapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;

/**
 * Description of AuthenticationFactory
 *
 * @author romario
 */
class AuthenticationFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return new AuthenticationService(new Session(), new Adapter($entityManager));
    }
}
