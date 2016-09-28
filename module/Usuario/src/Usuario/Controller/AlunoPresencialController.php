<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuario\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vaga\Entity\Vaga;
use Usuario\Entity\AlunoPresencial;

class AlunoPresencialController extends AbstractActionController

{
    
    public function buscarAlunoAction()   {
    $this->sairAction();
    
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    
    if($request->isPost()){
        $data = $this->params()->fromPost();
        $aluno = new AlunoPresencial(); 
        
        
        
        switch ($data['buscar']){
            case 'buscarPorMatricula':
                    $matricula = $request->getPost('porMatricula');
                    $aluno->setMatricula($matricula);
                    $lista = $em->getRepository("Usuario\Entity\AlunoPresencial")->findByMatricula($aluno->getMatricula());
                    break;
            case 'buscarPorNome':
                    $nome = $request->getPost('porNome');
                    $aluno->setNome($nome);
                    $lista = $em->getRepository("Usuario\Entity\AlunoPresencial")->findByNome($aluno->getNome());
                    break;
        }
        

        return new ViewModel([
        'lista' => $lista,
           
            ]);  
        }
    }

    //Vagas cadastradas no Perfil                  
    public function perfilAction(){
       $this->sairAction();
      $vaga = new Vaga();
      $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
      $listaVagaPresencial = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
      $lista = $em->getRepository("Usuario\Entity\AlunoPresencial")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaDocumento = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByIdvagaDocumento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'listaVagaPresencial'=>$listaVagaPresencial,
                'lista'=>$lista,
                'listaEncaminhamento'=>$listaDocumento
            ]);        
    }
     public function estagiosAction(){
       $this->sairAction();
      $vaga = new \Vaga\Entity\VagaPresencial();
      $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
      $listaAluno = $em->getRepository("Usuario\Entity\AlunoPresencial")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaDocumento = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByIdvagaDocumento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'lista'=>$listaAluno,
                'listaEncaminhamento'=>$listaDocumento
            ]);        
    }
     public function cadastrarAction() {
       $this->sairAction();
          $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
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

                $aluno = new \Usuario\Entity\AlunoPresencial();
                $aluno->setAdministradorIdadministrador("0");
                $aluno->setNome($nome);
                $aluno->setCurso($curso);
                $aluno->setMatricula($matricula);
                $aluno->setModalidade($modalidade);
               
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
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idAluno = $this->params()->fromRoute("id", 0);
        $idVaga = $this->params()->fromRoute("idVaga", 0);
        $aluno = $em->getRepository("Usuario\Entity\AlunoPresencial")->findByIdaluno($idAluno);
        $vaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdvaga($idVaga);
      
        return new ViewModel([
            'aluno'=>$aluno,
            'vaga'=>$vaga
        ]);
    }
    
}
