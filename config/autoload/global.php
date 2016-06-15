<?php
return [
    'service_manager' => [
    'db' => ['driver_options' => [
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ],
        ],
    'factories' => array(
         'Zend\Db\Adapter\Adapter' => function ($serviceManager) {
            $adapterFactory = new Zend\Db\Adapter\AdapterServiceFactory();
               $adapter = $adapterFactory->createService($serviceManager);

               \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);

               return $adapter;
         }
      ),
],  
];
