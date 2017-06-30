<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administrador\Controller;

use Auth\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Model\Entity;
use Aluno\Entity\AlunoPresencial;
class AlunoPresencialController extends AdministradorAbstractActionController {
  
    public function buscarAlunoAction()   {
    $this->logout();
    $this->acessoNegado();
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get(Entity::em);

    if($request->isPost()){
        $data = $this->params()->fromPost();
        $aluno = new AlunoPresencial(); 
        switch ($data['buscar']){
            case 'buscarPorMatricula':
                    $matricula = $request->getPost('porMatricula');
                    $aluno->setMatricula($matricula);
                    $lista = $em->getRepository(Entity::alunoPresencial)->findByMatricula($aluno->getMatricula());
                    break;
            case 'buscarPorNome':
                    $nome = $request->getPost('porNome');
                    $aluno->setNome($nome);
                    $lista = $em->getRepository(Entity::alunoPresencial)->findByNome($aluno->getNome());
                    break;
        }
        return new ViewModel([
        'lista' => $lista,
           
            ]);  
        }
    }
    //Vagas cadastradas no Perfil                  
    public function perfilAction(){
      $this->logout();
      $this->acessoNegado();
      $em = $this->getServiceLocator()->get(Entity::em);
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository(Entity::vagaPresencial)->findByIdalunovaga($id);
      $listaVagaPresencial = $em->getRepository(Entity::vagaPresencial)->findByIdalunovaga($id);
      $listaVagaPresencialEstagiando = $em->getRepository(Entity::vagaPresencial)->findByRecisaoAndIdAlunoVaga('', $id);
      $lista = $em->getRepository(Entity::alunoPresencial)->findByidaluno($id);
      
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'listaVagaPresencial'=>$listaVagaPresencial,
                'listaVagaPresencialEstagiando'=>$listaVagaPresencialEstagiando,
                'lista'=>$lista,
            ]);        
    }
     public function estagiosAction(){
        $this->logout();
        $this->acessoNegado();
        $vaga = new \Vaga\Entity\VagaPresencial();
        $em = $this->getServiceLocator()->get(Entity::em);
        $id = $this->params()->fromRoute("id", 0);
        $listaVaga = $em->getRepository(Entity::vagaPresencial)->findByIdalunovaga($id);
        $listaAluno = $em->getRepository(Entity::alunoPresencial)->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $vaga->setIdvaga($l->getidvaga());
                    }
                    $listaDocumento = $em->getRepository(Entity::documentoPresencial)->findByIdvagaDocumentoAndSituacao($vaga->getIdvaga(),"Nao");
                    return new ViewModel([
                        'listaVaga'=>$listaVaga,
                        'lista'=>$listaAluno,
                        'listaDocumento'=>  count($listaDocumento)
                    ]);        
    }
     public function cadastrarAction() {
            $this->logout();
            $this->acessoNegado();
            $em = $this->getServiceLocator()->get(Entity::em);
            $request = $this->getRequest(); 
            $listaDadosPresencial = $em->getRepository(Entity::dadosPresencial)->findAll();
            $listaDados = $em->getRepository(Entity::dadosPresencial)->findAll();
            if($request->isPost())
            {         
               try{  
                $nome = $request->getPost("nome");
                $curso = $request->getPost("curso");
                $matricula = $request->getPost("matricula");
                $email = $request->getPost("email");
                $telefone = $request->getPost("telefone");
                $cpf = $request->getPost("cpf");
                $senha = $request->getPost("cpf");

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
          }catch (Exception $e){   
          }
          $mensagem = '<div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Aluno cadastrado com sucesso!</strong> .
          </div> ';
         return new ViewModel(
                [
                    'mensagem'=>$mensagem
                ]);
          } 
        return new ViewModel(
                [
                    'listaDados'=>$listaDados,
                    'listaDadosPresencial'=> $listaDadosPresencial,
                ]);
    }
    public function declaracaoPresencialAction(){
        $this->logout();
        $this->acessoNegado();
        $em = $this->getServiceLocator()->get(Entity::em);
        $idAluno = $this->params()->fromRoute("id", 0);
        $idVaga = $this->params()->fromRoute("idVaga", 0);
        $aluno = $em->getRepository(Entity::alunoPresencial)->findByIdaluno($idAluno);
        $vaga = $em->getRepository(Entity::vagaPresencial)->findByIdvaga($idVaga);
        $colaborador = $this->session()->comum;
        return new ViewModel([
            'aluno'=>$aluno,
            'vaga'=>$vaga,
            'colaborador'=>$colaborador
        ]);
    }   
}