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
use Perfil\Entity\Perfil;
use Vaga\Entity\Vaga;
use Aluno\Entity\Aluno;

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
       if(!isset($this->session()->item)){
           $this->redirect()->toUrl('http://127.0.0.1/Projem/public/login');
       }
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
                    $perfil = new Perfil();
                        $em->persist($perfil);
                        $em->flush();                
                  
          }catch (Exception $e){
             
          }         
         } 
        return new ViewModel();
    }
}
