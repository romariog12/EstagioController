<?php

namespace Vaga\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vaga\Entity\VagaPresencial;
use Vaga\Entity\DocumentoPresencial;

class VagaPresencialController extends AbstractActionController
{
    public function cadastrarVagaPresencialAction(){
        $this->sairComumAction();
       $request = $this->getRequest();
       $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
       $listaDados = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
       $idalunovaga = $this->params()->fromRoute("id", 0);
        if($request->isPost()){ 
            foreach ($this->session()->comum as $l){
                       $usuarioIdusuario = $l[0]->getIdusuario();
                    }
            try {
                $empresa = $request->getPost('emrpesa');
                $agente = $request->getPost('agente');
                $carga = $request->getPost('carga');
                $bolsa = $request->getPost('bolsa') ;
                $inicio = $request->getPost('inicio');
                $cursoVaga = $request->getPost('curso') ;
                    $vagaPresencial = new VagaPresencial();
                    $vagaPresencial->setIdalunovaga($idalunovaga);
                    $vagaPresencial->setEmpresa($empresa);
                    $vagaPresencial->setAgente($agente);
                    $vagaPresencial->setCarga($carga);
                    $vagaPresencial->setBolsa($bolsa);
                    $vagaPresencial->setInicio(new \DateTime($inicio));
                    $vagaPresencial->setRecisao('');
                    $vagaPresencial->setCursoVaga($cursoVaga);
                    $vagaPresencial->setMesVaga(date('m'));
                    $vagaPresencial->setAnoVaga(date('Y'));
                    $vagaPresencial->setUsuarioIdusuario($usuarioIdusuario);
                $em->persist($vagaPresencial);
                $em->flush();                  
                return $this->redirect()->toRoute('perfilPresencial/default', 
                  array('controller' => 'alunoPresencial', 'action' => 'perfil', 'id'=>$vagaPresencial->getIdalunovaga(), 'idVaga'=>$vagaPresencial->getIdvaga()));
              }
           catch (Exception $ex) {
               echo $this->flashMessenger()->render();
            }    
        }  
          $lista = $em->getRepository("Administrador\Entity\Empresa")->findAll();
          $listavagas = $em->getRepository("Vaga\Entity\VagaPresencial")->findAll();
          $listaAlunos = $em->getRepository("Administrador\Entity\Aluno")->findAll();
          $listaAgente = $em->getRepository("Administrador\Entity\Agente")->findAll();
          return new ViewModel([
              'listaEmpresa'=>$lista,
              'vagas'=>$listavagas,
              'listaAluno'=>$listaAlunos,
              'idaluno'=>$idalunovaga,
              'listaAgente'=>$listaAgente,
              'listaDados' => $listaDados
              ]);
      }
      //Lançar contratos
    public function lancarcontratosAction(){
        $this->sairComumAction();
        $request = $this->getRequest();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idvagaDocumento = $this->params()->fromRoute("idVaga", 0);
        $idaluno = $this->params()->fromRoute("id", 0);
        $curso = $this->params()->fromRoute("curso", 0);
        $aluno = new \Administrador\Entity\AlunoPresencial();
        $aluno->setIdaluno($idaluno);
        $documento = new DocumentoPresencial();
        $documento ->setIdvagaDocumento($idvagaDocumento);
        $listaContratos = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByIdvagaDocumento($documento->getIdvagaDocumento());   
        $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdvaga($idvagaDocumento);
        if ($request->isPost()){ 
            $data = $this->params()->fromPost();
            if ($data['lançar']=='Lançar'){
                    $inicio = $request->getPost("inicioEnc");
                    $fim = $request->getPost("fimEnc");
                    $relatorio = $request->getPost("relatorio");
                    $entregue = $request->getPost("entregue");
       
                    try { 
                        $documento ->setIdvagaDocumento($idvagaDocumento);
                        $documento ->setInicio($inicio);
                        $documento->setFim($fim);  
                        $documento->setRelatorio($relatorio);
                        $documento->setEntregue($entregue);
                        $documento->setIdalunoDocumento($aluno->getIdaluno());
                        $documento->setAnoDocumento(date('Y'));
                        $documento->setMesDocumento(date('m'));
                        $documento ->setCursoDocumento($curso);
                        $em->persist($documento);
                        $em->flush();

                    } catch (Exception $ex) {}
                return $this->redirect()->toRoute('vaga/default',array('controller' => 'vagapresencial', 'action' => 'lancarcontratos','id'=>$aluno->getIdaluno(), 'idVaga'=>$documento->getIdvagaDocumento(), 'curso'=>$documento->getCursoDocumento() ));  
            }      
            if ($data['salvar']=='Salvar'){
                    $recisao = $request->getPost("recisao");
                    $select = $em->find("Vaga\Entity\VagaPresencial", $idvagaDocumento);
                    $select->setRecisao($recisao);
                    $em->persist($select);
                    $em->flush();
                    $this->redirect()->toRoute('perfilPresencial/default', 
                    array('controller' => 'alunopresencial', 'action' => 'perfil', 'id'=>$aluno->getIdaluno()));         
            }
            if ($data['editar']=='Editar'){
                    $idDocumento = $request->getPost("idDocumento");
                    $inicio = $request->getPost("inicioEnc");
                    $fim = $request->getPost("fimEnc");
                    $relatorio = $request->getPost("relatorio");
                    $entregue = $request->getPost("entregue");
                    
                    $select = $em->find("Vaga\Entity\DocumentoPresencial", $idDocumento);
                   
                        $select ->setInicio($inicio);
                        $select->setFim($fim);  
                        $select->setRelatorio($relatorio);
                        $select->setEntregue($entregue);
                    
                    
                    $em->persist($select);
                    $em->flush();
                    $this->redirect()->toRoute('vaga/default',array('controller' => 'vagapresencial', 'action' => 'lancarcontratos','id'=>$aluno->getIdaluno(), 'idVaga'=>$documento->getIdvagaDocumento()));         
            }
            }     
          return new ViewModel([
            'listaContratos'=>$listaContratos,
            'aluno'=>$idaluno,
            'listaVaga'=>$listaVaga,
            
        ]);
    }
     
