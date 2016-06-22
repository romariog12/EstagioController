<?php
namespace Perfil;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Aluno\Entity\AlunoTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Aluno\Entity\Aluno;



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
    
    public function getServiceConfig()
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
                'Params'=>  function ($sm) {
                    $params = $sm->get('params');
                    return $params;
                     
                }       
            )
        );
    }
}
