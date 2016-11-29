<?php
namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Model\Entity;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Administrador\Entity\Usuario;

class AdministradorController extends AbstractActionController
{   
    
    public function cadastrarUsuarioAction(){    
        $this->sairAdministradorAction();
        $em = $this->getServiceLocator()->get(Entity::em);
        $request = $this->getRequest();
        if($request->isPost()){
            $nome = $request->getPost("nome");
            $login = $request->getPost("login");
            $senha = $request->getPost("senha");
            $matricula = $request->getPost("matricula");
            $cargo = $request->getPost("cargo");
            $nivel = $request->getPost("nivel");
                $administrador = new Usuario();
                $administrador->setNome($nome);
                $administrador->setLogin($login);
                $administrador->setSenha($senha);
                $administrador->setMatricula($matricula);
                $administrador->setCargo($cargo);
                $administrador->setNivel($nivel);
                    try {

                    $em->persist($administrador);
                    $em->flush();

                    } catch (Exception $ex) {

                    } 
                    $this->redirect()->toUrl('usuarios');
        }
          
          return new ViewModel([
            
          ]);
      } 
    public function usuariosAction(){
        $this->sairAdministradorAction();
        $em = $this->getServiceLocator()->get(Entity::em);
        $listaUsuarios = $em->getRepository(Entity::usuario)->findAll();     
            return new ViewModel([
                'listaUsuarios'=>$listaUsuarios
            ]);
    }
    public function excluirUsuarioAction(){
       $this->sairAdministradorAction();
            $id = $this->params()->fromRoute("deleteUsuario", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $usuario = $em->find(Entity::usuario, $id);
            $em->remove($usuario);
            $em->flush();
          
        return $this->redirect()->toRoute('usuarios');       
    }
    
    public function editarUsuarioAction(){ 
       $this->sairAdministradorAction();
        $em = $this->getServiceLocator()->get(Entity::em);
        $idusuario = $this->params()->fromRoute("id", 0);
        $listaUsuario = $em->getRepository(Entity::usuario)->findByIdusuario($idusuario);
        $request = $this->getRequest();
          if ($request->isPost()){
                $select = $em->find(Entity::usuario, $idusuario);
                    $nome = $request->getPost("nome");
                    $login = $request->getPost("login");
                    $matricula = $request->getPost("matricula");
                    $cargo = $request->getPost("cargo");
                    $nivel = $request->getPost("nivel");     
                    try { 
                        $select ->setNome($nome);
                        $select->setLogin($login); 
                        $select->setMatricula($matricula);
                        $select->setCargo($cargo);
                        $select->setNivel($nivel);
                        $em->persist($select);
                        $em->flush();

                    } catch (Exception $ex) {}
                return $this->redirect()->toRoute('usuarios');                 
        }      
        return new ViewModel([
            'listaUsuario' =>$listaUsuario
        ]);
    }
     public function alunoAction(){
        $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get(Entity::em);
           $listaAlunoPresencial = $em->getRepository(Entity::alunoPresencial)->findAll();
            $listaAlunoEAD = $em->getRepository(Entity::alunoEad)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAlunoEAD));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
             
