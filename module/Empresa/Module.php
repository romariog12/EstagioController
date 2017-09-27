<?php
namespace Empresa;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
<<<<<<< HEAD
use Zend\ModuleManager\ModuleManager;
use Zend\Session\Container;
use Zend\Session\SessionManager;
use Zend\Session\Config\SessionConfig;

=======
>>>>>>> origin/master
class Module
{
     public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
     public function onBootstrap(MvcEvent $e)
<<<<<<< HEAD
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
         $this->initSession(array(
            'remember_me_seconds' => 2,
            'use_cookies' => true,
            'cookie_httponly' => true,
        ));
    }
=======
    { 
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager); 
        
    }
   
>>>>>>> origin/master

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
    public function initSession($config)
        {
            $sessionConfig = new SessionConfig();
            $sessionConfig->setOptions($config);
            $sessionManager = new SessionManager($sessionConfig);
            $sessionManager->start();
            Container::setDefaultManager($sessionManager);
        }
    public function initAuthenticate(ModuleManager $manager){
    $events = $manager->getEventManager();
    $sharedEvents = $events->getSharedManager();
    $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($ev) {
        $controller = $ev->getTarget();
        $controller->layout('Empresa/layout/layout');
        $auth = $ev->getApplication()->getServiceManager()->get('Zend\Authentication\AuthenticationService');
                    if(empty($auth->hasIdentity())){ 
                     return $controller->plugin('redirect')->toRoute('authEmpresa');
                    }
                    foreach ($auth->getIdentity()as $l){
                        $nivel = $l[0]->getNivel();
                        if($nivel == '1'){
                            return  $controller->plugin('redirect')->toRoute('authEmpresa');
                        }
                    }  
    }, 100);
}
}