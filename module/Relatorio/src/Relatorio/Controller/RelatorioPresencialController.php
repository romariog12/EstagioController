<?php

namespace Relatorio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Base\Model\Entity;
use Base\Model\Constantes;
/**
 * @author Romário Macêdo Portela <romariomacedo18@gmail.com>
 */
class RelatorioPresencialController extends AbstractActionController {
    
    public function relatorioAction(){    
        $em = $this->getServiceLocator()->get(Entity::em);
        $listaCursos = $em->getRepository(Entity::dados)->findAll();
        $quantidadeCursos = count($listaCursos);
        $totalEstagioPorCurso = [];
        $estagiando = [];
        for($count = 1 ;$count<=$quantidadeCursos ;$count++){
            $totalEstagioPorCurso[$count] =  count($em->getRepository(Entity::vaga)->findBycursoVaga($count));
            $estagiando[$count] = count($em->getRepository(Entity::vaga)->findBySituacaoAndCursoVaga('1',$count));
        }
        return new ViewModel([ 
            'listaestagiando'=>[$estagiando],
            'listaCursos'=>$listaCursos
        ]);
   } 
     public function relatorioGraficoAction(){
        $em = $this->getServiceLocator()->get(Entity::em);              
        $request = $this->getRequest();
        $lista = $em->getRepository(Entity::dados)->findAll();
        $quantidadeCursos = count($lista);
        if($request->isPost()){
            $ano = $request->getPost('ano');
            $listaTodosCursos = $em->getRepository(Entity::vaga)->findByanoVaga($ano);
            $mes = [];
            $cursoVagas = [];
            $cursoTce = [];
            $cursoTa = [];
            for($count = 1 ;$count<=12 ;$count++){
                $mes[$count]= count($em->getRepository(Entity::vaga)->findByAnoVagaAndMesVaga($ano, $count)) ;   
            }
            for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                $cursoTce[$count] = count($em->getRepository(Entity::documento)->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE',$count ));   
                $cursoTa[$count] = count($em->getRepository(Entity::documento)->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA',$count ));
                $cursoVagas[$count] = count($em->getRepository(Entity::vaga)->findByAnoVagaAndCursoVaga($ano, $count));   
            }   
        $tce = $em->getRepository(Entity::documento)->findByAnoVagaAndTipo ($ano, 'TCE' );
        $ta = $em->getRepository(Entity::documento)->findByAnoVagaAndTipo($ano,  'TA' );
        return new ViewModel([
            'listaTodosCursos'=>$listaTodosCursos,
            'rowTodosCursos'=> count($listaTodosCursos),
            'listaDados' => $lista,
            'mes'=>[$mes],
            'cursoVagas'=>[$cursoVagas],
            'cursoTce' =>[$cursoTce],
            'cursoTa'=>[$cursoTa],
            'ano'=>$ano,          
            'tceRow'=> count($tce),
            'taRow'=> count($ta),                      
        ]);
                        
        }else{
            $listaTodosCursos = $em->getRepository(Entity::vaga)->findByanoVaga(date('Y'));
            $mes = [];
            $cursoVagas = [];
            $cursoTce = [];
            $cursoTa = [];
             for($count = 1 ;$count<=12 ;$count++){
             $mes[$count]=count($em->getRepository(Entity::vaga)->findByAnoVagaAndMesVaga(date('Y'), $count));   
             }
             for($count = 1 ;$count<=$quantidadeCursos ;$count++){
             $cursoTce[$count] = count($em->getRepository(Entity::documento)->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE',$count ));
             $cursoTa[$count] = count($em->getRepository(Entity::documento)->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA',$count ));
             $cursoVagas[$count] = count($em->getRepository(Entity::vaga)->findByAnoVagaAndCursoVaga(date('Y'), $count));  
             }
            $tce = $em->getRepository(Entity::documento)
                ->findByAnoVagaAndTipo (date('Y'), 'TCE' );
            $ta = $em->getRepository(Entity::documento)
                ->findByAnoVagaAndTipo(date('Y'),  'TA' );
            return new ViewModel([
                'listaTodosCursos'=>$listaTodosCursos,
                'rowTodosCursos'=> count($listaTodosCursos),
                'listaDados' => $lista,
                'mes'=>[$mes],
                'cursoVagas'=>[$cursoVagas],
                'cursoTce' =>[$cursoTce],
                'cursoTa'=>[$cursoTa],  
                'ano'=> date('Y'),          
                'tceRow'=> count($tce),
                'taRow'=> count($ta)                          
            ]);

        }
    } 
    public function infoPresencialAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $aba = $this->params()->fromRoute("aba",0);
        $page = $this->params()->fromRoute("page");
        $estagios = $em->getRepository(Entity::vaga)->findByCursoVaga($curso);
        $selectCurso = $em->getRepository(Entity::dados)->findByIddados($curso);
        $estagiosEmAndamento = $em->getRepository(Entity::vaga)->findBySituacaoAndCursoVaga('1',$curso);
        $estagiosRecindidos = $em->getRepository(Entity::vaga)->findBySituacaoAndCursoVaga('0',$curso);
        $alunosCadastrados = $em->getRepository(Entity::aluno)->findBycurso($curso1);
        $mes = false;
        switch($aba):
            case '2': $resposta = '2';
                $pagination = new Paginator( new ArrayAdapter($estagiosEmAndamento));
                break;
            case '3': $resposta = '3';
                $pagination = new Paginator( new ArrayAdapter($estagiosRecindidos));
                 break;
            case '4': $resposta = '4';
                $pagination = new Paginator( new ArrayAdapter($alunosCadastrados));
                 break;
            case '5': $resposta = '5';
                $pagination = false;
                $getPages   = false;
                $pageNumber = false;
                $count      = false;
                for($Count = 1 ;$Count<=12 ;$Count++){
                   $mes[$Count]=$em->getRepository(Entity::vaga)->findByAnoVagaAndMesVagaAndCursoVaga(date('Y'), $Count,$curso) ;           
                }
                 break;
            default : $resposta = '1';
                $pagination = new Paginator( new ArrayAdapter($estagios));
        endswitch;
        if($pagination){
            $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(Constantes::contadorPorPagina);
            $count = $pagination->count();
            $pageNumber = $pagination->getCurrentPageNumber();
            $getPages = $pagination->getPages();    
        }
        return new ViewModel(
            [
            'resposta'=>$resposta,
            'getPages'=>$getPages,
            'pageNumber'=>$pageNumber,
            'count'=>$count,
            'pagination'=>$pagination,
            'estagios'=>$estagios,
            'estagiosEmAndamento'=>$estagiosEmAndamento,
            'estagiosRecindidos'=>$estagiosRecindidos,
            'alunosCadastrados'=>$alunosCadastrados,
            'curso'=>$selectCurso,
            'listaMensal'=>$mes
            ]
        );
    }
}