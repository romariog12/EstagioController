<?php
namespace Administrador\Controller;

use Administrador\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Model\Entity;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Administrador\Entity\Usuario;
use Zend\Authentication\AuthenticationService;

class AdministradorController extends AdministradorAbstractActionController
{   
    public function __construct() {
        $this->route        = 'administrador/default';
        $this->controller   = 'administrador';
        $this->countPerPage = '10';
    }
    public function cadastrarUsuarioAction(){
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
        $em = $this->getServiceLocator()->get(Entity::em);
        $listaUsuarios = $em->getRepository(Entity::usuario)->findAll();     
            return new ViewModel([
                'listaUsuarios'=>$listaUsuarios
            ]);
    }
    public function excluirUsuarioAction(){
     
        $auth = new AuthenticationService();
           foreach ($auth->getIdentity() as $l){
               $nivel = $l[0]->getNivel();
               switch ($nivel):
                   case 'u2':
                       return $this->redirect()->toRoute('painelEmpresa/default',['controller'=>'empresa', 'id'=>'1']);
                   case ' u3':
                       return $this->redirect()->toRoute('painelAluno');         
               endswitch;
           } 
            $id = $this->params()->fromRoute("deleteUsuario", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $usuario = $em->find(Entity::usuario, $id);
            $em->remove($usuario);
            $em->flush();
          
        return $this->redirect()->toRoute('usuarios');       
    }
    
    public function editarUsuarioAction(){ 
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
                    $senha = $request->getPost("senha");  
                    try { 
                        $select ->setNome($nome);
                        $select->setLogin($login); 
                        $select->setMatricula($matricula);
                        $select->setCargo($cargo);
                        $select->setNivel($nivel);
                        $select->setSenha($senha);
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
       
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaAlunoPresencial = $em->getRepository(Entity::alunoPresencial)->findAll();
            $listaAlunoEAD = $em->getRepository(Entity::alunoEad)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAlunoEAD));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->countPerPage);
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
        
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaAlunoPresencial = $em->getRepository(Entity::alunoPresencial)->findAll();
            $listaAlunoEAD = $em->getRepository(Entity::alunoEad)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAlunoPresencial));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->countPerPage);
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
        
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAluno", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $aluno = $em->find(Entity::alunoEad, $id);
            $em->remove($aluno);
            $em->flush();
          
        return $this->redirect()->toRoute($this->route ,['controller' => $this->controller,'action'=>'aluno','id'=>$page]);       
    }
    public function excluirAlunoPresencialAction(){
        
             $auth = new AuthenticationService();
           foreach ($auth->getIdentity() as $l){
               $nivel = $l[0]->getNivel();
               switch ($nivel):
                   case 'u2':
                       return $this->redirect()->toRoute('painelEmpresa/default',['controller'=>'empresa', 'id'=>'1']);
                   case ' u3':
                       return $this->redirect()->toRoute('painelAluno');         
               endswitch;
           } 
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAluno", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $aluno = $em->find(Entity::alunoPresencial, $id);
            $em->remove($aluno);
            $em->flush();
          
        return $this->redirect()->toRoute($this->route ,['controller'=>$this->controller,'action'=>'todosalunospresencial','id'=>$page]);       
    }
    public function editarAlunoAction(){
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
                     return $this->redirect()->toRoute($this->route ,['controller'=>$this->controller,'action'=>'todosalunospresencial','id'=>$idAluno, 'page'=>$page]);
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
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaEmpresa = $em->getRepository(Entity::empresa)->findAll();
            $listaAgente = $em->getRepository(Entity::agente)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaEmpresa));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->countPerPage);
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
        
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaEmpresa = $em->getRepository(Entity::empresa)->findAll();
            $listaAgente = $em->getRepository(Entity::agente)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAgente));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->countPerPage);
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
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteEmpresa", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $empresa = $em->find(Entity::empresa, $id);
            $em->remove($empresa);
            $em->flush();
          
        return $this->redirect()->toRoute($this->route ,['controller'=>$this->controller,'action'=>'empresa', 'id'=>$page]);       
    }
    public function excluirAgenteAction(){
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("deleteAgente", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $agente = $em->find(Entity::agente, $id);
            $em->remove($agente);
            $em->flush();
          
        return $this->redirect()->toRoute($this->route ,['controller'=>$this->controller,'action'=>'agente','id'=>$page]);       
    }
     public function documentosPresencialAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $listaDocumentoPendente = $em->getRepository(Entity::documentoPresencial)->findByOperacao('1','1','1','0');
        $documentoPendenteTCE = $em->getRepository(Entity::documentoPresencial)->findBySituacaoAndTipoAndData("TCE", date('d/m/Y'));
        $documentoPendente = $em->getRepository(Entity::documentoPresencial)->findByEntregue("Nao");
            $vencimento1 = new \DateTime(date('Y-m-d'));
            $vencimento2 = new \DateTime(date('Y-m-d').'+1 days');
            $vencimento3 = new \DateTime(date('Y-m-d').'+2 days');
            $vencimento4 = new \DateTime(date('Y-m-d').'+3 days');
            $vencimento5 = new \DateTime(date('Y-m-d').'+4 days');
            $listaContratosVencendo = $em->getRepository(Entity::documentoPresencial)
            ->findByFim($vencimento1,$vencimento2, $vencimento3,$vencimento4, $vencimento5);
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaContratosVencendo));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->countPerPage);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
        
        return new ViewModel(
                [
                    'documentoPendente' => $documentoPendente,
                    'documentoPendenteTCE' => $documentoPendenteTCE,
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaDocumentoPendente' =>$listaDocumentoPendente,
                    'listaContratosVencendo'=> $listaContratosVencendo
                ]
                );
    }
    public function documentosPresencialPendenteAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $listaDocumentoPendente = $em->getRepository(Entity::documentoPresencial)->findByOperacao('1','1','1','0');
        $documentoPendenteTCE = $em->getRepository(Entity::documentoPresencial)->findBySituacaoAndTipoAndData("TCE", date('d/m/Y'));
        $documentoPendente = $em->getRepository(Entity::documentoPresencial)->findByEntregue("Nao");
        $vencimento1 = new \DateTime(date('Y-m-d'));
        $vencimento2 = new \DateTime(date('Y-m-d').'+1 days');
        $vencimento3 = new \DateTime(date('Y-m-d').'+2 days');
        $vencimento4 = new \DateTime(date('Y-m-d').'+3 days');
        $vencimento5 = new \DateTime(date('Y-m-d').'+4 days');
        $listaContratosVencendo = $em->getRepository(Entity::documentoPresencial)
            ->findByFim($vencimento1,$vencimento2, $vencimento3,$vencimento4, $vencimento5);
        $page = $this->params()->fromRoute("id", 0);
        $pagination = new Paginator( new ArrayAdapter($listaDocumentoPendente));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->countPerPage);
            $count = $pagination->count();
            $pageNumber = $pagination->getCurrentPageNumber();
            $getPages = $pagination->getPages();
        
        return new ViewModel(
                [
                    'documentoPendente' => $documentoPendente,
                    'documentoPendenteTCE' => $documentoPendenteTCE,
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaDocumentoPendente'=> $listaDocumentoPendente,
                    'listaContratosVencendo'=> $listaContratosVencendo
                ]
                );
    }
    public function mensagemAction(){
            $idempresa = $this->params()->fromRoute("id", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $selecionarEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idempresa);
            foreach ($selecionarEmpresa as $l){
                $email = $l->getEmail();
            }
            $request = $this->getRequest();
            if($request ->isPost()){
                $mensagemClass = new \Base\Entity\Mensagem();
                $mensagem = $request->getPost("mensagem");
                $titulo = $request->getPost("titulo");
                try {
                    $mensagemClass->setEmail($email)
                            ->setIddestinatario('empresa-'.$idempresa)
                            ->setMensagem($mensagem)
                            ->setRemetente('Instituição de Ensino')
                            ->setTitulo($titulo)
                            ->setStatus('0')
                            ->setData(new \DateTime(date('Y-m-d')));
                    
                    $em->persist($mensagemClass);
                    $em->flush(); 
                } catch (Exception $ex) {
                    
                }
            }
            return new ViewModel([
                'empresa' => $selecionarEmpresa
            ]);
            
       
        
    }
}