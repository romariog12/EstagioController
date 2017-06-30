<?php
namespace Vaga\Controller;

    use Auth\Controller\AdministradorAbstractActionController;
    use Zend\View\Model\ViewModel;
    use Vaga\Entity\VagaPresencial;
    use Vaga\Entity\DocumentoPresencial;
    use Base\Model\Entity;
    use Vaga\Form\vagaForm;
    use Vaga\Form\LancarDocumentoForm;
    use Vaga\Model\LancarDocumento;
    use Vaga\Model\Vaga;
    use Aluno\Entity\AlunoPresencial;
    
class VagaPresencialController extends AdministradorAbstractActionController
{
    public function __construct() {
        $this->route = 'vagaPresencial/default';
        $this->controller = 'vagapresencial'; 
    }

    public function cadastrarVagaPresencialAction(){
        $vagaForm = new vagaForm();
        $request = $this->getRequest();
        $em = $this->getServiceLocator()->get(Entity::em);
        $listaDados = $em->getRepository(Entity::dadosPresencial)->findAll();
        $idalunovaga = $this->params()->fromRoute("id", 0);
        $aluno = $em->getRepository(Entity::alunoPresencial)->findByIdaluno($idalunovaga);
        $auth = new \Zend\Authentication\AuthenticationService();
        $identidade = $auth->getIdentity();
        foreach ($identidade as $l){
            $idUsuario = $l[0]->getIdusuario();
        }
        if($request->isPost()){
            $vaga = new Vaga();
            $vagaForm->setInputFilter($vaga->getInputFilter());
            $vagaForm->setData($request->getPost());
            $vagaPresencial = new VagaPresencial();
            $nomeAluno = $request->getPost('aluno');
                $empresa = $request->getPost('empresa');
                $agente = $request->getPost('agente');
                $carga = $request->getPost('carga');
                $bolsa = $request->getPost('bolsa') ;
                $inicio = $request->getPost('inicio');
                $cursoVaga = $request->getPost('curso') ;
                $empresaSelect = $em->getRepository(Entity::empresa)->findByEmpresa($empresa);
                foreach ($empresaSelect as $l){
                    $idEmpresa = $l[0]->getIdempresa();
                }
            try {
                
                    
                    $vagaPresencial->setIdalunovaga($idalunovaga);
                    $vagaPresencial->setAluno($nomeAluno);
                    $vagaPresencial->setEmpresa($empresa);
                    $vagaPresencial->setAgente($agente);
                    $vagaPresencial->setCarga($carga);
                    $vagaPresencial->setBolsa($bolsa);
                    $vagaPresencial->setInicio($inicio);
                    $vagaPresencial->setRecisao('');
                    $vagaPresencial->setCursoVaga($cursoVaga);
                    $vagaPresencial->setMesVaga(date('m'));
                    $vagaPresencial->setAnoVaga(date('Y'));
                    $vagaPresencial->setUsuarioIdusuario($idUsuario);
                    $vagaPresencial->setIdEmpresaVaga($idEmpresa);
                    
                $em->persist($vagaPresencial);
                $em->flush();                  
                return $this->redirect()->toRoute('vagaPresencial/default', 
                  array('controller' => 'vagaPresencial', 'action' => 'lancarContratosVaga', 'id'=>$vagaPresencial->getIdalunovaga(), 'idVaga'=>$vagaPresencial->getIdvaga()));
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
              'aluno' => $aluno,
              'vagaForm'=> $vagaForm
              ]);
      }
      //Lançar contratos
    public function lancarcontratosAction(){
        $documentoForm = new LancarDocumentoForm();
        $request = $this->getRequest();
                    $em = $this->getServiceLocator()->get(Entity::em);
                    $idvagaDocumento = $this->params()->fromRoute("idVaga", 0);
                    $idaluno = $this->params()->fromRoute("id", 0);
                    $empresa = $this->params()->fromRoute("curso", 0);
                    $aluno = new AlunoPresencial();
                    $aluno->setIdaluno($idaluno);
                    $documento = new DocumentoPresencial();
                    $documento ->setIdvagaDocumento($idvagaDocumento);
                    $listaContratos = $em->getRepository(Entity::documentoPresencial)
                            ->findByIdvagaDocumento($documento->getIdvagaDocumento());   
                    $listaVaga = $em->getRepository(Entity::vagaPresencial)
                            ->findByIdvaga($idvagaDocumento);
                    $selectAluno = $em->getRepository(Entity::alunoPresencial)
                            ->findByIdaluno($idaluno);
                    $listaAcompanhamento = $em->getRepository(Entity::acompanhamento)
                            ->findByIdvagaacompanhamento($idvagaDocumento);
                    foreach ($listaVaga as $l){
                                    $idUsuario =  $l->getUsuarioIdusuario();
                                    $usuario = $em->getRepository(Entity::usuario)->findByIdusuario($idUsuario);                    
                    }           
        if ($request->isPost()){ 
            $lancarDocumento = new LancarDocumento();
            $documentoForm->setInputFilter($lancarDocumento->getInputFilter());
            $documentoForm->setData($request->getPost());
            $data = $this->params()->fromPost();
            if ($data['lançar']=='Lançar'){
                    $inicio = $request->getPost("inicioEnc");
                    $fim = $request->getPost("fimEnc");
                    $relatorio = $request->getPost("documento");
                    date_default_timezone_set('UTC');
                    $dataLancamento = date("d/m/Y G:i");  
                    try { 
                        $documento ->setIdvagaDocumento($idvagaDocumento);
                        $documento ->setInicio(new \dateTime($inicio));
                        $documento->setFim(new \DateTime($fim));
                        $documento->setRelatorio($relatorio);
                        $documento->setEntregue('NULL');
                        $documento->setIdalunoDocumento($aluno->getIdaluno());
                        $documento->setAnoDocumento(date('Y'));
                        $documento->setMesDocumento(date('m'));
                        $documento ->setIdempresaDocumento($empresa);
                        $documento ->setDataLancamento($dataLancamento);
                        $em->persist($documento);
                        $em->flush();
                    } catch (Exception $ex) {}
                return $this->redirect()->toRoute($this->route,array('controller' => $this->controller, 'action' => 'lancarcontratos','id'=>$aluno->getIdaluno(), 'idVaga'=>$documento->getIdvagaDocumento(), 'curso'=>$documento->getIdempresaDocumento()));  
            }
    } 
    return new ViewModel([
            'listaContratos'=>$listaContratos,
            'aluno'=>$idaluno,
            'listaVaga'=>$listaVaga,
            'usuario'=>$usuario,
            'selectAluno' => $selectAluno,
            'documentoForm' =>$documentoForm,
            'listaAcompanhamento' => $listaAcompanhamento
        ]); 
    }
    public function acompanhamentoAction(){
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
                    $listaAcompanhamento = $em->getRepository(Entity::acompanhamento)
                            ->findByIdvagaacompanhamento($idvagaDocumento);
                    foreach ($selectAluno as $l){
                            $alunoDocumento = $l->getNome();    
                        }
                    foreach ($listaVaga as $l){
                                    $idUsuario =  $l->getUsuarioIdusuario();
                                    $usuario = $em->getRepository(Entity::usuario)->findByIdusuario($idUsuario);                    
                    ;}           
    if ($request->isPost()){ 
        $acompanhamento = new \Vaga\Entity\Acompanhamento();
        $request = $this->getRequest();
        $em = $this->getServiceLocator()->get(Entity::em);
        try{
            $inicio = $request->getPost("inicio");           
            $fim = $request->getPost("fim");
            $periodo = $request->getPost("periodo");
            $acompanhante = $request->getPost("acompanhante");
            $dataacompanhamento = date("d/m/Y G:i");
            $acompanhamento->setInicio($inicio)
                ->setFim($fim)
                ->setPeriodo($periodo)
                ->setAcompanhante($acompanhante)
                ->setAnoacompanhamento(date("Y"))
                ->setMesacompanhamento(date("m"))
                ->setIdalunoacompanhamento($idaluno)
                ->setIdvagaacompanhamento($idvagaDocumento)
                ->setDataacompanhamento($dataacompanhamento);
            $em->persist($acompanhamento);
            $em->flush(); 
        } catch (Exception $ex) {

         }
         return $this->redirect()->toRoute($this->route,  ['controller' => $this->controller, 'action' => 'acompanhamento','id'=>$idaluno, 'idVaga'=>$idvagaDocumento, 'curso'=>$curso]);  
            
         }
         return new ViewModel([
            'listaContratos'=>$listaContratos,
            'aluno'=>$idaluno,
            'listaVaga'=>$listaVaga,
            'usuario'=>$usuario,
            'selectAluno' => $selectAluno,
            'listaAcompanhamento' => $listaAcompanhamento
        ]); 
    }
      public function lancarContratosVagaAction(){
        $documentoForm = new LancarDocumentoForm();
        $request = $this->getRequest();
                    $em = $this->getServiceLocator()->get(Entity::em);
                    $idvagaDocumento = $this->params()->fromRoute("idVaga", 0);
                    $idaluno = $this->params()->fromRoute("id", 0);
                    $empresa = $this->params()->fromRoute("curso", 0);
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
            $lancarDocumento = new LancarDocumento();
            $documentoForm->setInputFilter($lancarDocumento->getInputFilter());
            $documentoForm->setData($request->getPost());
            $data = $this->params()->fromPost();
            if ($data['lançar']=='Lançar'){
                    $inicio = $request->getPost("inicioEnc");
                    $fim = $request->getPost("fimEnc");
                    $relatorio = $request->getPost("documento");
                   // $entregue = $request->getPost("entregue");
                    $dataLancamento = date("d/m/Y G:i");
                    try { 
                        $documento ->setIdvagaDocumento($idvagaDocumento);
                        $documento ->setInicio(new \DateTime($inicio));
                        $documento->setFim(new \DateTime($fim));
                        $documento->setRelatorio($relatorio);
                        $documento->setEntregue('NULL');
                        $documento->setIdalunoDocumento($aluno->getIdaluno());
                        $documento->setAnoDocumento(date('Y'));
                        $documento->setMesDocumento(date('m'));
                        $documento ->setIdempresaDocumento($empresa);
                        $documento->setDataLancamento($dataLancamento);
                        $em->persist($documento);
                        $em->flush();

                    } catch (Exception $ex) {}
                 return $this->redirect()->toRoute('vagaPresencial/default', 
                  array('controller' => 'vagaPresencial', 'action' => 'lancarContratosVaga', 'id'=>$idaluno, 'idVaga'=>$idvagaDocumento));
              }
           
      }
       return new ViewModel([
            'listaContratos'=>$listaContratos,
            'aluno'=>$idaluno,
            'listaVaga'=>$listaVaga,
            'usuario'=>$usuario,
            'selectAluno' => $selectAluno,
            'documentoForm' =>$documentoForm
        ]); 
    }
    public function perfilVagaFinalizadaAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $idaluno = $this->params()->fromRoute("id", 0);
        $selectAluno = $em->getRepository(Entity::alunoPresencial)->findByIdaluno($idaluno);
        $idvagaDocumento = $this->params()->fromRoute("idVaga", 0);
        $listaVaga = $em->getRepository(Entity::vagaPresencial)
                            ->findByIdvaga($idvagaDocumento);
         return new ViewModel([
            'listaVaga'=>$listaVaga,
             'listaAluno'=>$selectAluno
        ]);    
    }
    public function excluirAction(){
            $id = $this->params()->fromRoute("iddelete", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $documento = $em->find(Entity::documentoPresencial, $id);
            $em->remove($documento);
            $em->flush();
            
            }
    public function excluirAcompanhamentoAction(){
    $em = $this->getServiceLocator()->get(Entity::em);
    $request = $this->getRequest();
    $id = $request->getPost("idDocumento");
    $acompanhamento = $em->find(Entity::acompanhamento, $id);
    $em->remove($acompanhamento);
    $em->flush();

    }
    public function salvarDocumentoAction(){
        
        $request = $this->getRequest();
          $idVagaDocumento = $request->getPost("idDocumento");
          $operacao1 = $request->getPost("operacao1");  
          $operacao2 = $request->getPost("operacao2");
          $operacao3 = $request->getPost("operacao3");
          $operacao4 = $request->getPost("operacao4");   
        $em = $this->getServiceLocator()->get(Entity::em);
        $selecionar = $em->find(Entity::documentoPresencial, $idVagaDocumento);
        $selecionar
                ->setOperacao1($operacao1)
                ->setOperacao2($operacao2)
                ->setOperacao3($operacao3)
                ->setOperacao4($operacao4);
                    $em->persist($selecionar);
                    $em->flush();
    }
     public function editarDocumentoAction(){
        $request = $this->getRequest();
          $inicio = $request->getPost("inicio");  
          $fim = $request->getPost("fim");
          $tipo = $request->getPost("tipo");
          $idVagaDocumento = $request->getPost("idDocumento");
        $em = $this->getServiceLocator()->get(Entity::em);
        $selecionar = $em->find(Entity::documentoPresencial, $idVagaDocumento);
        $selecionar
                ->setInicio(new \DateTime($inicio))
                ->setFim(new \DateTime($fim))
                ->setRelatorio($tipo);
                    $em->persist($selecionar);
                    $em->flush();
    }
     public function editarAcompanhamentoAction(){
        
        $request = $this->getRequest();
            $inicioAcompanhamento = $request->getPost("inicio");  
            $fimAcompanhamento = $request->getPost("fim");
            $relatorioAcompanhamento = $request->getPost("relatorioAcompanhamento");
            $acompanhante = $request->getPost("acompanhante");
            $idVagaAcompanhamento =  $request->getPost("idDocumento");
            $em = $this->getServiceLocator()->get(Entity::em);
            $selecionar = $em->find(Entity::acompanhamento, $idVagaAcompanhamento);
            $selecionar
                ->setInicio($inicioAcompanhamento)
                ->setFim($fimAcompanhamento)
                ->setPeriodo($relatorioAcompanhamento)
                ->setAcompanhante($acompanhante);
                    $em->persist($selecionar);
                    $em->flush();
    }
    public function recisaoAction(){
        
        $request = $this->getRequest();
          $inicio = $request->getPost("inicioRecisao");  
          $fim = $request->getPost("fimRecisao");
          $idVagaDocumento =  $request->getPost("idDocumento");
        $em = $this->getServiceLocator()->get(Entity::em);
        $selecionar = $em->find(Entity::vagaPresencial, $idVagaDocumento);
            if($fim == ''){
                $situação = '1';
            }else{
                $situação = '0';
            }
        $selecionar
                ->setInicio($inicio)
                ->setRecisao($fim)
                ->setSituacao($situação);
                    $em->persist($selecionar);
                    $em->flush(); 
    }           
    public function salvarDocumentoRelatorioAction(){
        $idVagaDocumento = $this->params()->fromRoute('idDocumento',0);
        $request = $this->getRequest();
          $operacao1 = $request->getPost("relatorio1");  
          $operacao2 = $request->getPost("relatorio2");
          $operacao3 = $request->getPost("relatorio3");
          $operacao4 = $request->getPost("relatorio4");   
        $em = $this->getServiceLocator()->get(Entity::em);
        $selecionar = $em->find(Entity::documentoPresencial, $idVagaDocumento);
        $selecionar
                ->setRelatorio1($operacao1)
                ->setRelatorio2($operacao2)
                ->setRelatorio3($operacao3)
                ->setRelatorio4($operacao4);
                    $em->persist($selecionar);
                    $em->flush();
    }
  
      //Excluir Vaga
    public function excluirvagaAction(){
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

