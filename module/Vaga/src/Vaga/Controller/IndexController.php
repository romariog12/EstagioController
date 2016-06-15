<?php

namespace Vaga\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vaga\Entity\Vaga;
use Vaga\Entity\Encaminhamento;
class IndexController extends AbstractActionController
{
    public function indexAction(){
       $request = $this->getRequest();
            try {
                if($request->isPost()){
               $idalunovaga = $this->params()->fromRoute("id", 0);
                $empresa = $request->getPost('emrpesa');
                $agente = $request->getPost('agente');
                $carga = $request->getPost('carga');
                $bolsa = $request->getPost('bolsa') ;
                $semestre = $request->getPost('semestre');
                

                    $vaga = new Vaga();
                    $vaga->setIdalunovaga($idalunovaga);
                    $vaga->setEmpresa($empresa);
                    $vaga->setAgente($agente);
                    $vaga->setCarga($carga);
                    $vaga->setBolsa($bolsa);
                    $vaga->setSemestre($semestre);  

                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                $em->persist($vaga);
                $em->flush();
                return $this->redirect()->toRoute('perfil/default', 
                  array('controller' => 'index', 'action' => 'perfil', 'id'=>$vaga->getIdalunovaga(), 'idVaga'=>$vaga->getIdvaga()));
       
              }
          } catch (Exception $ex) {
               echo $this->flashMessenger()->render();
          }
          $em1 = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
          $lista = $em1->getRepository("Empresa\Entity\Empresa")->findAll();
          $listavagas = $em1->getRepository("Vaga\Entity\Vaga")->findAll();
          $listaAlunos = $em1->getRepository("Aluno\Entity\Aluno")->findAll();
          
          return new ViewModel([
              'listaEmpresa'=>$lista,
              'vagas'=>$listavagas,
              'listaAluno'=>$listaAlunos]);
      }
      //Lançar contratos
      public function lancarcontratosAction(){
        $request = $this->getRequest();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idvagaEncaminhamento = $this->params()->fromRoute("idVaga", 0);
        $idaluno = $this->params()->fromRoute("id", 0);
        $aluno = new \Aluno\Entity\Aluno();
        $aluno->setIdaluno($idaluno);
        $encaminhamento = new Encaminhamento();
        $encaminhamento ->setIdvagaEncaminhamento($idvagaEncaminhamento);
        $listaContratos = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdvagaEncaminhamento($encaminhamento->getIdvagaEncaminhamento());   
        
        if ($request->isPost()){   
            
            try {
                $inicio = $request->getPost("inicio");
                $fim = $request->getPost("fim");
                $relatorio = $request->getPost("relatorio");
                $entregue = $request->getPost("entregue");
                    $encaminhamento ->setIdvagaEncaminhamento($idvagaEncaminhamento);
                    $encaminhamento ->setInicio(new \DateTime($inicio));
                    $encaminhamento->setFim(new \DateTime($fim));
                    $encaminhamento->setRelatorio($relatorio);
                    $encaminhamento->setEntregue($entregue);
                    $encaminhamento->setIdalunoEncaminhamento($aluno->getIdaluno());
                    $em->persist($encaminhamento);
                    $em->flush();
                    
            } catch (Exception $ex) {
                
            }
        return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'lancarcontratos','id'=>$aluno->getIdaluno(), 'idVaga'=>$encaminhamento->getIdvagaEncaminhamento()));  
        }     
          return new ViewModel([
            'listaContratos'=>$listaContratos,
              'aluno'=>$idaluno
        ]);
    }
     //excluir contratos
     public function excluirAction()
      {
          $id = $this->params()->fromRoute("iddelete", 0);
          $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
          $encaminhamento = $em->find("Vaga\Entity\Encaminhamento", $id);
          $em->remove($encaminhamento);
          $em->flush();
          
          return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'lancarcontratos','id'=>$encaminhamento->getidalunoEncaminhamento(), 'idVaga'=>$encaminhamento->getIdvagaEncaminhamento()));       
      }
      
      //Excluir Vaga
       public function excluirvagaAction()
      { 
           $id = $this->params()->fromRoute("iddelete", 0);
           $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
          
           $vaga = $em->find("Vaga\Entity\Vaga", $id);
           $em->remove($vaga);
           $em->flush();
                   
          return $this->redirect()->toRoute('perfil/default', 
                  array('controller' => 'index', 'action' => 'perfil', 'id'=>$vaga->getIdalunovaga()));
       
      }
      
}

