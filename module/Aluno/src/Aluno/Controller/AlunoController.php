<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Aluno\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vaga\Entity\Vaga;
use Aluno\Entity\Aluno;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class AlunoController extends AbstractActionController
{
    public function indexAction()   {
    $this->sairAction();
    
    $request = $this->getRequest();
   
    if($request->isPost()){
        $data = $this->params()->fromPost();
        $aluno = new Aluno(); 
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        if ($data['buscar']=='Buscar'){
                   $matricula = $request->getPost('busca');
                   $aluno->setMatricula($matricula);
                   $lista = $em->getRepository("Aluno\Entity\Aluno")->findByMatricula($aluno->getMatricula());
                   
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
      $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdalunovaga($id);
      $lista = $em->getRepository("Aluno\Entity\Aluno")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaEncaminhamento = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdvagaEncaminhamento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'lista'=>$lista,
                'listaEncaminhamento'=>$listaEncaminhamento
            ]);        
    }
     public function cadastrarAction() {
       $this->sairAction();
          $request = $this->getRequest();  
          if($request->isPost())
          {         
               try{  
                $nome = $request->getPost("nome");
                $curso = $request->getPost("curso");
                $matricula = $request->getPost("matricula");

                $aluno = new \Aluno\Entity\Aluno();
                $aluno->setAdministradorIdadministrador("0");
                $aluno->setNome($nome);
                $aluno->setCurso($curso);
                $aluno->setMatricula($matricula);
                    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                    $em->persist($aluno);
                    $em->flush(); 
                                   
                  
          }catch (Exception $e){
             
          }
          echo "<div><p  style='text-align: center ; color: red'>Aluno cadastrado com sucesso!</p>".
                  '<button type="button" class="close pager" data-dismiss="alert">x</button></div>';
         } 
        return new ViewModel();
    }
     public function alunoAction(){
         $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaAluno = $em->getRepository("Aluno\Entity\Aluno")->findAll();
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
            $aluno = $em->find("Aluno\Entity\Aluno", $id);
            $em->remove($aluno);
            $em->flush();
          
        return $this->redirect()->toRoute('aluno/default',['controller'=>'aluno', 'id'=>$page]);       
    }
     public function editarAlunoAction(){
         $this->sairAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $idAluno = $this->params()->fromRoute("id", 0);
            $listaAluno = $em->getRepository("Aluno\Entity\Aluno")->findByIdaluno($idAluno);
            $request = $this->getRequest();
            if($request ->isPost()){
                $select = $em ->find("Aluno\Entity\Aluno", $idAluno);
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
                 
            ]);
        }
    
    
    
    
    
    
}
