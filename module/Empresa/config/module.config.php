<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Empresa;

return array(
    'router' => array(
        'routes' => array(
                'painelEmpresa' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/painelEmpresa',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Empresa\Controller',
                        'controller'    => 'Empresa',
                        'action'        => 'painelEmpresa',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id]]',
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
            'empresaAjax' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/painelEmpresa/[:action]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Empresa\Controller',
                          'controller'    => 'Empresa',
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
        'locale' => 'pt-br',
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
            'Empresa\Controller\Empresa' => Controller\EmpresaController::class
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'emrpesa/index/index' => __DIR__ . '/../view/empresa/index/empresa.phtml',
            'empresa/empresa/cadastrar-empresa' => __DIR__ . '/../view/empresa/index/cadastrarEmpresa.phtml',
            'empresa/empresa/painel-empresa' => __DIR__ . '/../view/empresa/index/painelEmpresa.phtml',
            'empresa/empresa/painel-empresa-estagiando' => __DIR__ . '/../view/empresa/index/painelEmpresaEstagiando.phtml',
            'empresa/empresa/painel-empresa-encerrado' => __DIR__ . '/../view/empresa/index/painelEmpresaEncerrado.phtml',
            'empresa/empresa/editar-empresa' => __DIR__ . '/../view/empresa/index/editarEmpresa.phtml',
            'empresa/empresa/painel-empresa-contratos-vencendo' => __DIR__ . '/../view/empresa/index/painelEmpresaContratosVencendo.phtml',
            'empresa/empresa/mensagens' => __DIR__ . '/../view/empresa/index/mensagens.phtml',
            'empresa/empresa/processo' => __DIR__ . '/../view/empresa/index/processo.phtml',
            'Empresa/layout/layout'           => __DIR__ . '/../view/layout/layout.phtml'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
         'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
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

