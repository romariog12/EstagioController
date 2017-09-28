<?php
namespace Vaga\Controller;
    use Auth\Controller\AdministradorAbstractActionController;
    use Zend\View\Model\ViewModel;
    use Vaga\Entity\VagaPresencial;
    use Vaga\Entity\DocumentoPresencial;
    use Base\Model\Entity;
    use Vaga\Form\vagaForm;
    use Vaga\Form\LancarDocumentoForm;
    use Vaga\Form\editarDocumentoForm;
    use Vaga\Model\EditarDocumento;
    use Vaga\Form\ProcessoForm;
    use Vaga\Model\LancarDocumento;
    use Vaga\Model\Processo;
    use Vaga\Model\Vaga;
    use Aluno\Entity\AlunoPresencial;
    use Base\Model\Constantes;
    use Vaga\Form\editarAcompanhamentoForm;
    use Vaga\Model\EditarAcompanhamento;
    
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
        $listaDados = $em->getRepository(Entity::dados)->findAll();
        $idalunovaga = $this->params()->fromRoute("id", 0);
        $aluno = $em->getRepository(Entity::aluno)->findByIdaluno($idalunovaga);
        $auth = new \Zend\Authentication\AuthenticationService();
        $identidade = $auth->getIdentity();
        foreach ($identidade as $l){
            $idUsuario = $l[0]->getIdusuario();
        }
        if($request->isPost()){
            $vaga = new Vaga();
            $vagaForm->setInputFilter($vaga->getInputFilter());
            $vagaForm->setData($request->getPost());
            if($vagaForm->isValid()){
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
        }  
          $lista = $em->getRepository(Entity::empresa)->findAll();
          $listavagas = $em->getRepository(Entity::vaga)->findAll();
          $listaAlunos = $em->getRepository(Entity::aluno)->findAll();
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
        $editarDocumentoForm = new editarDocumentoForm();
        $documentoForm = new LancarDocumentoForm();
        $processoForm = new ProcessoForm();
        $request = $this->getRequest();
        $em = $this->getServiceLocator()->get(Entity::em);
                    $idvagaDocumento = $this->params()->fromRoute("idVaga", 0);
                    $idaluno = $this->params()->fromRoute("id", 0);
                    $empresa = $this->params()->fromRoute("curso", 0);
                    $aluno = new AlunoPresencial();
                    $aluno->setIdaluno($idaluno);
                    $documento = new DocumentoPresencial();
                    $documento ->setIdvagaDocumento($idvagaDocumento);
                    $listaContratos = $em->getRepository(Entity::documento)
                            ->findByIdvagaDocumento($documento->getIdvagaDocumento());   
                    $listaVaga = $em->getRepository(Entity::vaga)
                            ->findByIdvaga($idvagaDocumento);
                    $selectAluno = $em->getRepository(Entity::aluno)
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
        if($documentoForm->isValid()){
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
        } }
    return new ViewModel([
            'listaContratos'=>$listaContratos,
            'aluno'=>$idaluno,
            'listaVaga'=>$listaVaga,
            'usuario'=>$usuario,
            'selectAluno' => $selectAluno,
            'documentoForm' =>$documentoForm,
            'listaAcompanhamento' => $listaAcompanhamento,
            'processoForm' =>$processoForm,
            'editarDocumentoForm'=> $editarDocumentoForm
        ]); 
    }
    public function acompanhamentoAction(){
    $editarAcompanhamentoForm = new editarAcompanhamentoForm(); 
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get(Entity::em);
                    $idvagaDocumento = $this->params()->fromRoute("idVaga", 0);
                    $idaluno = $this->params()->fromRoute("id", 0);
                    $curso = $this->params()->fromRoute("curso", 0);
                    $documento = new DocumentoPresencial();
                    $documento ->setIdvagaDocumento($idvagaDocumento);
                    $listaContratos = $em->getRepository(Entity::documento)
                            ->findByIdvagaDocumento($documento->getIdvagaDocumento());   
                    $listaVaga = $em->getRepository(Entity::vaga)
                            ->findByIdvaga($idvagaDocumento);
                    $selectAluno = $em->getRepository(Entity::aluno)
                            ->findByIdaluno($idaluno);
                    $listaAcompanhamento = $em->getRepository(Entity::acompanhamento)
                            ->findByIdvagaacompanhamento($idvagaDocumento);         
    if ($request->isPost()){ 
        $editarAcompanhamento = new EditarAcompanhamento();
        $editarAcompanhamentoForm->setInputFilter($editarAcompanhamento->getInputFilter());
        $editarAcompanhamentoForm->setData($request->getPost());
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
            'selectAluno' => $selectAluno,
            'listaAcompanhamento' => $listaAcompanhamento,
             'editarAcompanhamentoForm'=>$editarAcompanhamentoForm
        ]); 
    }
      public function lancarContratosVagaAction(){
            $editarDocumentoForm = new editarDocumentoForm();
            $documentoForm = new LancarDocumentoForm();
            $processoForm = new ProcessoForm();
            $request = $this->getRequest();
            $em = $this->getServiceLocator()->get(Entity::em);
            $idvagaDocumento = $this->params()->fromRoute("idVaga", 0);
            $idaluno = $this->params()->fromRoute("id", 0);
            $empresa = $this->params()->fromRoute("curso", 0);
            $listaContratos = $em->getRepository(Entity::documento)->findByIdvagaDocumento($idvagaDocumento);   
            $listaVaga = $em->getRepository(Entity::vaga)->findByIdvaga($idvagaDocumento);
            $selectAluno = $em->getRepository(Entity::aluno)->findByIdaluno($idaluno);
            foreach ($listaVaga as $l){
                    $idUsuario =  $l->getUsuarioIdusuario();
                    $usuario = $em->getRepository(Entity::usuario)->findByIdusuario($idUsuario);                    
            }           
            if ($request->isPost()){ 
                $lancarDocumento = new LancarDocumento();
                $documentoForm->setInputFilter($lancarDocumento->getInputFilter());
                $documentoForm->setData($request->getPost());
                if($documentoForm->isValid()){
                    $documento = new DocumentoPresencial();
                    $inicio = $request->getPost("inicioEnc");
                    $fim = $request->getPost("fimEnc");
                    $relatorio = $request->getPost("documento");
                    $dataLancamento = date("d/m/Y G:i");
                    try { 
                        $documento ->setIdvagaDocumento($idvagaDocumento);
                        $documento ->setInicio(new \DateTime($inicio));
                        $documento->setFim(new \DateTime($fim));
                        $documento->setRelatorio($relatorio);
                        $documento->setEntregue('NULL');
                        $documento->setIdalunoDocumento($idaluno);
                        $documento->setAnoDocumento(date('Y'));
                        $documento->setMesDocumento(date('m'));
                        $documento ->setIdempresaDocumento($empresa);
                        $documento->setDataLancamento($dataLancamento);
                        $em->persist($documento);
                        $em->flush();
                    } catch (Exception $ex) {}
                return $this->redirect()->toRoute(Constantes::rotaVagaDefault, ['controller' => Constantes::vaga, 'action' => 'lancarContratosVaga', 'id'=>$idaluno, 'idVaga'=>$idvagaDocumento]);
             }
      }
       return new ViewModel([
            'listaContratos'=>$listaContratos,
            'aluno'=>$idaluno,
            'listaVaga'=>$listaVaga,
            'usuario'=>$usuario,
            'selectAluno' => $selectAluno,
            'documentoForm' =>$documentoForm,
           'processoForm' =>$processoForm,
           'editarDocumentoForm'=> $editarDocumentoForm
        ]); 
    }
    public function perfilVagaFinalizadaAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $idaluno = $this->params()->fromRoute("id", 0);
        $selectAluno = $em->getRepository(Entity::aluno)->findByIdaluno($idaluno);
        $idvagaDocumento = $this->params()->fromRoute("idVaga", 0);
        $listaVaga = $em->getRepository(Entity::vaga)->findByIdvaga($idvagaDocumento);
         return new ViewModel([
            'listaVaga'=>$listaVaga,
             'listaAluno'=>$selectAluno
        ]);    
    }
    public function excluirAction(){
            $id = $this->params()->fromRoute("iddelete", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $documento = $em->find(Entity::documento, $id);
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
        $processoForm = new ProcessoForm();
        $processo = new Processo();
        $processoForm->setInputFilter($processo->getInputFilter());
        $processoForm->setData($request->getPost());
        if($processoForm->isValid()){
            $idVagaDocumento = $request->getPost("idDocumento");
            $operacao1 = $request->getPost("operacao1");  
            $operacao2 = $request->getPost("operacao2");
            $operacao3 = $request->getPost("operacao3");
            $operacao4 = $request->getPost("operacao4");   
            $em = $this->getServiceLocator()->get(Entity::em);
            $selecionar = $em->find(Entity::documento, $idVagaDocumento);
            $selecionar
                ->setOperacao1($operacao1)
                ->setOperacao2($operacao2)
                ->setOperacao3($operacao3)
                ->setOperacao4($operacao4);
                    $em->persist($selecionar);
                    $em->flush();
        }
    }
     public function editarDocumentoAction(){
        $request = $this->getRequest();
        $inicio = $request->getPost("inicio");  
        $fim = $request->getPost("fim");
        $tipo = $request->getPost("documento");
        $idDocumento = $request->getPost("idDocumento");
        $em = $this->getServiceLocator()->get(Entity::em);
        $selecionarDocumento = $em->find(Entity::documento, $idDocumento);
        $selecionarDocumento
                ->setInicio(new \DateTime($inicio))
                ->setFim(new \DateTime($fim))
                ->setRelatorio($tipo);
        $em->persist($selecionarDocumento);
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
        $selecionar = $em->find(Entity::vaga, $idVagaDocumento);
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
        $selecionar = $em->find(Entity::documento, $idVagaDocumento);
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
            $vaga = $em->find(Entity::vaga, $id);
            $em->remove($vaga);
            $em->flush();
        return $this->redirect()->toRoute('perfilPresencial/default', 
                  array('controller' => 'alunoPresencial', 'action' => 'perfil', 'id'=>$vaga->getIdalunovaga()));
     }
}

