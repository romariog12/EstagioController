<?php
namespace Instituicao;
use Base\Model\Constantes;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
/**
 *
 * @author Romario Macedo Portela <romariomacedo18@gmail.com>
 */
class Module {
     public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
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
    public function init(ModuleManager $manager){
    $events = $manager->getEventManager();
    $sharedEvents = $events->getSharedManager();
    $sharedEvents->attach(__NAMESPACE__ , 'dispatch', function($ev) {
                    $controller = $ev->getTarget();
                    $auth = $ev->getApplication()->getServiceManager()->get(Constantes::AuthenticationService);
                    if(empty($auth->hasIdentity())){ 
                    return $controller->plugin('redirect')->toRoute('auth');
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
