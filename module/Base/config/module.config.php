<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
return array(
    
     'router' => array(
        'routes' => array( 
             'dados' => array(
                'type'    => Literal::class,
                'options' => array(
                    'route'    => '/dados',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Base\Controller',
                        'controller'    => 'Base',
                        'action'        => 'dados',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => Segment::class,
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
            'dadosPresencial' => array(
                'type'    => Literal::class,
                'options' => array(
                    'route'    => '/dadosPresencial',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Base\Controller',
                        'controller'    => 'BasePresencial',
                        'action'        => 'dados',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => Segment::class,
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
             'deleteDados' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/basePresencial/flag/[:action]/[:idDeleteDados]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Base\Controller',
                          'controller'    => 'BasePresencial',
                      ),
                  ),
              ),
            'orientacaoPresencial' => array(
                'type'    => Literal::class,
                'options' => array(
                    'route'    => '/orientacaoPresencial',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Base\Controller',
                        'controller'    => 'BasePresencial',
                        'action'        => 'orientacao',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => Segment::class,
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
        'locale' => 'pt_BR',
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
            'Base\Controller\Base' => Controller\BaseController::class,
            'Base\Controller\BasePresencial' => Controller\BasePresencialController::class
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'base/base/dados'           => __DIR__ . '/../view/base/dados.phtml',
            'base/base-presencial/dados'           => __DIR__ . '/../view/basePresencial/dadosPresencial.phtml',
            'base/base-presencial/orientacao'           => __DIR__ . '/../view/basePresencial/orientacaoPresencial.phtml',
            'base/index/respostaCadastro'           => __DIR__ . '/../view/base/respostaCadastro.phtml',
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'base/layout/nav-bar'           => __DIR__ . '/../view/layout/navBar.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
         'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'tabela' => 'Base\View\Helper\tabela',
            'painelTitulo' => 'Base\View\Helper\painelTitulo',
            'painel' => 'Base\View\Helper\painel',
            'painelFim' => 'Base\View\Helper\painelFim',
            'paginacao' => 'Base\View\Helper\paginacao',
            'botaoGrande' => 'Base\View\Helper\botaoGrande',
            'tabelaEstagios' => 'Base\View\Helper\tabelaEstagios',
            'cursos' => 'Base\View\Helper\cursos',
            'agentes' => 'Base\View\Helper\agentes',
            'empresas' => 'Base\View\Helper\empresas',
            'alertaDanger' => 'Base\View\Helper\alertaDanger',
            'alertaSuccess' => 'Base\View\Helper\alertaSuccess',
            'tabelaAlunoEmEstagio' => 'Base\View\Helper\tabelaAlunoEmEstagio',
            'tabelaAlunos' => 'Base\View\Helper\tabelaAlunos'
            
      )
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

