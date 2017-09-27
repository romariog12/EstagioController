<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administrador\Controller;
/**
 * Description of UsuarioRepository
 *
 * @author romario
 */
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Empresa\Entity\Empresa;
use Vaga\Entity\VagaPresencial;
use Vaga\Entity\Vaga;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Base\Model\Entity;

class EmpresaController extends AbstractActionController
{
    
 
    public function cadastrarEmpresaAction(){
            $this->sairComumAction();
            $request = $this->getRequest();
            $idaluno = $this->params()->fromRoute("id", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
          if ($request->isPost()){
                $nomeEmpresa = $request->getPost("empresa");
                $cnpj = $request->getPost("cnpj");
                $telefone = $request->getPost("telefone");
                $endereco = $request->getPost("endereco");
                $responsavel = $request->getPost("responsavel");
                $email = $request->getPost("email");
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
                  $em->persist($empresa);
                  $em->flush();
                  
              } catch (Exception $ex) {
                  echo $this->flashMessenger()->render();     
              }
              if($idaluno == 0){
                      return $this->redirect()->toRoute('perfilEmpresa/default', 
                          array('controller' => 'empresa', 'action' => 'perfilempresa', 'id'=>$nomeEmpresa,));
                      
              }else
              {
                      return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'index', 'id'=>$idaluno));
              }
                      
              }
            
      
          return new ViewModel([
              'idaluno'=>$idaluno
          ]);
        }   
    
    public function cadastrarAgenteAction(){
          $this->sairComumAction();
          $request = $this->getRequest();
          $idaluno = $this->params()->fromRoute("id", 0);
          
          if ($request->isPost()){
              try {
              $nomeAgente = $request->getPost("agente");
              $cnpj = $request->getPost("cnpj");
              $telefone = $request->getPost("telefone");
              $endereco = $request->getPost("endereco");
              $responsavel = $request->getPost("responsavel");
              $email = $request->getPost("email");
              $agente = new \Administrador\Entity\Agente();
              $agente ->setAgente($nomeAgente);
              $agente ->setCnpj($cnpj);
              $agente ->setTelefone($telefone);
              $agente ->setEndereco($endereco);
              $agente ->setResponsavel($responsavel);
              $agente ->setEmail($email);
              
              $em = $this->getServiceLocator()->get(Entity::em);
                  $em->persist($agente);
                  $em->flush();
                  
              } catch (Exception $ex) {
                  echo $this->flashMessenger()->render();     
              }
                    if($idaluno == 0){
                      return $this->redirect()->toRoute('cadastrarEmpresa/default', 
                  array('controller' => 'empresa', 'action' => 'cadastrarAgente','id'=>'0'));
                      
              }else
              {
                      return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'index', 'id'=>$idaluno));
              }
            }
      
          return new ViewModel([
              'idaluno'=>$idaluno
          ]);
        }
        public function buscarEmpresaAction(){
            $this->sairComumAction();
            $request = $this->getRequest();
            if($request->isPost()){
                $data = $this->params()->fromPost();
                $empresa = new Empresa(); 
                $em = $this->getServiceLocator()->get(Entity::em);

                switch ($data['buscar']){
                    case 'buscarPorCnpj':
                            $cnpj = $request->getPost('porCnpj');
                            $empresa->setCnpj($cnpj);
                            $lista = $em->getRepository(Entity::empresa)->findByCnpj($empresa->getCnpj());
                            break;
                    case 'buscarPorNome':
                            $nome = $request->getPost('porNome');
                            $empresa->setEmpresa($nome);
                            $lista = $em->getRepository(Entity::empresa)->findByEmpresa($empresa->getEmpresa());
                            break;
                }
                return new ViewModel([
                'lista' => $lista,
                    ]);  
                }
                
                }
