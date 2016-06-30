<?php

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function geralAction()
    {
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $findCurso = $em->getRepository("Aluno\Entity\Aluno")->findAll();
            $findEmpresa = $em->getRepository("Empresa\Entity\Empresa")->findAll();
            $recisaoRow1 = $em->getRepository("Vaga\Entity\Vaga")->findByRecisao('');
            $recisaoRow2 = $em->getRepository("Vaga\Entity\Vaga")->findByRecisao('-');
            $row = count($findCurso);
            $rowRecisao1 = count($recisaoRow1); 
            $rowRecisao2 = count($recisaoRow2);
            $rowRecisao = $rowRecisao2 + $rowRecisao1;
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
   
   public function cursograficoAction(){
        
   }
}
    
