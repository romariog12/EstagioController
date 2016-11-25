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
use Aluno\Entity\AlunoPresencial;


class AlunoPresencialController extends AbstractActionController {
    
    public function __construct() {
        $this->em = 'Doctrine\ORM\EntityManager';
        $this->dadosPresencial      = 'Base\Entity\DadosPresencial';
        $this->alunoPresencial      = 'Aluno\Entity\AlunoPresencial';
        $this->vagaPresencial       = 'Vaga\Entity\VagaPresencial';
        $this->DocumentoPresencial  = 'Vaga\Entity\DocumentoPresencial';
    }

    public function buscarAlunoAction()   {
    $this->sairComumAction();
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get($this->em);

    if($request->isPost()){
        $data = $this->params()->fromPost();
        $aluno = new AlunoPresencial(); 

        switch ($data['buscar']){
            case 'buscarPorMatricula':
                    $matricula = $request->getPost('porMatricula');
                    $aluno->setMatricula($matricula);
                    $lista = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByMatricula($aluno->getMatricula());
                    break;
            case 'buscarPorNome':
                    $nome = $request->getPost('porNome');
                    $aluno->setNome($nome);
                    $lista = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByNome($aluno->getNome());
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
      $em = $this->getServiceLocator()->get($this->em);
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
      $listaVagaPresencial = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
      $listaVagaPresencialEstagiando = $em->getRepository("Vaga\Entity\VagaPresencial")->findByRecisaoAndIdAlunoVaga('', $id);
      $lista = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
        $listaDocumento = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByIdvagaDocumentoAndSituacao($vaga->getIdvaga(),"Nao");
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'listaVagaPresencial'=>$listaVagaPresencial,
                'listaVagaPresencialEstagiando'=>$listaVagaPresencialEstagiando,
                'lista'=>$lista,
                'listaDocumento'=>count($listaDocumento)
            ]);        
    }
     public function estagiosAction(){
        $this->sairComumAction();
        $vaga = new \Vaga\Entity\VagaPresencial();
        $em = $this->getServiceLocator()->get($this->em);
        $id = $this->params()->fromRoute("id", 0);
        $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
        $listaAluno = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $vaga->setIdvaga($l->getidvaga());
                    }
                    $listaDocumento = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByIdvagaDocumentoAndSituacao($vaga->getIdvaga(),"Nao");
                    return new ViewModel([
                        'listaVaga'=>$listaVaga,
                        'lista'=>$listaAluno,
                        'listaDocumento'=>  count($listaDocumento)
                    ]);        
    }
     public function cadastrarAction() {
            $this->sairComumAction();
            $em = $this->getServiceLocator()->get(em);
            $request = $this->getRequest(); 
            $listaDadosPresencial = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
            $listaDados = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
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

                $aluno = new \Aluno\Entity\AlunoPresencial();
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
    public function declaracaoPresencialAction(){
        $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idAluno = $this->params()->fromRoute("id", 0);
        $idVaga = $this->params()->fromRoute("idVaga", 0);
        $aluno = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByIdaluno($idAluno);
        $vaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdvaga($idVaga);
        $colaborador = $this->session()->comum;
      
        return new ViewModel([
            'aluno'=>$aluno,
            'vaga'=>$vaga,
            'colaborador'=>$colaborador
        ]);
    }
       
   
    
}