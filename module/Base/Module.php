<?php
namespace Base;
use Zend\ModuleManager\ModuleManager;
class Module
{
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
    public function init(ModuleManager $manager){
    $events = $manager->getEventManager();
    $sharedEvents = $events->getSharedManager();
    $sharedEvents->attach(__NAMESPACE__ , 'dispatch', function($ev) {
                    $controller = $ev->getTarget();
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
}
