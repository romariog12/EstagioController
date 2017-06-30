<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administrador\Controller;

use Auth\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
use Empresa\Entity\Empresa;
use Vaga\Entity\VagaPresencial;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Base\Model\Entity;

class EmpresaController extends AdministradorAbstractActionController
{
    public function cadastrarEmpresaAction(){
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
                $senha = $request->getPost("cnpj");
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
      $vaga = new VagaPresencial();
      $em = $this->getServiceLocator()->get(Entity::em);
      $empresa = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository(Entity::vagaPresencial)->findByEmpresa($empresa);
     
      $empresaSelect = $em->getRepository(Entity::empresa)->findByEmpresa($empresa);
      $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)->findByRecisaoAndEmpresa('',$empresa);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
             
          $listaDocumento = $em->getRepository(Entity::documentoPresencial)->findByIdvagaDocumento($vaga->getIdvaga());
       
        $page = $this->params()->fromRoute("idVaga", 0);
            $pagination = new Paginator( new ArrayAdapter($listaVaga));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
        
 
                 return new ViewModel([
                        'listaVaga'=>$listaVaga,
                        'empresaSelect'=>$empresaSelect,
                        'listaDocumento'=>$listaDocumento,
                        'getPages'=>$getPages,
                        'pageNumber'=>$pageNumber,
                        'count'=>$count,
                        'pagination'=>$pagination,
                        'empresa'=>$empresa,
                        'listaVagaEstagiando'=>$listaVagaEstagiando
                ]);        
        }
        
        public function perfilEmpresaEstagiandoAction(){
      $vaga = new VagaPresencial();
      $em = $this->getServiceLocator()->get(Entity::em);
      $empresa = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository(Entity::vagaPresencial)->findByEmpresa($empresa);
      $empresaSelect = $em->getRepository(Entity::empresa)->findByEmpresa($empresa);
      $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)->findByRecisaoAndEmpresa('',$empresa);
      
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
        $listaDocumento = $em->getRepository(Entity::documentoPresencial)->findByIdvagaDocumento($vaga->getIdvaga());
       
        $page = $this->params()->fromRoute("idVaga", 0);
            $pagination = new Paginator( new ArrayAdapter($listaVaga));
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
        
 
                 return new ViewModel([
                        'listaVaga'=>$listaVaga,
                       
                        'empresaSelect'=>$empresaSelect,
                        'listaDocumento'=>$listaDocumento,
                        'getPages'=>$getPages,
                        'pageNumber'=>$pageNumber,
                        'count'=>$count,
                        'pagination'=>$pagination,
                        'empresa'=>$empresa,
                        'listaVagaEstagiando'=>$listaVagaEstagiando
                ]);        
        }
        public function perfilEmpresaEncerradoAction(){
      $vaga = new VagaPresencial();
      $em = $this->getServiceLocator()->get(Entity::em);
      $empresa = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository(Entity::vagaPresencial)->findByEmpresa($empresa);
      $empresaSelect = $em->getRepository(Entity::empresa)->findByEmpresa($empresa);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                
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
                        'empresaSelect'=>$empresaSelect,
                        'listaDocumento'=>$listaDocumento,
                        'getPages'=>$getPages,
                        'pageNumber'=>$pageNumber,
                        'count'=>$count,
                        'pagination'=>$pagination,
                        'empresa'=>$empresa,
                        'listaVagaEstagiando'=>$listaVagaEstagiando
                ]);        
        }        
}