        return new ViewModel([
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaAlunoPresencial'=>$listaAlunoPresencial,
                    'listaAlunoEAD'=> $listaAlunoEAD
            ]);
        }
        public function todosAlunosPresencialAction(){
        $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaAlunoPresencial = $em->getRepository(Entity::alunoPresencial)->findAll();
            $listaAlunoEAD = $em->getRepository(Entity::alunoEad)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAlunoPresencial));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
             
        return new ViewModel([
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaAlunoPresencial'=>$listaAlunoPresencial,
                    'listaAlunoEAD'=> $listaAlunoEAD
            ]);
        }
        
    public function excluirAlunoAction(){
            $this->sairAdministradorAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAluno", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $aluno = $em->find(Entity::alunoEad, $id);
            $em->remove($aluno);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'aluno','id'=>$page]);       
    }
     public function excluirAlunoPresencialAction(){
            $this->sairAdministradorAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAluno", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $aluno = $em->find(Entity::alunoPresencial, $id);
            $em->remove($aluno);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'todosalunospresencial','id'=>$page]);       
    }
    public function editarAlunoAction(){
        $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get(Entity::em);
            $idAluno = $this->params()->fromRoute("id", 0);
            $page = $this->params()->fromRoute("page", 0);
            $listaAluno = $em->getRepository(Entity::alunoEad)->findByIdaluno($idAluno);
            $listaCurso = $em->getRepository(Entity::dadosEad)->findAll();
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find(Entity::alunoEad, $idAluno);
                $nome = $request->getPost("nome");
                $matricula = $request->getPost("matricula");
                $curso = $request->getPost("curso");
                $email = $request->getPost("email");
                $telefone = $request->getPost("telefone");
                $cpf = $request->getPost("cpf");
                    
                
                try{
                   $select->setNome($nome);
                    $select->setMatricula($matricula);
                    $select->setCurso($curso);
                    $select->setEmail($email);
                    $select->setTelefone($telefone);
                    $select->setCpf($cpf);
                    $em->persist($select);
                    $em->flush();     
                } catch (Exception $ex) {

                }
                
               
            }
            
            return new ViewModel([              
                    'listaAluno' => $listaAluno,
                     'listaCurso'=>$listaCurso,
                'page'=>$page
            ]);
        }
          public function editarAlunoPresencialAction(){
        $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get(Entity::em);
            $idAluno = $this->params()->fromRoute('id', 0);
            $page = $this->params()->fromRoute('page', 0);
            $listaAluno = $em->getRepository(Entity::alunoPresencial)->findByIdaluno($idAluno);
            $listaCursoPresencial = $em->getRepository(Entity::dadosPresencial)->findAll();
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find(Entity::alunoPresencial, $idAluno);
                $nome = $request->getPost("nome");
                $matricula = $request->getPost("matricula");
                $curso = $request->getPost("curso");
                $email = $request->getPost("email");
                $telefone = $request->getPost("telefone");
                 $cpf = $request->getPost("cpf");
                    
                
                try{
                   $select->setNome($nome);
                    $select->setMatricula($matricula);
                    $select->setCurso($curso);
                    $select->setEmail($email);
                    $select->setTelefone($telefone);
                     $select->setCpf($cpf);
                    $em->persist($select);
                    $em->flush();     
                } catch (Exception $ex) {

                }
                if($page>0){
                     return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'todosalunospresencial','id'=>$idAluno, 'page'=>$page]);
                }else{
                     return $this->redirect()->toRoute('perfil/default', 
                          array('controller' => 'alunoPresencial', 'action' => 'perfil', 'id'=>$idAluno,));
               
                }
       
            }
            
            return new ViewModel([              
                    'listaAluno' => $listaAluno,
                'listaCursoPresencial'=>$listaCursoPresencial,
                'page'=>$page
            ]);
        }
    public function empresaAction(){
            $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaEmpresa = $em->getRepository(Entity::empresa)->findAll();
            $listaAgente = $em->getRepository(Entity::agente)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaEmpresa));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
            
            
            return new ViewModel([
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaEmpresa'=>$listaEmpresa,
                    'listaAgente'=>$listaAgente
            ]);
        }
          public function agenteAction(){
            $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaEmpresa = $em->getRepository(Entity::empresa)->findAll();
            $listaAgente = $em->getRepository(Entity::agente)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAgente));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
            
            
            return new ViewModel([
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaEmpresa'=>$listaEmpresa
                    ,'listaAgente'=>$listaAgente
            ]);
        }    
        public function editarEmpresaAction(){
            $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get(Entity::em);
            $idEmpresa = $this->params()->fromRoute("id", 0);
            $listaEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idEmpresa);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find(Entity::empresa, $idEmpresa);
                $empresa = $request->getPost("empresa");
                $cnpj = $request->getPost("cnpj");
                $telefone = $request->getPost("telefone");
                $endereco = $request->getPost("endereco");
                $responsavel = $request->getPost("responsavel");
                $email = $request->getPost("email");
        
                try{
                   $select->setEmpresa($empresa);
                    $select->setCnpj($cnpj);
                    $select->setTelefone($telefone);
                    $select->setEndereco($endereco);
                    $select->setResponsavel($responsavel);
                    $select->setEmail($email);
                    $em->persist($select);
                    $em->flush();     
                } catch (Exception $ex) {

                }    
            }
            
            return new ViewModel([
                   
                    'listaEmpresa' => $listaEmpresa
            ]);
        }
         public function editarAgenteAction(){
            $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get(Entity::em);
            $idAgente = $this->params()->fromRoute("id", 0);
            $listaAgente = $em->getRepository(Entity::agente)->findByIdagente($idAgente);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find(Entity::agente, $idAgente);
                $agente = $request->getPost("agente");
                $cnpj = $request->getPost("cnpj");
                $telefone = $request->getPost("telefone");
                $endereco = $request->getPost("endereco");
                $responsavel = $request->getPost("responsavel");
                $email = $request->getPost("email");
                
                try{
                   $select->setAgente($agente);
                    $select->setCnpj($cnpj);
                    $select->setTelefone($telefone);
                    $select->setEndereco($endereco);
                    $select->setResponsavel($responsavel);
                    $select->setEmail($email);
                    $em->persist($select);
                    $em->flush();     
                } catch (Exception $ex) {

                }     
            } 
            return new ViewModel([
                   
                    'listaAgente' => $listaAgente
            ]);
        }         
        public function excluirEmpresaAction(){
            $this->sairAdministradorAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteEmpresa", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $empresa = $em->find(Entity::empresa, $id);
            $em->remove($empresa);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'empresa', 'id'=>$page]);       
    }
    public function excluirAgenteAction(){
            $this->sairAdministradorAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAgente", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $agente = $em->find(Entity::agente, $id);
            $em->remove($agente);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'agente','id'=>$page]);       
    }
     public function documentosPresencialAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $documentoPendenteTCE = $em->getRepository(Entity::documentoPresencial)->findBySituacaoAndTipo("Nao","TCE");
        $documentoPendenteTA = $em->getRepository(Entity::documentoPresencial)->findBySituacaoAndTipo("Nao","TA");
        $documentoPendente = $em->getRepository(Entity::documentoPresencial)->findByEntregue("Nao");
        
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($documentoPendente));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
        
        return new ViewModel(
                [
                    'documentoPendente' => $documentoPendente,
                    'documentoPendenteTCE' => $documentoPendenteTCE,
                    'documentoPendenteTA' => $documentoPendenteTA,
                    
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                ]
                );
    }
 
}