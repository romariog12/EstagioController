<?php
namespace Empresa\Controller;

use Auth\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
use Empresa\Entity\Empresa;
use Base\Model\Entity;
use Zend\Authentication\AuthenticationService;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Vaga\Form\LancarDocumentoForm;


class EmpresaController extends AdministradorAbstractActionController{
    function __construct() {
        $this->itemPorPagina = '5';
    }
    public function cadastrarEmpresaAction(){
                $request = $this->getRequest();
                $em = $this->getServiceLocator()->get(Entity::em);
              if ($request->isPost()){
                    $nomeEmpresa = $request->getPost("empresa");
                    $cnpj = $request->getPost("cnpj");
                    $telefone = $request->getPost("telefone");
                    $endereco = $request->getPost("endereco");
                    $responsavel = $request->getPost("responsavel");
                    $email = $request->getPost("email");
                    $senha = $request->getPost("senha");
                    $selectEmpresa = $em->getRepository(Entity::empresa)->findByEmpresa($nomeEmpresa);
                    $selectCnpj = $em->getRepository(Entity::empresa)->findByCnpj($cnpj);
                    if(count($selectEmpresa)>=1){
                        return new ViewModel([
                              'alerta'=> "Empresa já cadastrada" 
                          ]);
                        return false;
                    }
                    if(count($selectCnpj)>=1){
                        return new ViewModel([
                              'alerta'=> "CNPJ já cadastrado" 
                          ]);
                        return false;
                    }
                    $empresa = new Empresa();
                try {
                    $empresa ->setEmpresa($nomeEmpresa);
                    $empresa ->setCnpj($cnpj);
                    $empresa ->setTelefone($telefone);
                    $empresa ->setEndereco($endereco);
                    $empresa ->setResponsavel($responsavel);
                    $empresa ->setEmail($email);
                    $empresa ->setSenha($senha);
                      $em->persist($empresa);
                      $em->flush();

                  } catch (Exception $ex) {
                      echo $this->flashMessenger()->render();     
                  }

                return $this->redirect()->toRoute('authEmpresa');

                  }
    } 
    public function painelEmpresaAction(){
            $auth = new AuthenticationService();
            $identidade = $auth->getIdentity();
            $em = $this->getServiceLocator()->get(Entity::em);  
            foreach ($identidade as $l){
                $idEmpresa = $l[0]->getidEmpresa();
            } 
            $vencimento1 = new \DateTime(date('Y-m-d'));
            $vencimento2 = new \DateTime(date('Y-m-d').'+1 days');
            $vencimento3 = new \DateTime(date('Y-m-d').'+2 days');
            $vencimento4 = new \DateTime(date('Y-m-d').'+3 days');
            $vencimento5 = new \DateTime(date('Y-m-d').'+4 days');
            $listaContratosVencendo = $em->getRepository(Entity::documento)->findByFimAndIdEmpresa($vencimento1,$vencimento2, $vencimento3, $vencimento4, $vencimento5,$idEmpresa);    
            $listaVagaEstagiando = $em->getRepository(Entity::vaga)->findByRecisaoAndIdEmpresaVaga('',$idEmpresa);
            $perfilEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idEmpresa);
            $vagas = $em->getRepository(Entity::vaga)->findByIdEmpresaVaga($idEmpresa);
            $page = $this->params()->fromRoute("id", 0);
                $pagination = new Paginator( new ArrayAdapter($vagas));
                $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->itemPorPagina);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
            return new ViewModel([
                'listaContratosVencendo' => $listaContratosVencendo,
                'identidade' => $perfilEmpresa,
                'vagas' => $vagas,
                'getPages'=>$getPages,
                'pageNumber'=>$pageNumber,
                'count'=>$count,
                'pagination'=>$pagination,
                'listaVagaEstagiando'=>$listaVagaEstagiando
            ]);
        }

    public function painelEmpresaEstagiandoAction(){
            $auth = new AuthenticationService();
            $identidade = $auth->getIdentity();
            foreach ($identidade as $l){
                $idEmpresa = $l[0]->getidEmpresa();
            }
            $em = $this->getServiceLocator()->get(Entity::em);
            $vencimento1 = new \DateTime(date('Y-m-d'));
            $vencimento2 = new \DateTime(date('Y-m-d').'+1 days');
            $vencimento3 = new \DateTime(date('Y-m-d').'+2 days');
            $vencimento4 = new \DateTime(date('Y-m-d').'+3 days');
            $vencimento5 = new \DateTime(date('Y-m-d').'+4 days');
            $listaContratosVencendo = $em->getRepository(Entity::documento)->findByFimAndIdEmpresa($vencimento1,$vencimento2, $vencimento3, $vencimento4, $vencimento5,$idEmpresa);    
            $listaVaga = $em->getRepository(Entity::vaga)->findByIdEmpresaVaga($idEmpresa);
            $selecionarEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idEmpresa);
            $listaVagaEstagiando = $em->getRepository(Entity::vaga)->findByRecisaoAndIdEmpresaVaga('',$idEmpresa);

                    $page = $this->params()->fromRoute("id", 0);
                    $pagination = new Paginator( new ArrayAdapter($listaVagaEstagiando));
                    $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->itemPorPagina);
                    $count = $pagination->count();
                    $pageNumber = $pagination->getCurrentPageNumber();
                    $getPages = $pagination->getPages();

                        return new ViewModel([
                            'listaContratosVencendo' => $listaContratosVencendo,
                            'listaVaga'=>$listaVaga,
                            'empresaSelect'=>$selecionarEmpresa,
                            'getPages'=>$getPages,
                            'pageNumber'=>$pageNumber,
                            'count'=>$count,
                            'pagination'=>$pagination,
                            'empresa'=>$selecionarEmpresa,
                            'listaVagaEstagiando'=>$listaVagaEstagiando
                        ]);        
            }

    public function painelEmpresaEncerradoAction(){
            $auth = new AuthenticationService();
            $identidade = $auth->getIdentity();
            foreach ($identidade as $l){
                $idEmpresa = $l[0]->getidEmpresa();
            }
            $em = $this->getServiceLocator()->get(Entity::em);
            $vencimento1 = new \DateTime(date('Y-m-d'));
            $vencimento2 = new \DateTime(date('Y-m-d').'+1 days');
            $vencimento3 = new \DateTime(date('Y-m-d').'+2 days');
            $vencimento4 = new \DateTime(date('Y-m-d').'+3 days');
            $vencimento5 = new \DateTime(date('Y-m-d').'+4 days');
            $listaContratosVencendo = $em->getRepository(Entity::documento)->findByFimAndIdEmpresa($vencimento1,$vencimento2, $vencimento3, $vencimento4, $vencimento5,$idEmpresa);
        
            $listaVaga = $em->getRepository(Entity::vaga)->findByIdEmpresaVaga($idEmpresa);
            $selecionarEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idEmpresa);
            $listaVagaEstagiando = $em->getRepository(Entity::vaga)->findByRecisaoAndIdEmpresaVaga('',$idEmpresa);
            $vagasEncerradas = $em->getRepository(Entity::vaga)->findBySituacaoAndIdEmpresaVaga('0',$idEmpresa);
                    $page = $this->params()->fromRoute("id", 0);
                    $pagination = new Paginator( new ArrayAdapter($vagasEncerradas));
                    $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->itemPorPagina);
                    $count = $pagination->count();
                    $pageNumber = $pagination->getCurrentPageNumber();
                    $getPages = $pagination->getPages();

                        return new ViewModel([
                            'listaContratosVencendo' => $listaContratosVencendo,
                            'listaVaga'=>$listaVaga,
                            'empresaSelect'=>$selecionarEmpresa,
                            'getPages'=>$getPages,
                            'pageNumber'=>$pageNumber,
                            'count'=>$count,
                            'pagination'=>$pagination,
                            'empresa'=>$selecionarEmpresa,
                            'listaVagaEstagiando'=>$listaVagaEstagiando,
                            'vagasEncerradas' => $vagasEncerradas
                        ]);        
            }
    public function editarEmpresaAction(){
                $em = $this->getServiceLocator()->get(Entity::em);
                $auth = new AuthenticationService();
                $identidade = $auth->getIdentity();
                foreach ($identidade as $l){
                $idEmpresa = $l[0]->getIdempresa();
                }
                $listaEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idEmpresa);
                $request = $this->getRequest();
                if($request ->isPost()){
                    $select = $em ->find(Entity::empresa, $idEmpresa);
                    $NomeEmpresa = $request->getPost("empresa");
                    $cnpj = $request->getPost("cnpj");
                    $telefone = $request->getPost("telefone");
                    $endereco = $request->getPost("endereco");
                    $responsavel = $request->getPost("responsavel");
                    $email = $request->getPost("email");

                    try{
                        $select->setEmpresa($NomeEmpresa);
                        $select->setCnpj($cnpj);
                        $select->setTelefone($telefone);
                        $select->setEndereco($endereco);
                        $select->setResponsavel($responsavel);
                        $select->setEmail($email);
                        $em->persist($select);
                        $em->flush();     
                    } catch (Exception $ex) {

                    } 
                return $this->redirect()->toRoute('painelEmpresa/default', ['controller'=> 'empresa', 'id'=>'1']);
                }
                return new ViewModel([       
                        'listaEmpresa' => $listaEmpresa
                ]);
    }
