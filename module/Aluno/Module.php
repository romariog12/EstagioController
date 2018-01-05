<?php
namespace Aluno;


use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
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
    
   
    /*public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'AlunoTable' =>  function($sm) {
                    $tableGateway = $sm->get('AlunoTableGateway');
                    $table = new AlunoTable($tableGateway);
                    return $table;
                },
                'AlunoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Aluno());
                    return new TableGateway('Aluno', $dbAdapter, null, $resultSetPrototype);
                },
                
                        
                    'Aluno'=>  function ($sm) {
                    $aluno = $sm->get('Aluno\Enity\Aluno');
                    return $aluno;
                    
                }       
            )
        );
    }*/
}
