<?php
namespace Auth;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
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
    public function init(ModuleManager $manager)
{
    // Obtemos o gerenciador de eventos
    $events = $manager->getEventManager();
    
    // Para obter os eventos compartilhados
    $sharedEvents = $events->getSharedManager();
    
    // Para definir o que precisamos disparar
    // Utilizamos da variavel \Zend\Mvc\MvcEvent $e 
    $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {

        // Quando o controlador for encontrado pelo ActionController
        $controller = $e->getTarget();
       
        // Podemos definir o laytout diretamente para qualquer 
        // que seja o primeiro controller encontrado
        $controller->layout('Auth/layout/layout');
    }, 100);
}
}
