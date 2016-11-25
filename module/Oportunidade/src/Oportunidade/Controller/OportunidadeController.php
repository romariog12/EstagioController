<?php
/**
 * @Autor Romário Macedo
 */
namespace Oportunidade\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Oportunidade\Entity\Oportunidade;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
class OportunidadeController extends AbstractActionController
{
    public function __construct(){
        $this->em           = 'Doctrine\ORM\EntityManager';
        $this->oportunidade = 'Oportunidade\Entity\Oportunidade';
        $this->empresa      = 'Administrador\Entity\Empresa';
        $this->dadosPresencial = 'Base\Entity\DadosPresencial';
        $this->dados    = 'Base\Entity\Dados';
    }

    public function cadastrarOportunidadeAction(){
        
         $em = $this->getServiceLocator()->get($this->em );
         $listaEmpresa = $em->getRepository($this->empresa )->findAll();
         $listaCurso = $em->getRepository($this->dadosPresencial)->findAll();
         $listaCursoEAD = $em->getRepository($this->dados)->findAll();
         $request = $this->getRequest();
        if($request->isPost()){
                 
            $data = $request->getPost()->toArray();
            $empresa = $request->getPost("empresa");
            $curso = implode('<br/>', $data["my-select"]);
            $cargo = $request->getPost("cargo");
            $numerovaga = $request->getPost("numeroVaga");
            $descricao = $request->getPost("descricao");
            
                $oportunidade = new Oportunidade();
                $oportunidade->setEmpresa($empresa);
                $oportunidade->setCurso($curso);
                $oportunidade->setCargo($cargo);
                $oportunidade->setNumerovaga($numerovaga);
                $oportunidade->setDescricao($descricao);
                $oportunidade->setData(new \DateTime());
                
                    try {

                    $em->persist($oportunidade);
                    $em->flush();

                    } catch (Exception $ex) {

                    } 
                    return $this->redirect()->toRoute('perfilOportunidade/default',(['controller'=>'oportunidade', 'action'=>'oportunidade', 'page'=>'1']));
        }
        
        return new ViewModel(
                [
                    'listaEmpresa' =>$listaEmpresa,
                    'listaCurso' =>$listaCurso,
                    'listaCursoEAD' =>$listaCursoEAD
                ]
                );
        
    }
     public function oportunidadeAction(){
        $this->sairComumAction();
        $em = $this->getServiceLocator()->get($this->em);
        $listaOportunidade = $em->getRepository($this->oportunidade)->findAll(array('idoporunidade' => 'DESC'));
        
                $page = $this->params()->fromRoute("page", 0);
                $pagination = new Paginator( new ArrayAdapter($listaOportunidade));
                $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(4);
                $count = $pagination->count();
                $pageNumber = $pagination->getCurrentPageNumber();
                $getPages = $pagination->getPages();
                    return new ViewModel([
                    'listaOportunidade'=> $listaOportunidade,
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    ]);
    }
    public function oportunidadeInfoAction(){
        $em = $this->getServiceLocator()->get($this->em);
        $idOportunidade = $this->params()->fromRoute("page", 0);
        $oportunidade =  $em->getRepository($this->oportunidade)->findByIdoportunidade($idOportunidade);
        
        return new ViewModel([
            'oportunidade'=>$oportunidade
        ]);
    }
    public function oportunidadeEditarAction(){
        $em = $this->getServiceLocator()->get($this->em);
        $listaEmpresa = $em->getRepository($this->empresa )->findAll();
        $listaCurso = $em->getRepository($this->dadosPresencial)->findAll();
        $listaCursoEAD = $em->getRepository($this->dados)->findAll();
        $idOportunidade = $this->params()->fromRoute("page", 0);
        $listaOportunidade = $em->getRepository($this->oportunidade)->findByIdoportunidade($idOportunidade);
        $request = $this->getRequest();
        if($request->isPost()){
            $oportunidade = $em->find($this->oportunidade, $idOportunidade);     
            $data = $request->getPost()->toArray();
            $empresa = $request->getPost("empresa");
            $curso = implode('<br/>', $data["my-select"]);
            $cargo = $request->getPost("cargo");
            $numerovaga = $request->getPost("numeroVaga");
            $descricao = $request->getPost("descricao");

                $oportunidade->setEmpresa($empresa);
                $oportunidade->setCurso($curso);
                $oportunidade->setCargo($cargo);
                $oportunidade->setNumerovaga($numerovaga);
                $oportunidade->setDescricao($descricao);
              
                
                    try {

                    $em->persist($oportunidade);
                    $em->flush();

                    } catch (Exception $ex) {

                    } 
                    return $this->redirect()->toRoute('perfilOportunidade/default',(['controller'=>'oportunidade', 'action'=>'oportunidade', 'page'=>'1']));
        }
        return new ViewModel([
            'listaOportunidade'=> $listaOportunidade,
            'listaEmpresa' =>$listaEmpresa,
            'listaCurso' =>$listaCurso,
            'listaCursoEAD' =>$listaCursoEAD
            
        ]);
    }
    
    public function excluirOportunidadeAction(){
            $id = $this->params()->fromRoute("id", 0);
            $em = $this->getServiceLocator()->get($this->em);
            $oportunidade = $em->find($this->oportunidade, $id);
            $em->remove($oportunidade);
            $em->flush();
          
       return $this->redirect()->toRoute('perfilOportunidade/default',(['controller'=>'oportunidade', 'action'=>'oportunidade', 'page'=>'1']));
              
    }

}