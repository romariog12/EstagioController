<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Relatorio;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;

return array(
    'router' => array(
        'routes' => array(
              'relatorioPresencial' => array(
                'type'    => Literal::class,
                'options' => array(
                    'route'    => '/relatorio',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Relatorio\Controller',
                        'controller'    => 'RelatorioPresencial',
                        'action'        => 'relatorio',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => Segment::class,
                        'options' => array(
                            'route'    => '/[:controller[/:action]/[:curso]/[:curso1]/[:aba]/[:page]]',
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
            'relatorioPresencialEstatisticas' => array(
                'type'    => Literal::class,
                'options' => array(
                    'route'    => '/relatorioPresencialEstatisticas',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Relatorio\Controller',
                        'controller'    => 'RelatorioPresencial',
                        'action'        => 'relatorioGrafico',
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
             'infoPresencial' => array(
                  'type'    => Segment::class,
                  'options' => array(
                      'route'    => '/curso/[:action]/[:curso]/[:page]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Relatorio\Controller',
                          'controller'    => 'RelatorioPresencial',
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
            
            'Relatorio\Controller\RelatorioPresencial' => Controller\RelatorioPresencialController::class,
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            //templetes
            'relatorio/relatorio-presencial/relatorio' => __DIR__ . '/../view/relatorioPresencial/index/relatorio.phtml',
            'relatorio/relatorio-presencial/infopresencial'=> __DIR__ . '/../view/relatorioPresencial/index/infoPresencial.phtml',
            'relatorio/relatorio-presencial/infopresencialestagiando'=> __DIR__ . '/../view/relatorioPresencial/index/infoPresencialEstagiando.phtml',
            'relatorio/relatorio-presencial/infopresencialencerrado'=> __DIR__ . '/../view/relatorioPresencial/index/infoPresencialEncerrado.phtml',
            'relatorio/relatorio-presencial/infopresencialalunoscadastrados'=> __DIR__ . '/../view/relatorioPresencial/index/infoPresencialAlunosCadastrados.phtml',
            'relatorio/relatorio-presencial/relatorio-grafico' => __DIR__ . '/../view/relatorioPresencial/index/relatorioGrafico.phtml',
            'relatorio/relatorio-presencial/infoestatisticas'=> __DIR__ . '/../view/relatorioPresencial/index/infoEstatisticas.phtml',
         
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'view_helpers' => [
    'invokables' =>
        [
            'tabelaRelatorio' => 'Relatorio\View\Helper\tabelaRelatorio'
            ]
    ],
    
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

