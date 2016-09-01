<?php

return array(
    'modules' => array(
        'Auth',
        'Usuario',
        'Home',
        'Vaga',
        'Relatorio',
        'Base',
        'DoctrineModule',
        'DoctrineORMModule'
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ),
    ),
    
);
