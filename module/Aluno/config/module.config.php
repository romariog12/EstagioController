<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aluno;

return array(
    'router' => array(
        'routes' => array(
            'aluno' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/aluno',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Aluno\Controller',
                        'controller'    => 'Aluno',
                        'action'        => 'cadastrar',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                
                            ),
                        ),
                    ),
                ),
            ),
                'perfil' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/perfil',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Aluno\Controller',
                        'controller'    => 'Aluno',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id][/:idVaga]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                
                            ),
                        ),
                    ),
                ),
            ),
            'delete' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/vaga/flag/[:action]/[:iddelete][/]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Aluno\Controller',
                          'controller'    => 'Aluno',
                      ),
                  ),
              ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Aluno\Controller\Aluno' => Controller\AlunoController::class,
            
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'aluno/aluno/perfil' => __DIR__ . '/../view/aluno/index/perfil.phtml',
            'aluno/aluno/index' => __DIR__ . '/../view/aluno/index/index.phtml',
            'aluno/aluno/cadastrar' => __DIR__ . '/../view/aluno/index/cadastroAluno.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
           
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
        'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
);

