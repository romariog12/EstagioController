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
       $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
       $idalunovaga = $this->params()->fromRoute("id", 0);
        if($request->isPost()){    
            try {
                $empresa = $request->getPost('emrpesa');
                $agente = $request->getPost('agente');
                $carga = $request->getPost('carga');
                $bolsa = $request->getPost('bolsa') ;  
                    $vaga = new Vaga();
                    $vaga->setIdalunovaga($idalunovaga);
                    $vaga->setEmpresa($empresa);
                    $vaga->setAgente($agente);
                    $vaga->setCarga($carga);
                    $vaga->setBolsa($bolsa);
                    $vaga->setRecisao('-');
                $em->persist($vaga);
                $em->flush();                  
                return $this->redirect()->toRoute('perfil/default', 
                  array('controller' => 'index', 'action' => 'perfil', 'id'=>$vaga->getIdalunovaga(), 'idVaga'=>$vaga->getIdvaga()));
              }
           catch (Exception $ex) {
               echo $this->flashMessenger()->render();
            }    
        }  
          $lista = $em->getRepository("Empresa\Entity\Empresa")->findAll();
          $listavagas = $em->getRepository("Vaga\Entity\Vaga")->findAll();
          $listaAlunos = $em->getRepository("Aluno\Entity\Aluno")->findAll(); 
          return new ViewModel([
              'listaEmpresa'=>$lista,
              'vagas'=>$listavagas,
              'listaAluno'=>$listaAlunos,
              'idaluno'=>$idalunovaga]);
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
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdalunovaga($idaluno);
        if ($request->isPost()){ 
          
            $data = $this->params()->fromPost();
            if ($data['salvar']=='Salvar'):
            $recisao = $request->getPost("recisao");

            $select = $em->find("Vaga\Entity\Vaga", $idvagaEncaminhamento);
            $select->setRecisao($recisao);
                $em->persist($select);
                $em->flush();
                $this->redirect()->toRoute('perfil/default', 
                  array('controller' => 'index', 'action' => 'perfil', 'id'=>$aluno->getIdaluno()));
            endif;
           
            if ($data['lancar']=='Lançar'):
                $inicio = $request->getPost("inicioEnc");
                $fim = $request->getPost("fimEnc");
                $relatorio = $request->getPost("relatorio");
                $entregue = $request->getPost("entregue");
          
                try { 
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
    endif;
        
            }     
          return new ViewModel([
            'listaContratos'=>$listaContratos,
              'aluno'=>$idaluno,
              'listaVaga'=>$listaVaga
        ]);
    }
     //excluir contratos
    public function excluirAction(){
          $id = $this->params()->fromRoute("iddelete", 0);
          $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
          $encaminhamento = $em->find("Vaga\Entity\Encaminhamento", $id);
          $em->remove($encaminhamento);
          $em->flush();
          
          return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'lancarcontratos','id'=>$encaminhamento->getidalunoEncaminhamento(), 'idVaga'=>$encaminhamento->getIdvagaEncaminhamento()));       
    }
      
      //Excluir Vaga
    public function excluirvagaAction(){ 
           $id = $this->params()->fromRoute("iddelete", 0);
           $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
           $vaga = $em->find("Vaga\Entity\Vaga", $id);
           $em->remove($vaga);
           $em->flush();        
          return $this->redirect()->toRoute('perfil/default', 
                  array('controller' => 'index', 'action' => 'perfil', 'id'=>$vaga->getIdalunovaga()));
     }

}

