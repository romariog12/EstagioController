<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Relatorio;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
<<<<<<< HEAD
use Zend\ModuleManager\ModuleManager;
=======
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;
use Zend\Session\SessionManager;
>>>>>>> origin/master

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
<<<<<<< HEAD
=======
       $this->initSession(array(
            'remember_me_seconds' => 180,
            'use_cookies' => true,
            'cookie_httponly' => true,
        ));
>>>>>>> origin/master
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
<<<<<<< HEAD
    public function init(ModuleManager $manager){
    $events = $manager->getEventManager();
    $sharedEvents = $events->getSharedManager();
    $sharedEvents->attach(__NAMESPACE__ , 'dispatch', function($ev) {
                    $controller = $ev->getTarget();
                    $controller ->layout('relatorioPresencial/layout/layout');
                    $auth = $ev->getApplication()->getServiceManager()->get('Zend\Authentication\AuthenticationService');
                    if(empty($auth->hasIdentity())){ 
                    $controller->plugin('redirect')->toRoute('auth');
                    }
                    foreach ($auth->getIdentity()as $l){
                        $nivel = $l[0]->getNivel();
                        switch ($nivel){
                            case 'u2': 
                                return  $controller->plugin('redirect')->toRoute('auth');
                        }
                    }
    }, 99);
}
=======
    public function initSession($config)
        {
            $sessionConfig = new SessionConfig();
            $sessionConfig->setOptions($config);
            $sessionManager = new SessionManager($sessionConfig);
            $sessionManager->start();
            Container::setDefaultManager($sessionManager);
        }
>>>>>>> origin/master
}
