<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Vaga;

return array(
    'router' => array(
        'routes' => array(
            'vaga' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/vaga',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Vaga\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id][/:idVaga][/:curso]]',
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
            'vagaPresencial' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/vagaPresencial',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Vaga\Controller',
                        'controller'    => 'VagaPresencial',
                        'action'        => 'cadastrarVagaPresencial',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id][/:idVaga][/:curso]]',
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
                          '__NAMESPACE__' => 'Vaga\Controller',
                          'controller'    => 'Index',
                      ),
                  ),
              ),
            'deleteVagaPresencial' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/vagaPresencial/flag/[:action]/[:iddelete][/]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Vaga\Controller',
                          'controller'    => 'VagaPresencial',
                      ),
                  ),
              ),
            'deleteDocumentoPresencial' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/vagaPresencial/flag/[:action]/[:iddelete][/]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Vaga\Controller',
                          'controller'    => 'VagaPresencial',
                      ),
                  ),
              ),
            'select' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/curso/[:action]/[:curso]/[:page]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Vaga\Controller',
                          'controller'    => 'Index',
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
            'Vaga\Controller\Index' => Controller\IndexController::class,
            'Vaga\Controller\VagaPresencial' => Controller\VagaPresencialController::class
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
    		'ViewJsonStrategy'
    	),
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'vaga/index/index' => __DIR__ . '/../view/vaga/index/index.phtml',
            'vaga/index/editar-contratos' => __DIR__ . '/../view/vaga/index/editarContratos.phtml',
            'vaga/vaga-presencial/cadastrarvagapresencial' => __DIR__ . '/../view/vagaPresencial/index/cadastrarVagaPresencial.phtml',       
            'vaga/vaga-presencial/lancarcontratos' => __DIR__ . '/../view/vagaPresencial/index/lancarcontratos.phtml', 
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

