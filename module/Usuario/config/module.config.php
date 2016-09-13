<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuario;

return array(
    'router' => array(
        'routes' => array(
            'dashboard' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/dashboard',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
                        'controller'    => 'Administrador',
                        'action'        => 'dashboard',
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
            'administrador' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/aluno',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
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
                        '__NAMESPACE__' => 'Usuario\Controller',
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
                        '__NAMESPACE__' => 'Usuario\Controller',
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
                          '__NAMESPACE__' => 'Usuario\Controller',
                          'controller'    => 'Administrador',
                      ),
                  ),
              ),
            'aluno' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/aluno',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
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
                        '__NAMESPACE__' => 'Usuario\Controller',
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
            'excluirAluno' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/aluno/flag/[:action]/[:deleteAluno]/[:page]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Usuario\Controller',
                          'controller'    => 'Administrador',
                      ),
                  ),
              ),
            'delete' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/aluno/flag/[:action]/[:iddelete][/]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Usuario\Controller',
                          'controller'    => 'Aluno',
                      ),
                  ),
              ),
            'empresa' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/listaEmpresa',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
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
                    'route'    => '/empresa',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Usuario\Controller',
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
             'excluirEmpresa' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/administrador/flag/[:action]/[:deleteEmpresa]/[:page][/]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Usuario\Controller',
                          'controller'    => 'Administrador',
                      ),
                  ),
              ),
            'excluirAgente' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/empresa/flag/[:action]/[:deleteAgente]/[:page][/]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Usuario\Controller',
                          'controller'    => 'Administrador',
                      ),
                  ),
              ),
            'paginator' => array(
                  'type'    => 'Segment',
                  'options' => array(
                      'route'    => '/[:controller]/[:action]/[:id]',
                      'defaults' => array(
                          '__NAMESPACE__' => 'Usuario\Controller',
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
            'Usuario\Controller\Administrador' => Controller\AdministradorController::class, 
            'Usuario\Controller\Aluno' => Controller\AlunoController::class,
            'Usuario\Controller\Index' => Controller\AlunoController::class,
            'Usuario\Controller\Empresa' => Controller\EmpresaController::class
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
            'usuario/administrador/dashboard' => __DIR__ . '/../view/administrador/index/dashboard.phtml',
            'usuario/administrador/cadastrar-usuario' => __DIR__ . '/../view/administrador/index/cadastrarUsuario.phtml',
            'usuario/administrador/editar-usuario' => __DIR__ . '/../view/administrador/index/editarUsuario.phtml',
            'usuario/administrador/usuarios' => __DIR__ . '/../view/administrador/index/usuarios.phtml',
            'usuario/administrador/aluno' => __DIR__ . '/../view/administrador/index/aluno.phtml',
            'usuario/administrador/editar-aluno' => __DIR__ . '/../view/administrador/index/editarAluno.phtml',
            'usuario/empresa/cadastrar-empresa' => __DIR__ . '/../view/empresa/index/cadastrarEmpresa.phtml',
            'usuario/empresa/cadastrar-agente' => __DIR__ . '/../view/empresa/index/cadastrarAgente.phtml',
            'usuario/administrador/editar-empresa' => __DIR__ . '/../view/administrador/index/editarEmpresa.phtml',
            'usuario/administrador/editar-agente' => __DIR__ . '/../view/administrador/index/editarAgente.phtml',
            'usuario/administrador/empresa' => __DIR__ . '/../view/administrador/index/empresa.phtml',
            'usuario/administrador/agente' => __DIR__ . '/../view/administrador/index/agente.phtml',
            'usuario/aluno/perfil' => __DIR__ . '/../view/aluno/index/perfil.phtml',
            'usuario/aluno/estagios' => __DIR__ . '/../view/aluno/index/estagios.phtml',  
            'usuario/aluno/buscar-aluno' => __DIR__ . '/../view/aluno/index/buscarAluno.phtml',
            'usuario/aluno/cadastrar' => __DIR__ . '/../view/aluno/index/cadastroAluno.phtml',
            'usuario/aluno/declaracao' => __DIR__ . '/../view/aluno/index/declaracao.phtml',
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

