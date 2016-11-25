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
        $this->em = 'Doctrine\ORM\EntityManager';
    }

    public function cadastrarOportunidadeAction(){
        
         $em = $this->getServiceLocator()->get($this->em );
         $listaEmpresa = $em->getRepository("Administrador\Entity\Empresa")->findAll();
         $listaCurso = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
         $listaCursoEAD = $em->getRepository("Base\Entity\Dados")->findAll();
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
        $listaOportunidade = $em->getRepository("Oportunidade\Entity\Oportunidade")->findAll(array('idoporunidade' => 'DESC'));
        
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
        $oportunidade =  $em->getRepository("Oportunidade\Entity\Oportunidade")->findByIdoportunidade($idOportunidade);
        
        return new ViewModel([
            'oportunidade'=>$oportunidade
        ]);
    }

}