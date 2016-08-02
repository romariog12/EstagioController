<?php

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
    
    public function geralAction()
    {
        if(!isset($this->session()->item)){
           $this->redirect()->toUrl('http://127.0.0.1/Projem/public/login');
       }
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $findCurso = $em->getRepository("Aluno\Entity\Aluno")->findAll();
            $findEmpresa = $em->getRepository("Empresa\Entity\Empresa")->findAll();
            $recisaoRow = $em->getRepository("Vaga\Entity\Vaga")->findByRecisao('');
            $row = count($findCurso);
            $rowRecisao= count($recisaoRow);
            $rowEmpresa = count($findEmpresa);
            
            $request = $this->getRequest();
            if($request->isPost()){
                $curso = $request->getPost('curso');
                $listaAlunos = $em->getRepository("Aluno\Entity\Aluno")->findByCurso($curso);     
                $rowListaAluno = count($listaAlunos);
                return new ViewModel([
                        'fetchRow'=>$findCurso,
                        'row'=> $row,
                        'recisaoRow'=>$rowRecisao,
                        'rowEmpresa' =>$rowEmpresa,   
                        'rowListaAluno'=>$rowListaAluno,
                        'listaAluno' => $listaAlunos
                ]);
                
            }   
            
        return new ViewModel([
            'fetchRow'=>$findCurso,
            'row'=> $row,
            'recisaoRow'=>$rowRecisao,
            'rowEmpresa' =>$rowEmpresa           
        ]);
 
   }
   
   public function homeAction(){
       if(!isset($this->session()->item)){
           $this->redirect()->toUrl('http://127.0.0.1/Projem/public/login');
       }
      $nome = $this->session()->item;
       return new viewModel([
           'nome' =>$nome
               
       ]);  
   }
   public function logoutAction(){
       unset($this->session()->item);
       return $this->redirect()->toUrl('http://127.0.0.1/Projem/public/login');
   }
   
}
    
