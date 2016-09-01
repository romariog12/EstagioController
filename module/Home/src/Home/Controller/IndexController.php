<?php

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
    
   public function homeAction(){
       $this->sairAction();
       $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findAll();
            $findCurso = $em->getRepository("Usuario\Entity\Aluno")->findAll();
            $findEmpresa = $em->getRepository("Usuario\Entity\Empresa")->findAll();
            $recisaoRow = $em->getRepository("Vaga\Entity\Vaga")->findByRecisao('');
            $findAgente = $em->getRepository("Usuario\Entity\Agente")->findAll();
            $row = count($findCurso);
            $rowRecisao= count($recisaoRow);
            $rowEmpresa = count($findEmpresa);
            $rowVaga = count($listaVaga);
            $rowAgente = count($findAgente);
            $rowContratosEncerrados = $rowVaga - $rowRecisao;
       return new ViewModel([     
                'aluno'=>$row,
                'empresa'=>$rowEmpresa,
                'ativos'=>$rowVaga,
                'agente'=>$rowAgente,
                'encerrados'=>$rowContratosEncerrados
       ]);  
   }
   
   
}
    