public function painelEmpresaContratosVencendoAction(){
        $auth = new AuthenticationService();
        $identidade = $auth->getIdentity();
        foreach ($identidade as $l){
            $empresa = $l[0]->getEmpresa();
            $idEmpresa = $l[0]->getidEmpresa();
        }
        $em = $this->getServiceLocator()->get(Entity::em);
            $vencimento1 = new \DateTime(date('Y-m-d'));
            $vencimento2 = new \DateTime(date('Y-m-d').'+1 days');
            $vencimento3 = new \DateTime(date('Y-m-d').'+2 days');
            $vencimento4 = new \DateTime(date('Y-m-d').'+3 days');
            $vencimento5 = new \DateTime(date('Y-m-d').'+4 days');
        $listaContratosVencendo = $em->getRepository(Entity::documento)
            ->findByFimAndIdEmpresa($vencimento1,$vencimento2, $vencimento3,$vencimento4, $vencimento5,$idEmpresa);
        $selecionarEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idEmpresa);
        $listaVaga = $em->getRepository(Entity::vaga)->findByIdEmpresaVaga($idEmpresa);
        $listaVagaEstagiando = $em->getRepository(Entity::vaga)->findByRecisaoAndIdEmpresaVaga('',$idEmpresa);
     
                    $page = $this->params()->fromRoute("id", 0);
                    $pagination = new Paginator( new ArrayAdapter($listaContratosVencendo));
                    $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->itemPorPagina);
                    $count = $pagination->count();
                    $pageNumber = $pagination->getCurrentPageNumber();
                    $getPages = $pagination->getPages();
        return new ViewModel([       
            'listaContratosVencendo' => $listaContratosVencendo,
            'getPages'=>$getPages,
            'pageNumber'=>$pageNumber,
            'count'=>$count,
            'pagination'=>$pagination,
            'empresaSelect'=>$selecionarEmpresa,
            'empresa'=>$empresa,
            'listaVaga'=>$listaVaga,
             'listaVagaEstagiando'=>$listaVagaEstagiando
        ]);
    }
    public function processoAction(){
        $auth = new AuthenticationService();
        $identidade = $auth->getIdentity();
        foreach ($identidade as $l){
            $idEmpresa = $l[0]->getidEmpresa();
        }
        $lancarDocumentoForma = new LancarDocumentoForm();
        $idalunovaga = $this->params()->fromRoute("id", 0);
        $em = $this->getServiceLocator()->get(Entity::em);
        $selecionarEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idEmpresa);
        $listaVaga = $em->getRepository(Entity::vaga)->findByIdalunovaga($idalunovaga);
        $listaAluno = $em->getRepository(Entity::aluno)->findByIdaluno($idalunovaga);
        $listaContratos = $em->getRepository(Entity::documento)->findByIdalunoDocumento($idalunovaga);
        
         return new ViewModel([
            'empresaSelect'=>$selecionarEmpresa,
             'listaVaga'=>$listaVaga,
             'listaContratos'=> $listaContratos,
            'lancarDocumentoForm' =>$lancarDocumentoForma,
             'listaAluno' =>$listaAluno
        ]);
        
    }
    public function viaEmpresaAction(){
        $em = $this->getServiceLocator()->get(Entity::em); 
        $request = $this->getRequest();
        if($request ->isPost()){
            $via = $request->getPost("via");
            $idDocumento = $request("idDocumento");
            $documento = $em->find(Entity::documento, $idDocumento);
            $documento->setViaempresa($via);
            $em->persist($documento);
            $em->flush();
        }
}
public function mensagensAction(){
        $auth = new AuthenticationService();
        $identidade = $auth->getIdentity();
        foreach ($identidade as $l){
            $idEmpresa = $l[0]->getidEmpresa();
        }
        $em = $this->getServiceLocator()->get(Entity::em);
        $mensagensNaoLidas = $em->getRepository(Entity::mensagem)->findByStatusAndIdEmpresa('0','empresa-'.$idEmpresa);
        $quantidadeMensagensNaoLidas = count($mensagensNaoLidas);   
        $selecionarEmpresa = $em->getRepository(Entity::empresa)->findByIdempresa($idEmpresa);
        $mensagens = $em->getRepository(Entity::mensagem)->findByIddestinatario('empresa-'.$idEmpresa,array('idmensagem' => 'DESC')); 
        $page = $this->params()->fromRoute("id", 0);
                    $pagination = new Paginator( new ArrayAdapter($mensagens));
                    $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage($this->itemPorPagina);
                    $count = $pagination->count();
                    $pageNumber = $pagination->getCurrentPageNumber();
                    $getPages = $pagination->getPages();
    return new ViewModel(
            [
                'mensagens'=>$mensagens,
                'mensagensNaoLidas' => $quantidadeMensagensNaoLidas,
                'selecionarEmpresa' => $selecionarEmpresa,
                'getPages'=>$getPages,
                'pageNumber'=>$pageNumber,
                'count'=>$count,
                'pagination'=>$pagination,
            ]);
}
public function abrirMensagemAction(){
    $request = $this->getRequest();
    if($request ->isXmlHttpRequest()){
        $response = $this->getResponse();
        $idMensagem = $request->getPost("idMensagem");
        $status = $request->getPost("status");
        $em = $this->getServiceLocator()->get(Entity::em);
        if($status == '0'){
            $mensagem = $em->find(Entity::mensagem, $idMensagem);
            $mensagem->setStatus('1');
            $em->persist($mensagem);
            $em->flush();
        }
        $mensagemSelect =  $em->getRepository(Entity::mensagem)->findByIdmensagem($idMensagem);
        $mensagensNaoLidas = $em->getRepository(Entity::mensagem)->findByStatus('0');
        $quantidadeMensagensNaoLidas = count($mensagensNaoLidas);
        foreach ($mensagemSelect as $l){
            $mensagemArreay = [
                'mensagem' => $l->getMensagem(),
                'email' => $l->getEmail(),
                'mensagensNaoLidas' => $quantidadeMensagensNaoLidas
                    ];
            
        }
        $response->setContent(\Zend\Json\Json::encode($mensagemArreay));
        return $response;
    }
}
}
