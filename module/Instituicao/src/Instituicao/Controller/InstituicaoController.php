<?php

namespace Instituicao\Controller;
use Zend\View\Model\ViewModel;
use Base\Model\Entity;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Base\Model\Constantes;
use Administrador\Form\alunoForm;
use Administrador\Model\Aluno;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * @author Romário Macêdo Portela <romariomacedo18@gmail.com>
 */
class InstituicaoController extends AbstractActionController{
    
    public function homeAction(){
        return new ViewModel([]);
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
            $id = $this->params()->fromRoute("id", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $aluno = $em->find(Entity::aluno, $id);
            $em->remove($aluno);
            $em->flush();
        return $this->redirect()->toRoute(Constantes::rotaAdministradorDefault,['controller'=>Constantes::administrador,'action'=>  Constantes::todosAlunos,'id'=>$page]);       
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

}