public function perfilEmpresaAction(){
      $this->sairComumAction();
      $vaga = new VagaPresencial();
      $vagaEAD = new Vaga();
      $em = $this->getServiceLocator()->get(Entity::em);
      $empresa = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository(Entity::vagaPresencial)->findByEmpresa($empresa);
      $listaVagaEAD = $em->getRepository(Entity::vagaEad)->findByEmpresa($empresa);
      $empresaSelect = $em->getRepository(Entity::empresa)->findByEmpresa($empresa);
      $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)->findByRecisaoAndEmpresa('',$empresa);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
        foreach ($listaVagaEAD as $l){
                             $idVaga = $l->getidvaga();
                             $vagaEAD->setIdvaga($idVaga);
                    }            
         $listaDocumentoEAD = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByIdvagaDocumento($vagaEAD->getIdvaga());
        $listaDocumento = $em->getRepository(Entity::documentoPresencial)->findByIdvagaDocumento($vaga->getIdvaga());
       
        $page = $this->params()->fromRoute("idVaga", 0);
            $pagination = new Paginator( new ArrayAdapter($listaVaga));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
        
 
                 return new ViewModel([
                        'listaVaga'=>$listaVaga,
                        'listaVagaEAD'=>$listaVagaEAD,
                        'empresaSelect'=>$empresaSelect,
                        'listaDocumento'=>$listaDocumento,
                        'listaDocumentoEAD'=>$listaDocumentoEAD,
                        'getPages'=>$getPages,
                        'pageNumber'=>$pageNumber,
                        'count'=>$count,
                        'pagination'=>$pagination,
                        'empresa'=>$empresa,
                        'listaVagaEstagiando'=>$listaVagaEstagiando
                ]);        
        }
        
        public function perfilEmpresaEstagiandoAction(){
      $this->sairComumAction();
      $vaga = new VagaPresencial();
      $vagaEAD = new Vaga();
      $em = $this->getServiceLocator()->get(Entity::em);
      $empresa = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository(Entity::vagaPresencial)->findByEmpresa($empresa);
      $listaVagaEAD = $em->getRepository(Entity::vagaEad)->findByEmpresa($empresa);
      $empresaSelect = $em->getRepository(Entity::empresa)->findByEmpresa($empresa);
      $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)->findByRecisaoAndEmpresa('',$empresa);
      
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
        foreach ($listaVagaEAD as $l){
                             $idVaga = $l->getidvaga();
                             $vagaEAD->setIdvaga($idVaga);
                    }            
         $listaDocumentoEAD = $em->getRepository(Entity::documentoPresencial)->findByIdvagaDocumento($vagaEAD->getIdvaga());
        $listaDocumento = $em->getRepository(Entity::documentoPresencial)->findByIdvagaDocumento($vaga->getIdvaga());
       
        $page = $this->params()->fromRoute("idVaga", 0);
            $pagination = new Paginator( new ArrayAdapter($listaVaga));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
        
 
                 return new ViewModel([
                        'listaVaga'=>$listaVaga,
                        'listaVagaEAD'=>$listaVagaEAD,
                        'empresaSelect'=>$empresaSelect,
                        'listaDocumento'=>$listaDocumento,
                        'listaDocumentoEAD'=>$listaDocumentoEAD,
                        'getPages'=>$getPages,
                        'pageNumber'=>$pageNumber,
                        'count'=>$count,
                        'pagination'=>$pagination,
                        'empresa'=>$empresa,
                        'listaVagaEstagiando'=>$listaVagaEstagiando
                ]);        
        }
        public function perfilEmpresaEncerradoAction(){
      $this->sairComumAction();
      $vaga = new VagaPresencial();
      $vagaEAD = new Vaga();
      $em = $this->getServiceLocator()->get(Entity::em);
      $empresa = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository(Entity::vagaPresencial)->findByEmpresa($empresa);
      $listaVagaEAD = $em->getRepository(Entity::vagaEad)->findByEmpresa($empresa);
      $empresaSelect = $em->getRepository(Entity::empresa)->findByEmpresa($empresa);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
        foreach ($listaVagaEAD as $l){
                             $idVaga = $l->getidvaga();
                             $vagaEAD->setIdvaga($idVaga);
                    }            
         $listaDocumentoEAD = $em->getRepository(Entity::documentoPresencial)->findByIdvagaDocumento($vagaEAD->getIdvaga());
        $listaDocumento = $em->getRepository(Entity::documentoPresencial)->findByIdvagaDocumento($vaga->getIdvaga());
         $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)->findByRecisaoAndEmpresa('',$empresa);
                 
        $page = $this->params()->fromRoute("idVaga", 0);
            $pagination = new Paginator( new ArrayAdapter($listaVaga));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
        
 
                 return new ViewModel([
                        'listaVaga'=>$listaVaga,
                        'listaVagaEAD'=>$listaVagaEAD,
                        'empresaSelect'=>$empresaSelect,
                        'listaDocumento'=>$listaDocumento,
                        'listaDocumentoEAD'=>$listaDocumentoEAD,
                        'getPages'=>$getPages,
                        'pageNumber'=>$pageNumber,
                        'count'=>$count,
                        'pagination'=>$pagination,
                        'empresa'=>$empresa,
                        'listaVagaEstagiando'=>$listaVagaEstagiando
                ]);        
        }
             
        
        
}
