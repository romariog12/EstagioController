<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vaga\Entity\Vaga;
use Aluno\Entity\Aluno;

class AlunoController extends AbstractActionController

{
    
    public function buscarAlunoAction()   {
   $this->sairComumAction();
    
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    
    if($request->isPost()){
        $data = $this->params()->fromPost();
        $aluno = new Aluno(); 
        
        
        
        switch ($data['buscar']){
            case 'buscarPorMatricula':
                    $matricula = $request->getPost('porMatricula');
                    $aluno->setMatricula($matricula);
                    $lista = $em->getRepository("Aluno\Entity\Aluno")->findByMatricula($aluno->getMatricula());
                    break;
            case 'buscarPorNome':
                    $nome = $request->getPost('porNome');
                    $aluno->setNome($nome);
                    $lista = $em->getRepository("Aluno\Entity\Aluno")->findByNome($aluno->getNome());
                    break;
        }
        

        return new ViewModel([
        'lista' => $lista,
           
            ]);  
        }
    }

    //Vagas cadastradas no Perfil                  
    public function perfilAction(){
      $this->sairComumAction();
      $vaga = new Vaga();
      $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdalunovaga($id);
      $listaVagaPresencial = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
      $lista = $em->getRepository("Aluno\Entity\Aluno")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaEncaminhamento = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdvagaEncaminhamento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'listaVagaPresencial'=>$listaVagaPresencial,
                'lista'=>$lista,
                'listaEncaminhamento'=>$listaEncaminhamento
            ]);        
    }
     public function estagiosAction(){
       $this->sairComumAction();
      $vaga = new Vaga();
      $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdalunovaga($id);
      $listaAluno = $em->getRepository("Aluno\Entity\Aluno")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaEncaminhamento = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdvagaEncaminhamento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'lista'=>$listaAluno,
                'listaEncaminhamento'=>$listaEncaminhamento
            ]);        
    }
     public function cadastrarAction() {
          $this->sairComumAction();
          $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
          $request = $this->getRequest(); 
          $listaDadosPresencial = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
          $listaDados = $em->getRepository("Base\Entity\Dados")->findAll();
          if($request->isPost())
          {         
               try{  
                $nome = $request->getPost("nome");
                $curso = $request->getPost("curso");
                $matricula = $request->getPost("matricula");
                $modalidade = $request->getPost("modalidade");
                $email = $request->getPost("email");
                $telefone = $request->getPost("telefone");
                $cpf = $request->getPost("cpf");

                $aluno = new \Aluno\Entity\Aluno();
                $aluno->setAdministradorIdadministrador("0");
                $aluno->setNome($nome);
                $aluno->setCurso($curso);
                $aluno->setMatricula($matricula);
                $aluno->setModalidade($modalidade);
                $aluno->setCpf($cpf);
                $aluno->setEmail($email);
                $aluno->setTelefone($telefone);
                    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                    $em->persist($aluno);
                    $em->flush(); 
                                   
                  
          }catch (Exception $e){
             
          }
          echo "<div><p  style='text-align: center ; color: red'>Aluno cadastrado com sucesso!</p>".
                  '<button type="button" class="close pager" data-dismiss="alert">x</button></div>';
         } 
        return new ViewModel(
                [
                    'listaDados'=>$listaDados,
                    'listaDadosPresencial'=> $listaDadosPresencial
                ]);
    }
    public function declaracaoAction(){
         $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idAluno = $this->params()->fromRoute("id", 0);
        $idVaga = $this->params()->fromRoute("idVaga", 0);
        $aluno = $em->getRepository("Aluno\Entity\Aluno")->findByIdaluno($idAluno);
        $vaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdvaga($idVaga);
        $colaborador = $this->session()->comum;
      
        return new ViewModel([
            'aluno'=>$aluno,
            'vaga'=>$vaga,
            'colaborador'=>$colaborador
        ]);
    }
    
}
