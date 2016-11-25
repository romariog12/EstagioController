<?php

namespace Vaga\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vaga\Entity\Vaga;
use Vaga\Entity\Encaminhamento;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
class IndexController extends AbstractActionController
{
    public function indexAction(){
         $this->sairComumAction();
       $request = $this->getRequest();
       $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
       $listaDados = $em->getRepository("Base\Entity\Dados")->findAll();
       $idalunovaga = $this->params()->fromRoute("id", 0);
       $aluno = $em->getRepository("Aluno\Entity\Aluno")->findByIdaluno($idalunovaga);
        if($request->isPost()){  
            foreach ($this->session()->comum as $l){
                       $usuarioIdusuario = $l[0]->getIdusuario();
                    }
            try {
                $nomeAluno = $request->getPost('aluno');
                $empresa = $request->getPost('emrpesa');
                $agente = $request->getPost('agente');
                $carga = $request->getPost('carga');
                $bolsa = $request->getPost('bolsa') ;
                $inicio = $request->getPost('inicio');
                $cursoVaga = $request->getPost('curso') ;
                    $vaga = new Vaga();
                    $vaga->setIdalunovaga($idalunovaga);
                    $vaga->setAluno($nomeAluno);
                    $vaga->setEmpresa($empresa);
                    $vaga->setAgente($agente);
                    $vaga->setCarga($carga);
                    $vaga->setBolsa($bolsa);
                    $vaga->setInicio(new \DateTime($inicio));
                    $vaga->setRecisao('');
                    $vaga->setCursoVaga($cursoVaga);
                    $vaga->setMesVaga(date('m'));
                    $vaga->setAnoVaga(date('Y'));
                    $vaga->setUsuarioIdusuario($usuarioIdusuario);
                $em->persist($vaga);
                $em->flush();                  
                return $this->redirect()->toRoute('perfil/default', 
                  array('controller' => 'index', 'action' => 'perfil', 'id'=>$vaga->getIdalunovaga(), 'idVaga'=>$vaga->getIdvaga()));
              }
           catch (Exception $ex) {
               echo $this->flashMessenger()->render();
            }    
        }  
          $lista = $em->getRepository("Administrador\Entity\Empresa")->findAll();
          $listavagas = $em->getRepository("Vaga\Entity\Vaga")->findAll();
          $listaAlunos = $em->getRepository("Aluno\Entity\Aluno")->findAll();
          $listaAgente = $em->getRepository("Administrador\Entity\Agente")->findAll();
          return new ViewModel([
              'listaEmpresa'=>$lista,
              'vagas'=>$listavagas,
              'listaAluno'=>$listaAlunos,
              'idaluno'=>$idalunovaga,
              'listaAgente'=>$listaAgente,
              'aluno' => $aluno,
               'listaDados' => $listaDados,
              ]);
      }
      //Lançar contratos
    public function lancarcontratosAction(){
         $this->sairComumAction();
        $request = $this->getRequest();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idvagaEncaminhamento = $this->params()->fromRoute("idVaga", 0);
        $idaluno = $this->params()->fromRoute("id", 0);
        $curso = $this->params()->fromRoute("curso", 0);
        $aluno = new \Aluno\Entity\Aluno();
        $aluno->setIdaluno($idaluno);
        $encaminhamento = new Encaminhamento();
        $encaminhamento ->setIdvagaEncaminhamento($idvagaEncaminhamento);
        $listaContratos = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdvagaEncaminhamento($encaminhamento->getIdvagaEncaminhamento());   
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdvaga($idvagaEncaminhamento);
          foreach ($listaVaga as $l){
                        $idUsuario =  $l->getUsuarioIdusuario();
                        $usuario = $em->getRepository("Administrador\Entity\Usuario")->findByIdusuario($idUsuario);
                                
                                
        ;}
        if ($request->isPost()){ 
            $data = $this->params()->fromPost();
            if ($data['lançar']=='Lançar'){
                    $inicio = $request->getPost("inicioEnc");
                    $fim = $request->getPost("fimEnc");
                    $relatorio = $request->getPost("relatorio");
                    $entregue = $request->getPost("entregue");
       
                    try { 
                        $encaminhamento ->setIdvagaEncaminhamento($idvagaEncaminhamento);
                        $encaminhamento ->setInicio($inicio);
                        $encaminhamento->setFim($fim);  
                        $encaminhamento->setRelatorio($relatorio);
                        $encaminhamento->setEntregue($entregue);
                        $encaminhamento->setIdalunoEncaminhamento($aluno->getIdaluno());
                        $encaminhamento->setAnoDocumento(date('Y'));
                        $encaminhamento->setMesDocumento(date('m'));
                        $encaminhamento ->setCursoDocumento($curso);
                        $em->persist($encaminhamento);
                        $em->flush();

                    } catch (Exception $ex) {}
                return $this->redirect()->toRoute('vaga/default',array('controller' => 'index', 'action' => 'lancarcontratos','id'=>$aluno->getIdaluno(), 'idVaga'=>$encaminhamento->getIdvagaEncaminhamento(), 'curso'=>$encaminhamento->getCursoDocumento() ));  
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
            if ($data['editar']=='Editar'){
                    $idEncaminhamento = $request->getPost("idEncaminhamento");
                    $inicio = $request->getPost("inicioEnc");
                    $fim = $request->getPost("fimEnc");
                    $relatorio = $request->getPost("relatorio");
                    $entregue = $request->getPost("entregue");
                    
                    $select = $em->find("Vaga\Entity\Encaminhamento", $idEncaminhamento);
                   
                        $select ->setInicio($inicio);
                        $select->setFim($fim);  
                        $select->setRelatorio($relatorio);
                        $select->setEntregue($entregue);
                    
                    
                    $em->persist($select);
                    $em->flush();
                    $this->redirect()->toRoute('vaga/default',array('controller' => 'index', 'action' => 'lancarcontratos','id'=>$aluno->getIdaluno(), 'idVaga'=>$encaminhamento->getIdvagaEncaminhamento()));         
            }
            }     
          return new ViewModel([
            'listaContratos'=>$listaContratos,
            'aluno'=>$idaluno,
            'listaVaga'=>$listaVaga,
              'usuario'=> $usuario
            
        ]);
    }
     
    //excluir contratos
    public function excluirAction(){
            $this->sairComumAction();
            $id = $this->params()->fromRoute("iddelete", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $encaminhamento = $em->find("Vaga\Entity\Encaminhamento", $id);
            $em->remove($encaminhamento);
            $em->flush();
          
        return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'lancarcontratos','id'=>$encaminhamento->getidalunoEncaminhamento(), 'idVaga'=>$encaminhamento->getIdvagaEncaminhamento(),'curso'=>$encaminhamento->getcursoDocumento()));       
    }
      
      //Excluir Vaga
    public function excluirvagaAction(){ 
            $this->sairComumAction();
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
            $this->sairComumAction();
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

}

