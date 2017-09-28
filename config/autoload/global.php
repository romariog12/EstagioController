<?php

return [
    
    'service_manager' => [
        'db' => ['driver_options' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ],
        ],
        'factories' => [
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'Zend\Authentication\AuthenticationService' => Auth\Model\Factory\AuthenticationFactory::class,
    
           ],
    ],
    'doctrine' => ['connection' => [
        'orm_default' => [
        'driverClass' => Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'params' => [
                    'host' => 'mysql.hostinger.com.br',
                    'port' => '3306',
                    'user' => 'u430986180_ucb',
                    'password' => '91726418',
                    'dbname' => 'u430986180_ucb',
                   ]
]
]
],
   
];
