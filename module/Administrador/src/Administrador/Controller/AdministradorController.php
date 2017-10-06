<?php
namespace Administrador\Controller;

use Zend\View\Model\ViewModel;
use Base\Model\Entity;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Administrador\Entity\Usuario;
use Base\Model\Constantes;
use Administrador\Form\alunoForm;
use Administrador\Model\Aluno;
use Administrador\Form\empresaForm;
use Zend\Mvc\Controller\AbstractActionController;
/**
 * @author romario <romariomacedo18@gmail.com>
 */
class AdministradorController extends AbstractActionController
{
    private $resposta = false;
    private $empresa = false;
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
            try {
                $administrador = new Usuario();
                $administrador->setNome($nome);
                $administrador->setLogin($login);
                $administrador->setSenha($senha);
                $administrador->setMatricula($matricula);
                $administrador->setCargo($cargo);
                $administrador->setNivel($nivel);
                $em->persist($administrador);
                $em->flush();
            } catch (Exception $ex) {} 
            $this->redirect()->toUrl('usuarios');
        }
        return new ViewModel();
    } 
    public function usuariosAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $listaUsuarios = $em->getRepository(Entity::usuario)->findAll();     
        return new ViewModel([
            'listaUsuarios'=>$listaUsuarios
        ]);
    }
    public function excluirUsuarioAction(){
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
    public function buscarAlunoAction(){
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get(Entity::em);
    if($request->isPost()){
        $data = $this->params()->fromPost();
        switch ($data['buscar']){
            case 'buscarPorMatricula':
                    $matricula = $request->getPost('porMatricula');
                    $lista = $em->getRepository(Entity::aluno)->findByMatricula($matricula);
                    break;
            case 'buscarPorNome':
                    $nome = $request->getPost('porNome');
                    $lista = $em->getRepository(Entity::aluno)->findByNome($nome);
                    break;
        }
        return new ViewModel([
        'lista' => $lista,
            ]);  
        }
    }
    public function todosAlunosAction(){
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaAlunoPresencial = $em->getRepository(Entity::aluno)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAlunoPresencial));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(Constantes::contadorPorPagina);
            $count = $pagination->count();
            $pageNumber = $pagination->getCurrentPageNumber();
            $getPages = $pagination->getPages();
        return new ViewModel([
            'getPages'=>$getPages,
            'pageNumber'=>$pageNumber,
            'count'=>$count,
            'pagination'=>$pagination,
            'listaAlunoPresencial'=>$listaAlunoPresencial 
            ]);
        } 
    public function excluirAlunoAction(){
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("iddelete", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $aluno = $em->find(Entity::aluno, $id);
            $em->remove($aluno);
            $em->flush();
        return $this->redirect()->toRoute($this->route ,['controller'=>Constantes::administrador,'action'=>  Constantes::todosAlunos,'id'=>$page]);       
    }
    public function perfilAlunoAction(){
      $em = $this->getServiceLocator()->get(Entity::em);
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository(Entity::vaga)->findByIdalunovaga($id);
      $listaVagaEstagiando = $em->getRepository(Entity::vaga)->findBySituacaoAndIdAlunoVaga('1', $id);
      $aluno = $em->getRepository(Entity::aluno)->findByidaluno($id);
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'listaVagaPresencial'=>$listaVaga,
                'listaVagaPresencialEstagiando'=>$listaVagaEstagiando,
                'aluno'=>$aluno,
            ]);
    }
    public function editarAlunoAction(){
            $alunoForm = new alunoForm();
            $em = $this->getServiceLocator()->get(Entity::em);
            $idAluno = $this->params()->fromRoute('id', 0);
            $page = $this->params()->fromRoute('page', 0);
            $selecionarAluno = $em ->find(Entity::aluno, $idAluno);
            $listaAluno = $em->getRepository(Entity::aluno)->findByIdaluno($idAluno);
            $listaCursoPresencial = $em->getRepository(Entity::dados)->findAll();
            $request = $this->getRequest();
            if($request ->isPost()){
                $editarAluno = new Aluno();
                $alunoForm->setInputFilter($editarAluno->getInputFilter());
                $alunoForm->setData($request->getPost());
                if($alunoForm->isValid()){
                    $nome = $request->getPost("nome");
                    $matricula = $request->getPost("matricula");
                    $curso = $request->getPost("curso");
                    $email = $request->getPost("email");
                    $telefone = $request->getPost("telefone");
                    $cpf = $request->getPost("cpf");
                    try{
                        $selecionarAluno->setNome($nome);
                        $selecionarAluno->setMatricula($matricula);
                        $selecionarAluno->setCurso($curso);
                        $selecionarAluno->setEmail($email);
                        $selecionarAluno->setTelefone($telefone);
                        $selecionarAluno->setCpf($cpf);
                        $em->persist($selecionarAluno);
                        $em->flush();     
                    } catch (Exception $e) {}
                $this->resposta = true;
                }
    }
    return new ViewModel([              
                'listaAluno' => $listaAluno,
                'listaCursoPresencial'=>$listaCursoPresencial,
                'page'=>$page,
                'alunoForm' => $alunoForm,
                'resposta' =>  $this->resposta,
                
            ]);
}
     public function cadastrarAlunoAction() {
            $alunoForm = new alunoForm();
            $em = $this->getServiceLocator()->get(Entity::em);
            $request = $this->getRequest(); 
            $listaCursos = $em->getRepository(Entity::dados)->findAll();
            $listaDadosPresencial = $em->getRepository(Entity::dados)->findAll();
            if($request->isPost()) { 
                $Aluno = new Aluno();
                $alunoForm->setInputFilter($Aluno->getInputFilter());
                $alunoForm->setData($request->getPost());
                if($alunoForm->isValid()){
                    $nome = $request->getPost("nome");
                    $curso = $request->getPost("curso");
                    $matricula = $request->getPost("matricula");
                    $email = $request->getPost("email");
                    $telefone = $request->getPost("telefone");
                    $cpf = $request->getPost("cpf");
                    $senha = $request->getPost("cpf");
                    try{  
                        $aluno = new \Aluno\Entity\AlunoPresencial();
                        $aluno->setAdministradorIdadministrador("0");
                        $aluno->setNome($nome);
                        $aluno->setCurso($curso);
                        $aluno->setMatricula($matricula);
                        $aluno->setSenha($senha);
                        $aluno->setCpf($cpf);
                        $aluno->setEmail($email);
                        $aluno->setTelefone($telefone);
                    $em = $this->getServiceLocator()->get(Entity::em);
                    $em->persist($aluno);
                    $em->flush();     
                    }catch (Exception $e){ }
                    return $this->redirect()->toRoute(Constantes::rotaPerfilAlunoDefault,['controller'=>  Constantes::administrador, 'action'=>  Constantes::perfilAluno, 'id'=>$aluno->getIdaluno()]);    
                    }
            }  
        return new ViewModel(
                [   
                    
                    'listaCursos'=>$listaCursos,
                    'listaDadosPresencial'=> $listaDadosPresencial,
                    'alunoForm' => $alunoForm
                ]);
    }
    public function empresaAction(){
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaEmpresa = $em->getRepository(Entity::empresa)->findAll();
            $listaAgente = $em->getRepository(Entity::agente)->findAll();
            $page = $this->params()->fromRoute('id', 0);
            $pagination = new Paginator( new ArrayAdapter($listaEmpresa));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(Constantes::contadorPorPagina);
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
    public function perfilEmpresaAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $idEmpresa = $this->params()->fromRoute('id', 0);
        $selecionarVaga = $em->getRepository(Entity::vaga)->findByIdEmpresaVaga($idEmpresa);
        $selecionarEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idEmpresa);
        $listaVagaEstagiando = $em->getRepository(Entity::vaga)->findBySituacaoAndIdEmpresaVaga('1',$idEmpresa);
            $page = $this->params()->fromRoute("page", 0);
            $pagination = new Paginator( new ArrayAdapter($selecionarVaga));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(Constantes::contadorPorPagina);
            $count = $pagination->count();
            $pageNumber = $pagination->getCurrentPageNumber();
            $getPages = $pagination->getPages();
                 return new ViewModel([
                        'listaVaga'=>$selecionarVaga,
                        'empresaSelect'=>$selecionarEmpresa,
                        'getPages'=>$getPages,
                        'pageNumber'=>$pageNumber,
                        'count'=>$count,
                        'pagination'=>$pagination,
                        'empresa'=>$idEmpresa,
                        'listaVagaEstagiando'=>$listaVagaEstagiando,
                        'idEmpresa'=>$idEmpresa
                ]);        
        }
    public function buscarEmpresaAction(){
            $request = $this->getRequest();
            if($request->isPost()){
                $data = $this->params()->fromPost();
                $em = $this->getServiceLocator()->get(Entity::em);
                switch ($data['buscar']){
                    case 'buscarPorCnpj':
                            $cnpj = $request->getPost('porCnpj');
                            $lista = $em->getRepository(Entity::empresa)->findByCnpj($cnpj);
                            break;
                    case 'buscarPorNome':
                            $nome = $request->getPost('porNome');
                            $lista = $em->getRepository(Entity::empresa)->findByEmpresa($nome);
                            break;
                }
                return new ViewModel([
                'lista' => $lista,
                    ]);  
             }      
    }    
    public function agenteAction(){
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaEmpresa = $em->getRepository(Entity::empresa)->findAll();
            $listaAgente = $em->getRepository(Entity::agente)->findAll();
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaAgente));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(Constantes::contadorPorPagina);
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
            $page = $this->params()->fromRoute("page", 0);
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
                } catch (Exception $ex) {}   
            return $this->redirect()->toRoute('paginator', ['controller'=>  Constantes::administrador, 'action' =>  Constantes::empresa,'id'=>$page]);            
            }
            return new ViewModel([
                    'listaEmpresa' => $listaEmpresa
            ]);
        }
    public function editarAgenteAction(){
            $em = $this->getServiceLocator()->get(Entity::em);
            $idAgente = $this->params()->fromRoute("id", 0);
            $page = $this->params()->fromRoute("page", 0);
            $selecionarAgente = $em->getRepository(Entity::agente)->findByIdagente($idAgente);
            $request = $this->getRequest();
            if($request ->isPost()){
                $selecionarAgente = $em ->find(Entity::agente, $idAgente);
                $agente = $request->getPost("agente");
                $cnpj = $request->getPost("cnpj");
                $telefone = $request->getPost("telefone");
                $endereco = $request->getPost("endereco");
                $responsavel = $request->getPost("responsavel");
                $email = $request->getPost("email");
                try{
                    $selecionarAgente->setAgente($agente);
                    $selecionarAgente->setCnpj($cnpj);
                    $selecionarAgente->setTelefone($telefone);
                    $selecionarAgente->setEndereco($endereco);
                    $selecionarAgente->setResponsavel($responsavel);
                    $selecionarAgente->setEmail($email);
                    $em->persist($selecionarAgente);
                    $em->flush();     
                } catch (Exception $ex){}   
                return $this->redirect()->toRoute('paginator', ['controller'=>  Constantes::administrador, 'action' =>  Constantes::agente,'id'=>$page]);            
            } 
            return new ViewModel([
                    'listaAgente' => $selecionarAgente
            ]);
        }
    public function excluirEmpresaAction(){
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("id", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $empresa = $em->find(Entity::empresa, $id);
            $em->remove($empresa);
            $em->flush();   
        return $this->redirect()->toRoute(Constantes::rotaAdministradorDefault ,['controller'=>  Constantes::administrador,'action'=>  Constantes::empresa, 'id'=>$page]);       
    }
    public function excluirAgenteAction(){
            $page = $this->params()->fromRoute("page", 0);
            $id = $this->params()->fromRoute("id", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $agente = $em->find(Entity::agente, $id);
            $em->remove($agente);
            $em->flush();
        return $this->redirect()->toRoute(Constantes::rotaAdministradorDefault,['controller'=>Constantes::administrador,'action'=>'agente','id'=>$page]);       
    }
    public function documentosPresencialAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $listaDocumentoPendente = $em->getRepository(Entity::documento)->findByOperacao('1','1','1','0');
        $documentoPendenteTCE = $em->getRepository(Entity::documento)->findBySituacaoAndTipoAndData("TCE", date('d/m/Y'));
        $documentoPendente = $em->getRepository(Entity::documento)->findByEntregue("Nao");
            $vencimento1 = new \DateTime(date('Y-m-d'));
            $vencimento2 = new \DateTime(date('Y-m-d').'+1 days');
            $vencimento3 = new \DateTime(date('Y-m-d').'+2 days');
            $vencimento4 = new \DateTime(date('Y-m-d').'+3 days');
            $vencimento5 = new \DateTime(date('Y-m-d').'+4 days');
            $listaContratosVencendo = $em->getRepository(Entity::documento)
            ->findByFim($vencimento1,$vencimento2, $vencimento3,$vencimento4, $vencimento5);
            $page = $this->params()->fromRoute("id", 0);
            $pagination = new Paginator( new ArrayAdapter($listaContratosVencendo));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(Constantes::contadorPorPagina);
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
    public function cadastrarEmpresaAction(){
        $empresaForm = new empresaForm();
        $em = $this->getServiceLocator()->get(Entity::em);
        $request = $this->getRequest();
        $idRota = $this->params()->fromRoute("id", 0);
        if ($request->isPost()){
            $empresaFiltrer = new \Administrador\Model\Empresa();
            $empresaForm->setInputFilter($empresaFiltrer->getInputFilter());
            $empresaForm->setData($request->getPost());
            if($empresaForm->isValid()){
                $nomeEmpresa = $request->getPost("empresa");
                $cnpj = $request->getPost("cnpj");
                $telefone = $request->getPost("telefone");
                $endereco = $request->getPost("endereco");
                $responsavel = $request->getPost("responsavel");
                $email = $request->getPost("email");
                $senha = $request->getPost("cnpj");
              try {
                $empresa = new \Empresa\Entity\Empresa();
                $empresa ->setEmpresa($nomeEmpresa);
                $empresa ->setCnpj($cnpj);
                $empresa ->setTelefone($telefone);
                $empresa ->setEndereco($endereco);
                $empresa ->setResponsavel($responsavel);
                $empresa ->setEmail($email);
                $empresa ->setSenha($senha);
                $em->persist($empresa);
                $em->flush();
                } catch (Exception $e) {}
            }
            $this->resposta = true;
            $this->empresa = $empresa;
        }
          return new ViewModel([
              'resposta' =>  $this->resposta,
              'idaluno'=>$idRota,
              'empresaForm'=>$empresaForm,
              'empresa' => $this->empresa
          ]);
        } 
    public function documentosPresencialPendenteAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $listaDocumentoPendente = $em->getRepository(Entity::documento)->findByOperacao('1','1','1','0');
        $documentoPendenteTCE = $em->getRepository(Entity::documento)->findBySituacaoAndTipoAndData("TCE", date('d/m/Y'));
        $documentoPendente = $em->getRepository(Entity::documento)->findByEntregue("Nao");
        $vencimento1 = new \DateTime(date('Y-m-d'));
        $vencimento2 = new \DateTime(date('Y-m-d').'+1 days');
        $vencimento3 = new \DateTime(date('Y-m-d').'+2 days');
        $vencimento4 = new \DateTime(date('Y-m-d').'+3 days');
        $vencimento5 = new \DateTime(date('Y-m-d').'+4 days');
        $listaContratosVencendo = $em->getRepository(Entity::documento)
            ->findByFim($vencimento1,$vencimento2, $vencimento3,$vencimento4, $vencimento5);
        $page = $this->params()->fromRoute("id", 0);
        $pagination = new Paginator( new ArrayAdapter($listaDocumentoPendente));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(Constantes::contadorPorPagina);
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
                } catch (Exception $ex) { }
            }
            return new ViewModel([
                'empresa' => $selecionarEmpresa
            ]);    
    }
}