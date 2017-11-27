<?php
namespace Instituicao;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;
return [
    'router'=>[
        'routes'=>[
            'instituicao'=>[
                'type'=>  Literal::class,
                'options'=> [
                    'route'=> '/',
                    'defaults'=>[
                        '__NAMESPACE__'=> 'Instituicao\Controller',
                        'controller'=>'Instituicao',
                        'action'=>'home'
                    ]
                ],
                'my_terminate'=>true,
                'child_routes'=>[
                    'default'=>[
                        'type'=>  Segment::class,
                        'options'=>[
                            'route'=>'/[:controller[/:action]]',
                            'constraints'=>[
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'service_manager'=>[
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
           ],
        'factories' => [
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            ],
    ],
    'translator'=>[
        'locale' => 'pt-br',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'controllers'=>[
        'invokables' => [
            'Instituicao\Controller\Instituicao' => Controller\InstituicaoController::class,
        ],
    ],
    'view_manager'=>[
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'=>[
            'instituicao/instituicao/home' => __DIR__ . '/../view/instituicao/home.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        
    ],
    'view_helpers'=>[
        
    ],
    'console'=>[
        'router'=>[
            'reoutes'=>[]
        ]
    ],
    'doctrine'=>[
        'driver' => [
            __NAMESPACE__ . '_driver' =>[
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ]
];
