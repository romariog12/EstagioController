<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administrador;

return array(
    'router' => array(
        'routes' => array(
          
            'administrador' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/aluno',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'aluno',
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
                        'controller'    => 'Aluno',
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
              'perfilPresencial' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/perfilPresencial',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'AlunoPresencial',
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
                        'controller'    => 'Empresa',
                        'action'        => 'perfilEmpresa',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action][/:id/][/:idVaga]]',
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
                    'route'    => '/listaEmpresa',
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
            'cadastrarEmpresa' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/cadastrarEmpresa',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Empresa',
                        'action'        => 'cadastrarEmpresa',
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
            'buscarEmpresa' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/buscarEmpresa',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Administrador\Controller',
                        'controller'    => 'Empresa',
                        'action'        => 'buscarEmpresa',
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
             'excluirEmpresa' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/administrador/flag/[:action]/[:deleteEmpresa]/[:page][/]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Administrador\Controller',
                          'controller'    => 'Administrador',
                      ),
                  ),
              ),
            'excluirAgente' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/empresa/flag/[:action]/[:deleteAgente]/[:page][/]',
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
        'locale' => 'pr-BR',
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
            'Administrador\Controller\Administrador' => Controller\AdministradorController::class, 
            'Administrador\Controller\Aluno' => Controller\AlunoController::class,
            'Administrador\Controller\AlunoPresencial' => Controller\AlunoPresencialController::class,
            'Administrador\Controller\Index' => Controller\AlunoController::class,
            'Administrador\Controller\Empresa' => Controller\EmpresaController::class,
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
            'administrador/administrador/dashboard' => __DIR__ . '/../view/administrador/index/dashboard.phtml',
            'administrador/administrador/cadastrar-usuario' => __DIR__ . '/../view/administrador/index/cadastrarUsuario.phtml',
            'administrador/administrador/editar-usuario' => __DIR__ . '/../view/administrador/index/editarUsuario.phtml',
            'administrador/administrador/usuarios' => __DIR__ . '/../view/administrador/index/usuarios.phtml',
            'administrador/administrador/aluno' => __DIR__ . '/../view/administrador/index/aluno.phtml',
            'administrador/administrador/todosalunospresencial' => __DIR__ . '/../view/administrador/index/todosAlunosPresencial.phtml',
            'administrador/administrador/editar-aluno' => __DIR__ . '/../view/administrador/index/editarAluno.phtml',
            'administrador/administrador/editar-aluno-presencial' => __DIR__ . '/../view/administrador/index/editarAlunoPresencial.phtml',
            'administrador/empresa/cadastrar-empresa' => __DIR__ . '/../view/empresa/index/cadastrarEmpresa.phtml',
            'administrador/empresa/cadastrar-agente' => __DIR__ . '/../view/empresa/index/cadastrarAgente.phtml',
            'administrador/empresa/buscar-empresa' => __DIR__ . '/../view/empresa/index/buscarEmpresa.phtml',
            'administrador/empresa/perfilempresa' => __DIR__ . '/../view/empresa/index/perfilEmpresa.phtml',
            'administrador/empresa/perfilempresaestagiando' => __DIR__ . '/../view/empresa/index/perfilEmpresaEstagiando.phtml',
            'administrador/empresa/perfilempresaencerrado' => __DIR__ . '/../view/empresa/index/perfilEmpresaEncerrado.phtml',
            'administrador/administrador/editar-empresa' => __DIR__ . '/../view/administrador/index/editarEmpresa.phtml',
            'administrador/administrador/editar-agente' => __DIR__ . '/../view/administrador/index/editarAgente.phtml',
            'administrador/administrador/empresa' => __DIR__ . '/../view/administrador/index/empresa.phtml',
            'administrador/administrador/mensagem' => __DIR__ . '/../view/administrador/index/mensagem.phtml',
            'administrador/administrador/agente' => __DIR__ . '/../view/administrador/index/agente.phtml',
             'administrador/administrador/documentos-presencial' => __DIR__ . '/../view/administrador/index/documentosPresencial.phtml',
             'administrador/administrador/documentos-presencial-pendente' => __DIR__ . '/../view/administrador/index/documentosPresencialPendente.phtml',
            'administrador/aluno/perfil' => __DIR__ . '/../view/aluno/index/perfil.phtml',
            'administrador/aluno/estagios' => __DIR__ . '/../view/aluno/index/estagios.phtml',  
            'administrador/aluno/buscar-aluno' => __DIR__ . '/../view/aluno/index/buscarAluno.phtml',
            'administrador/aluno/cadastrar' => __DIR__ . '/../view/aluno/index/cadastroAluno.phtml',
            'administrador/aluno/declaracao' => __DIR__ . '/../view/aluno/index/declaracao.phtml',
            'administrador/aluno-presencial/perfil' => __DIR__ . '/../view/alunoPresencial/index/perfilPresencial.phtml',
            
            'administrador/aluno-presencial/estagios' => __DIR__ . '/../view/alunoPresencial/index/estagiosPresencial.phtml',  
            'administrador/aluno-presencial/buscar-aluno' => __DIR__ . '/../view/alunoPresencial/index/buscarAlunoPresencial.phtml',
            'administrador/aluno-presencial/cadastrar' => __DIR__ . '/../view/alunoPresencial/index/cadastroAlunoPresencial.phtml',
            'administrador/aluno-presencial/declaracao-presencial' => __DIR__ . '/../view/alunoPresencial/index/declaracaoPresencial.phtml',
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