    //excluir contratos
    public function excluirAction(){
            $this->sairComumAction();
            $id = $this->params()->fromRoute("iddelete", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $documento = $em->find("Vaga\Entity\DocumentoPresencial", $id);
            $em->remove($documento);
            $em->flush();
          
        return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'vagapresencial', 'action' => 'lancarcontratos','id'=>$documento->getIdalunoDocumento(), 'idVaga'=>$documento->getIdvagaDocumento(),'curso'=>$documento->getcursoDocumento()));       
    }
      
      //Excluir Vaga
    public function excluirvagaAction(){
            $this->sairComumAction();
            $id = $this->params()->fromRoute("iddelete", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $vaga = $em->find("Vaga\Entity\VagaPresencial", $id);
            $em->remove($vaga);
            $em->flush();        
        return $this->redirect()->toRoute('perfilPresencial/default', 
                  array('controller' => 'alunoPresencial', 'action' => 'perfil', 'id'=>$vaga->getIdalunovaga()));
     }
     //Editar contratos
     public function editarContratosAction(){
         $this->sairComumAction();
         $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
         $idDocumento = $this->params()->fromRoute("id", 0);
         $idVaga =  $this->params()->fromRoute("idVaga", 0);
          $listaContratos = $em->getRepository("Vaga\Entity\Documento")->findByIddocumento($idDocumento);
          $request = $this->getRequest();
          
          if ($request->isPost()){
              $select = $em->find("Vaga\Entity\Docuemtno", $idDocumento);
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
                return $this->redirect()->toRoute('vaga/default',array('controller' => 'VagaPresencial', 'action' => 'lancarcontratos','id'=>42, 'idVaga'=>$idVaga));  
                    
              
          }
                
        return new ViewModel([
            'listaContratos' =>$listaContratos
        ]);
    }
    

}

