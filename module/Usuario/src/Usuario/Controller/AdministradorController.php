<?php
namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Usuario\Entity\Administrador;

class AdministradorController extends AbstractActionController
{    
    public function dashboardAction(){
          return new ViewModel();
    }    
    public function cadastrarUsuarioAction(){
        $this->sairAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $request = $this->getRequest();
        if($request->isPost()){
            $nome = $request->getPost("nome");
            $login = $request->getPost("login");
            $senha = $request->getPost("senha");
            $matricula = $request->getPost("matricula");
            $cargo = $request->getPost("cargo");
            $nivel = $request->getPost("nivel");
                $administrador = new Administrador();
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
          
          return new ViewModel();
      } 
    public function usuariosAction(){
        $this->sairAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $listaUsuarios = $em->getRepository("Usuario\Entity\Administrador")->findAll();     
            return new ViewModel([
                'listaUsuarios'=>$listaUsuarios
            ]);
    }
    public function excluirUsuarioAction(){
            $id = $this->params()->fromRoute("deleteUsuario", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $usuario = $em->find("Usuario\Entity\Administrador", $id);
            $em->remove($usuario);
            $em->flush();
          
        return $this->redirect()->toRoute('usuarios');       
    }
    
    public function editarUsuarioAction(){ 
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idusuario = $this->params()->fromRoute("id", 0);
        $listaUsuario = $em->getRepository("Usuario\Entity\Administrador")->findByIdadministrador($idusuario);
        $request = $this->getRequest();
          if ($request->isPost()){
                $select = $em->find("Usuario\Entity\Administrador", $idusuario);
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
        $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaAluno = $em->getRepository("Usuario\Entity\Aluno")->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAluno));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
             
        return new ViewModel([
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaAluno'=>$listaAluno
            ]);
        }
        
    public function excluirAlunoAction(){
            $this->sairAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAluno", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $aluno = $em->find("Usuario\Entity\Aluno", $id);
            $em->remove($aluno);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'aluno','id'=>$page]);       
    }
    public function editarAlunoAction(){
        $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idAluno = $this->params()->fromRoute("id", 0);
            $page = $this->params()->fromRoute("page", 0);
            $listaAluno = $em->getRepository("Usuario\Entity\Aluno")->findByIdaluno($idAluno);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Usuario\Entity\Aluno", $idAluno);
                $nome = $request->getPost("nome");
                $matricula = $request->getPost("matricula");
                $curso = $request->getPost("curso");
                    
                
                try{
                   $select->setNome($nome);
                    $select->setMatricula($matricula);
                    $select->setCurso($curso);
                    $em->persist($select);
                    $em->flush();     
                } catch (Exception $ex) {

                }
       
            }
            
            return new ViewModel([              
                    'listaAluno' => $listaAluno,
                'page'=>$page
            ]);
        }
    public function empresaAction(){
            $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaEmpresa = $em->getRepository("Usuario\Entity\Empresa")->findAll();
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
                    'listaEmpresa'=>$listaEmpresa
            ]);
        }
          public function agenteAction(){
              $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaAgente = $em->getRepository("Usuario\Entity\Agente")->findAll();
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
                    'listaEmpresa'=>$listaAgente
            ]);
        }    
        public function editarEmpresaAction(){
            $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idEmpresa = $this->params()->fromRoute("id", 0);
            $listaEmpresa = $em->getRepository("Usuario\Entity\Empresa")->findByIdempresa($idEmpresa);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Usuario\Entity\Empresa", $idEmpresa);
                $empresa = $request->getPost("empresa");
                $cnpj = $request->getPost("cnpj");
                $telefone = $request->getPost("telefone");
                    
                
                try{
                   $select->setEmpresa($empresa);
                    $select->setCnpj($cnpj);
                    $select->setTelefone($telefone);
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
             $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idAgente = $this->params()->fromRoute("id", 0);
            $listaAgente = $em->getRepository("Usuario\Entity\Agente")->findByIdagente($idAgente);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Usuario\Entity\Agente", $idAgente);
                $agente = $request->getPost("agente");
                $cnpj = $request->getPost("cnpj");
                $telefone = $request->getPost("telefone");
                    
                
                try{
                   $select->setAgente($agente);
                    $select->setCnpj($cnpj);
                    $select->setTelefone($telefone);
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
            $this->sairAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteEmpresa", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $empresa = $em->find("Usuario\Entity\Empresa", $id);
            $em->remove($empresa);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'empresa', 'id'=>$page]);       
    }
    public function excluirAgenteAction(){
            $this->sairAction();
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAgente", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $agente = $em->find("Usuario\Entity\Agente", $id);
            $em->remove($agente);
            $em->flush();
          
        return $this->redirect()->toRoute('administrador/default',['controller'=>'administrador','action'=>'agente','id'=>$page]);       
    }
 
}