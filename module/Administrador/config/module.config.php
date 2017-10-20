<?php
/**
 * Zend Framework (http://framework.zend.com/)
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administrador;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
return ['router' => 
    ['routes' =>
        ['administrador' => 
            ['type'    => 'Literal',
                'options' => 
                ['route'    => '/aluno',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'aluno',
                    ),
                   ],
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id][/:page]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                
                            ),
                        ),
                    ),
                ),
               ],
            'cadastrarUsuario' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/cadastrarUsuario',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'cadastrarUsuario',
                    ),
                ),
                'may_terminate' => true,
         ),
            'usuarios' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/usuarios',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'Usuarios',
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
            'excluirUsuario' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/administrador/flag/[:action]/[:deleteUsuario]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Administrador\Controller',
                          'controller'    => 'Administrador',
                      ),
                  ),
              ),
            'aluno' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/aluno',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Aluno',
                        'action'        => 'aluno',
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
            'perfil' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/perfil',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'buscarAluno',
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
              'perfilAluno' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/perfilAluno',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'administrador',
                        'action'        => 'buscarAluno',
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
            'perfilEmpresa' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/perfilEmpresa',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'buscarEmpresa',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id/][/:page]]',
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
            'documentos' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/documentos',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'documentosPresencial',
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
            'empresaMensagem' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/email',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'mensagem',
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
            'excluirAluno' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/aluno/flag/[:action]/[:deleteAluno]/[:page]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Administrador\Controller',
                          'controller'    => 'Administrador',
                      ),
                  ),
              ),
            'delete' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/aluno/flag/[:action]/[:iddelete][/]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Administrador\Controller',
                          'controller'    => 'Aluno',
                      ),
                  ),
              ),
            'empresa' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/empresa',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'empresa',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id][/:page]]',
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
              'editarEmpresa' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/empresa',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'editarEmpresa',
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
             'excluir' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/administrador/flag/[:action]/[:id]/[:page][/]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Administrador\Controller',
                          'controller'    => 'Administrador',
                      ),
                  ),
              ),
            'paginator' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/[:controller]/[:action]/[:id]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Administrador\Controller',
                          'controller'    => 'Administrador',
                      ),
                  ),
              ),
           
             ],       
       ],
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
        'locale' => 'pt-BR',
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
            'Administrador\Controller\Administrador' => Controller\AdministradorController::class
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'administrador/administrador/dashboard' => __DIR__ . '/../view/administrador/index/dashboard.phtml',
            'administrador/administrador/cadastrar-usuario' => __DIR__ . '/../view/administrador/index/cadastrarUsuario.phtml',
            'administrador/administrador/editar-usuario' => __DIR__ . '/../view/administrador/index/editarUsuario.phtml',
            'administrador/administrador/usuarios' => __DIR__ . '/../view/administrador/index/usuarios.phtml',
            'administrador/administrador/aluno' => __DIR__ . '/../view/administrador/index/aluno.phtml',
            'administrador/administrador/todos-alunos' => __DIR__ . '/../view/administrador/index/todosAlunos.phtml',
            'administrador/administrador/editar-aluno' => __DIR__ . '/../view/administrador/index/editarAluno.phtml',
            'administrador/administrador/cadastrar-empresa' => __DIR__ . '/../view/administrador/index/cadastrarEmpresa.phtml',
            'administrador/administrador/cadastrar-agente' => __DIR__ . '/../view/administrador/index/cadastrarAgente.phtml',
            'administrador/administrador/buscar-empresa' => __DIR__ . '/../view/administrador/index/buscarEmpresa.phtml',
            'administrador/administrador/perfil-empresa' => __DIR__ . '/../view/administrador/index/perfilEmpresa.phtml',
            'administrador/empresa/perfilempresaestagiando' => __DIR__ . '/../view/empresa/index/perfilEmpresaEstagiando.phtml',
            'administrador/empresa/perfilempresaencerrado' => __DIR__ . '/../view/empresa/index/perfilEmpresaEncerrado.phtml',
            'administrador/administrador/editar-empresa' => __DIR__ . '/../view/administrador/index/editarEmpresa.phtml',
            'administrador/administrador/editar-agente' => __DIR__ . '/../view/administrador/index/editarAgente.phtml',
            'administrador/administrador/empresa' => __DIR__ . '/../view/administrador/index/empresa.phtml',
            'administrador/administrador/mensagem' => __DIR__ . '/../view/administrador/index/mensagem.phtml',
            'administrador/administrador/agente' => __DIR__ . '/../view/administrador/index/agente.phtml',
            'administrador/administrador/documentos-presencial' => __DIR__ . '/../view/administrador/index/documentosPresencial.phtml',
            'administrador/administrador/documentos-presencial-pendente' => __DIR__ . '/../view/administrador/index/documentosPresencialPendente.phtml', 
            'administrador/aluno/buscar-aluno' => __DIR__ . '/../view/aluno/index/buscarAluno.phtml',
            'administrador/administrador/cadastrar-aluno' => __DIR__ . '/../view/administrador/index/cadastrarAluno.phtml',
            'administrador/administrador/perfil-aluno' => __DIR__ . '/../view/administrador/index/perfilAluno.phtml',
            'administrador/administrador/buscar-aluno' => __DIR__ . '/../view/administrador/index/buscarAluno.phtml',
            'administrador/administardor/cadastrar' => __DIR__ . '/../view/administrador/index/cadastrarAluno.phtml',
            'administrador/aluno-presencial/declaracao-presencial' => __DIR__ . '/../view/alunoPresencial/index/declaracaoPresencial.phtml',
            
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => [
        'invokables' =>
            [
                'tabelaTodosAlunos' => 'Administrador\View\Helper\tabelaTodosAlunos',
                'tabelaEmpresas' => 'Administrador\View\Helper\tabelaEmpresas',
                'tabelaAgentes' => 'Administrador\View\Helper\tabelaAgentes',
                'tabelaDocumentos' => 'Administrador\View\Helper\tabelaDocumentos',
                'tabelaUsuarios' => 'Administrador\View\Helper\tabelaUsuarios',
                'tabelaBuscarAluno' => 'Administrador\View\Helper\tabelaBuscarAluno',
                'tabelaBuscarEmpresa' => 'Administrador\View\Helper\tabelaBuscarEmpresa'
                ]
        ],
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
    ];

