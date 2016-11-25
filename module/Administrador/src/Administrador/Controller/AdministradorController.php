<?php
namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Administrador\Entity\Usuario;

class AdministradorController extends AbstractActionController
{    
    public function dashboardAction(){
          return new ViewModel();
    }    
    public function cadastrarUsuarioAction(){    
        $this->sairAdministradorAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
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
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $listaUsuarios = $em->getRepository("Administrador\Entity\Usuario")->findAll();     
            return new ViewModel([
                'listaUsuarios'=>$listaUsuarios
            ]);
    }
    public function excluirUsuarioAction(){
       $this->sairAdministradorAction();
            $id = $this->params()->fromRoute("deleteUsuario", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $usuario = $em->find("Administrador\Entity\Usuario", $id);
            $em->remove($usuario);
            $em->flush();
          
        return $this->redirect()->toRoute('usuarios');       
    }
    
    public function editarUsuarioAction(){ 
       $this->sairAdministradorAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idusuario = $this->params()->fromRoute("id", 0);
        $listaUsuario = $em->getRepository("Administrador\Entity\Usuario")->findByIdusuario($idusuario);
        $request = $this->getRequest();
          if ($request->isPost()){
                $select = $em->find("Administrador\Entity\Usuario", $idusuario);
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
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
           $listaAlunoPresencial = $em->getRepository("Aluno\Entity\AlunoPresencial")->findAll();
            $listaAlunoEAD = $em->getRepository("Aluno\Entity\Aluno")->findAll();
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
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaAlunoPresencial = $em->getRepository("Aluno\Entity\AlunoPresencial")->findAll();
            $listaAlunoEAD = $em->getRepository("Aluno\Entity\Aluno")->findAll();
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
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $aluno = $em->find("Aluno\Entity\Aluno", $id);
            $em->remove($aluno);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'aluno','id'=>$page]);       
    }
     public function excluirAlunoPresencialAction(){
            $this->sairAdministradorAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAluno", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $aluno = $em->find("Aluno\Entity\AlunoPresencial", $id);
            $em->remove($aluno);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'todosalunospresencial','id'=>$page]);       
    }
    public function editarAlunoAction(){
        $this->sairAdministradorAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idAluno = $this->params()->fromRoute("id", 0);
            $page = $this->params()->fromRoute("page", 0);
            $listaAluno = $em->getRepository("Aluno\Entity\Aluno")->findByIdaluno($idAluno);
            $listaCurso = $em->getRepository("Base\Entity\Dados")->findAll();
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Aluno\Entity\Aluno", $idAluno);
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
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idAluno = $this->params()->fromRoute('id', 0);
            $page = $this->params()->fromRoute('page', 0);
            $listaAluno = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByIdaluno($idAluno);
            $listaCursoPresencial = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Aluno\Entity\AlunoPresencial", $idAluno);
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
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaEmpresa = $em->getRepository("Administrador\Entity\Empresa")->findAll();
            $listaAgente = $em->getRepository("Administrador\Entity\Agente")->findAll();
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
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaEmpresa = $em->getRepository("Administrador\Entity\Empresa")->findAll();
            $listaAgente = $em->getRepository("Administrador\Entity\Agente")->findAll();
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
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idEmpresa = $this->params()->fromRoute("id", 0);
            $listaEmpresa = $em->getRepository("Administrador\Entity\Empresa")->findByIdempresa($idEmpresa);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Administrador\Entity\Empresa", $idEmpresa);
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
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idAgente = $this->params()->fromRoute("id", 0);
            $listaAgente = $em->getRepository("Administrador\Entity\Agente")->findByIdagente($idAgente);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Administrador\Entity\Agente", $idAgente);
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
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $empresa = $em->find("Administrador\Entity\Empresa", $id);
            $em->remove($empresa);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'empresa', 'id'=>$page]);       
    }
    public function excluirAgenteAction(){
            $this->sairAdministradorAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAgente", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $agente = $em->find("Administrador\Entity\Agente", $id);
            $em->remove($agente);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'agente','id'=>$page]);       
    }
     public function documentosPresencialAction(){
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $documentoPendenteTCE = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findBySituacaoAndTipo("Nao","TCE");
        $documentoPendenteTA = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findBySituacaoAndTipo("Nao","TA");
        $documentoPendente = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByEntregue("Nao");
        
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