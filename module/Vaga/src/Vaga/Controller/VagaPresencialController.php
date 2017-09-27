<?php

namespace Vaga\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vaga\Entity\VagaPresencial;
use Vaga\Entity\DocumentoPresencial;
use Base\Model\Entity;
use Zend\View\Model\JsonModel;
class VagaPresencialController extends AbstractActionController
{
    public function __construct() {
        $this->route = 'vaga/default';
        $this->controller = 'vagapresencial';
    }

    public function cadastrarVagaPresencialAction(){
        $this->sairComumAction();
        $request = $this->getRequest();
        $em = $this->getServiceLocator()
                ->get(Entity::em);
        $listaDados = $em->getRepository(Entity::dadosPresencial)
                ->findAll();
        $idalunovaga = $this->params()
                ->fromRoute("id", 0);
        $aluno = $em->getRepository(Entity::alunoPresencial)
                ->findByIdaluno($idalunovaga);
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
                    $vagaPresencial = new VagaPresencial();
                    $vagaPresencial->setIdalunovaga($idalunovaga);
                    $vagaPresencial->setAluno($nomeAluno);
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
          $lista = $em->getRepository(Entity::empresa)->findAll();
          $listavagas = $em->getRepository(Entity::vagaPresencial)->findAll();
          $listaAlunos = $em->getRepository(Entity::alunoPresencial)->findAll();
          $listaAgente = $em->getRepository(Entity::agente)->findAll();
          return new ViewModel([
              'listaEmpresa'=>$lista,
              'vagas'=>$listavagas,
              'listaAluno'=>$listaAlunos,
              'idaluno'=>$idalunovaga,
              'listaAgente'=>$listaAgente,
              'listaDados' => $listaDados,
              'aluno' => $aluno
              ]);
      }
      //Lançar contratos
    public function lancarcontratosAction(){
        $this->sairComumAction();
        $request = $this->getRequest();
        $em = $this->getServiceLocator()->get(Entity::em);
        $idvagaDocumento = $this->params()->fromRoute("idVaga", 0);
        $idaluno = $this->params()->fromRoute("id", 0);
        $curso = $this->params()->fromRoute("curso", 0);
        $aluno = new \Aluno\Entity\AlunoPresencial();
        $aluno->setIdaluno($idaluno);
        $documento = new DocumentoPresencial();
        $documento ->setIdvagaDocumento($idvagaDocumento);
        $listaContratos = $em->getRepository(Entity::documentoPresencial)
                ->findByIdvagaDocumento($documento->getIdvagaDocumento());   
        $listaVaga = $em->getRepository(Entity::vagaPresencial)
                ->findByIdvaga($idvagaDocumento);
        $selectAluno = $em->getRepository(Entity::alunoPresencial)
                ->findByIdaluno($idaluno);
        foreach ($selectAluno as $l){
                $alunoDocumento = $l->getNome();    
            }
        foreach ($listaVaga as $l){
                        $idUsuario =  $l->getUsuarioIdusuario();
                        $usuario = $em->getRepository(Entity::usuario)->findByIdusuario($idUsuario);                    
        ;}           
        if ($request->isPost()){ 
            $data = $this->params()->fromPost();
            if ($data['lançar']=='Lançar'){
                    $inicio = $request->getPost("inicioEnc");
                    $fim = $request->getPost("fimEnc");
                    $relatorio = $request->getPost("relatorio");
                   // $entregue = $request->getPost("entregue");
       
                    try { 
                        $documento ->setIdvagaDocumento($idvagaDocumento);
                        $documento ->setInicio(new \DateTime($inicio));
                        $documento->setFim(new \DateTime($fim));
                        $documento->setOperacao1('Checked');
                        $documento->setOperacao2('Checked');
                        $documento->setOperacao3('Checked');
                        $documento->setOperacao4('Checked');
                        $documento->setRelatorio($relatorio);
                        $documento->setEntregue('NULL');
                        $documento->setIdalunoDocumento($aluno->getIdaluno());
                        $documento->setAnoDocumento(date('Y'));
                        $documento->setMesDocumento(date('m'));
                        $documento ->setCursoDocumento($curso);
                        $em->persist($documento);
                        $em->flush();

                    } catch (Exception $ex) {}
                return $this->redirect()->toRoute($this->route,array('controller' => $this->controller, 'action' => 'lancarcontratos','id'=>$aluno->getIdaluno(), 'idVaga'=>$documento->getIdvagaDocumento(), 'curso'=>$documento->getCursoDocumento() ));  
            }      
            if ($data['salvar']=='Salvar'){
                    $recisao = $request->getPost("recisao");
                    $select = $em->find(Entity::vagaPresencial, $idvagaDocumento);
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
                    $select = $em->find(Entity::documentoPresencial, $idDocumento);
                        $select ->setInicio($inicio);
                        $select->setFim($fim);  
                        $select->setRelatorio($relatorio);
                        $select->setEntregue($entregue); 
                    $em->persist($select);
                    $em->flush();
                    $this->redirect()->toRoute($this->route,array('controller' => $this->controller, 'action' => 'lancarcontratos','id'=>$aluno->getIdaluno(), 'idVaga'=>$documento->getIdvagaDocumento()));         
            }
            }
           
          return new ViewModel([
            'listaContratos'=>$listaContratos,
            'aluno'=>$idaluno,
            'listaVaga'=>$listaVaga,
            'usuario'=>$usuario,
            'selectAluno' => $selectAluno
        ]);
    }
     
    //excluir contratos
    public function excluirAction(){
            $this->sairComumAction();
            $id = $this->params()->fromRoute("iddelete", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $documento = $em->find(Entity::documentoPresencial, $id);
            $em->remove($documento);
            $em->flush();
            }
      //Excluir Vaga
    public function excluirvagaAction(){
            $this->sairComumAction();
            $id = $this->params()->fromRoute("iddelete", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $vaga = $em->find(Entity::vagaPresencial, $id);
            $em->remove($vaga);
            $em->flush();        
        return $this->redirect()->toRoute('perfilPresencial/default', 
                  array('controller' => 'alunoPresencial', 'action' => 'perfil', 'id'=>$vaga->getIdalunovaga()));
     }
     //Editar contratos
     public function editarContratosAction(){
         $this->sairComumAction();
         $em = $this->getServiceLocator()->get(Entity::em);
         $idDocumento = (int)$_POST['id'];
                $request = $this->getRequest();
                $select = $em->find(Entity::documentoPresencial, $idDocumento);
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
               
    }
    

}

