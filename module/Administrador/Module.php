<?php
namespace Administrador;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
use Base\View\Helper\Constantes;

class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    { 
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager); 
        
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
   public function init(ModuleManager $manager){
    $events = $manager->getEventManager();
    $sharedEvents = $events->getSharedManager();
    $sharedEvents->attach(__NAMESPACE__ , 'dispatch', function($ev) {
                    $controller = $ev->getTarget();
                    $controller ->layout('administrador/layout/layout');
                    $auth = $ev->getApplication()->getServiceManager()->get('Zend\Authentication\AuthenticationService');
                    if(empty($auth->hasIdentity())){ 
                    return $controller->plugin('redirect')->toRoute('auth');
                    }
                    foreach ($auth->getIdentity()as $l){
                        $nivel = $l[0]->getNivel();
                        switch ($nivel){
                            case Constantes::codigoEmpresa: 
                                return  $controller->plugin('redirect')->toRoute('authEmpresa');
                        }
                    }
    }, 99);
}
     
}
