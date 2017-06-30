<?php

return [
    'service_manager' => [
        'db' => ['driver_options' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ],
        ],
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Zend\Authentication\AuthenticationService' => 'Auth\Model\Factory\AuthenticationFactory',
          
            
            
        ),
        
        
    ],
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'mysql.hostinger.com.br',
                    'port' => '3306',
                    'user' => 'u430986180_ucb',
                    'password' => '91726418',
                    'dbname' => 'u430986180_ucb',
                )
            )
        )
    ),
  
];
