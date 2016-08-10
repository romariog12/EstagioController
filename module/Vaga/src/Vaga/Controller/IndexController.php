<?php

namespace Vaga\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vaga\Entity\Vaga;
use Vaga\Entity\Encaminhamento;
class IndexController extends AbstractActionController
{
    public function indexAction(){
        $this->sairAction();
       $request = $this->getRequest();
       $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
       $idalunovaga = $this->params()->fromRoute("id", 0);
        if($request->isPost()){    
            try {
                $empresa = $request->getPost('emrpesa');
                $agente = $request->getPost('agente');
                $carga = $request->getPost('carga');
                $bolsa = $request->getPost('bolsa') ;
                $cursoVaga = $request->getPost('curso') ;
                    $vaga = new Vaga();
                    $vaga->setIdalunovaga($idalunovaga);
                    $vaga->setEmpresa($empresa);
                    $vaga->setAgente($agente);
                    $vaga->setCarga($carga);
                    $vaga->setBolsa($bolsa);
                    $vaga->setRecisao('');
                    $vaga->setCursoVaga($cursoVaga);
                    $vaga->setMesVaga(date('m'));
                    $vaga->setAnoVaga(date('Y'));
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
          $listaAgente = $em->getRepository("Empresa\Entity\Agente")->findAll();
          return new ViewModel([
              'listaEmpresa'=>$lista,
              'vagas'=>$listavagas,
              'listaAluno'=>$listaAlunos,
              'idaluno'=>$idalunovaga,
              'listaAgente'=>$listaAgente
              ]);
      }
      //Lançar contratos
    public function lancarcontratosAction(){
        $this->sairAction();
        $request = $this->getRequest();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idvagaEncaminhamento = $this->params()->fromRoute("idVaga", 0);
        $idaluno = $this->params()->fromRoute("id", 0);
        $aluno = new \Aluno\Entity\Aluno();
        $aluno->setIdaluno($idaluno);
        $encaminhamento = new Encaminhamento();
        $encaminhamento ->setIdvagaEncaminhamento($idvagaEncaminhamento);
        $listaContratos = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdvagaEncaminhamento($encaminhamento->getIdvagaEncaminhamento());   
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdvaga($idvagaEncaminhamento);
        if ($request->isPost()){ 
            $data = $this->params()->fromPost();
            if ($data['lançar']=='Lançar'){
             
                
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

                    } catch (Exception $ex) {}
                return $this->redirect()->toRoute('vaga/default',array('controller' => 'index', 'action' => 'lancarcontratos','id'=>$aluno->getIdaluno(), 'idVaga'=>$encaminhamento->getIdvagaEncaminhamento()));  
            }      
            if ($data['salvar']=='Salvar'){
                    $recisao = $request->getPost("recisao");
                    $select = $em->find("Vaga\Entity\Vaga", $idvagaEncaminhamento);
                    $select->setRecisao($recisao);
                    $em->persist($select);
                    $em->flush();
                    $this->redirect()->toRoute('perfil/default', 
                    array('controller' => 'index', 'action' => 'perfil', 'id'=>$aluno->getIdaluno()));         
            }
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
     //Editar contratos
     public function editarContratosAction(){ 
         $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
         $idEncaminhamento = $this->params()->fromRoute("id", 0);
         $idVaga =  $this->params()->fromRoute("idVaga", 0);
          $listaContratos = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdencaminhamento($idEncaminhamento);
          $request = $this->getRequest();
          
          if ($request->isPost()){
              $select = $em->find("Vaga\Entity\Encaminhamento", $idEncaminhamento);
                    $inicio = $request->getPost("inicioEnc");
                    $fim = $request->getPost("fimEnc");
                    $relatorio = $request->getPost("relatorio");
                    $entregue = $request->getPost("entregue");
                    
          
                    try { 
                        $select ->setInicio(new \DateTime($inicio));
                        $select->setFim(new \DateTime($fim));  
                        $select->setRelatorio($relatorio);
                        $select->setEntregue($entregue);
                        $em->persist($select);
                        $em->flush();

                    } catch (Exception $ex) {}
                return $this->redirect()->toRoute('vaga/default',array('controller' => 'index', 'action' => 'lancarcontratos','id'=>42, 'idVaga'=>$idVaga));  
                    
              
          }
                
        return new ViewModel([
            'listaContratos' =>$listaContratos
        ]);
    }
    public function infoAction(){
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga($curso);
     
        return new ViewModel(
                array(
               
                    'listaVaga'=>$listaVaga,
                    'mensagem'=>$menstagem=  '<p class="navbar-brand" style="color: red">Nenhuma dado encontrado!</p>'
                )
                );
    }

}

