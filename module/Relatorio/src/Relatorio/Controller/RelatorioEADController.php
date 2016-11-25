<?php

namespace Relatorio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Aluno\Entity\Aluno;

class RelatorioEADController extends AbstractActionController {
    
    public function relatorioAction()
    {    $this->sairComumAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findAll();
            $findCurso = $em->getRepository("Aluno\Entity\Aluno")->findAll();
            $findEmpresa = $em->getRepository("Administrador\Entity\Empresa")->findAll();
            $recisaoRow = $em->getRepository("Vaga\Entity\Vaga")->findByRecisao('');
            $findAgente = $em->getRepository("Administrador\Entity\Agente")->findAll();
            $listaContratos = $em->getRepository("Vaga\Entity\Encaminhamento")->findAll();
            $listaCursos = $em->getRepository("Base\Entity\Dados")->findAll();
            $quantidadeCursos = count($listaCursos);
            
                //....:::Quantidade de estágios por curso:::......
                $totalEstagioPorCurso = [];
                for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                    $totalEstagioPorCurso[$count] =  $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga($count);
                }
           
                //........:::Estágios Em andamento por curso:::.............
                $estagiando = [];
                for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                $estagiando[$count] = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('',$count);
                }
                ///////////////////////////////////////////////////////////////////////////////////////////////////////////
      
        return new ViewModel([  
            'fetchRow'=>$findCurso,
            'row'=> count($findCurso),
            'recisaoRow'=>count($recisaoRow),
            'rowEmpresa' =>count($findEmpresa),
            'rowVaga'=>count($listaVaga),
            'rowAgente'=>count($findAgente),
            'rowContratosEncerrados'=> count($listaVaga) - count($recisaoRow),
            'rowContratos'=>count($listaContratos),  
            
            //....:::Quantidade de Estágios:::......
            'totalEstagioPorCurso'=>[
                '1' =>count($totalEstagioPorCurso['1']),
                '2' => count($totalEstagioPorCurso['2']),
                '3' => count($totalEstagioPorCurso['3']), 
                '4' => count($totalEstagioPorCurso['4']),
                '5'=> count($totalEstagioPorCurso['5']), 
                '6' => count($totalEstagioPorCurso['6']),
                '7' => count($totalEstagioPorCurso['7']), 
                '8'=> count($totalEstagioPorCurso['8']),
                '9'=> count($totalEstagioPorCurso['9']), 
                '10'=>count($totalEstagioPorCurso['10']), 
                '11'=> count($totalEstagioPorCurso['11']),
                '12'=>count($totalEstagioPorCurso['12']), 
                '13'=>  count($totalEstagioPorCurso['13']),
                '14'=> count($totalEstagioPorCurso['14']),
                '15'=> count($totalEstagioPorCurso['15']), 
                '16'=> count($totalEstagioPorCurso['16']),
                
                ],
                
             //........:::Estágios Em andamento:::.............    
                'listaestagiando'=>
                [
                '1' =>  count($estagiando['1']),
                '2' => count($estagiando['2']),
                '3' => count($estagiando['3']), 
                '4' => count($estagiando['4']),
                '5'=> count($estagiando['5']), 
                '6' => count($estagiando['6']),
                '7' => count($estagiando['7']), 
                '8'=> count($estagiando['8']),
                '9'=> count($estagiando['9']), 
                '10'=>count($estagiando['10']), 
                '11'=> count($estagiando['11']),
                '12'=>count($estagiando['12']), 
                '13'=>  count($estagiando['13']),
                '14'=> count($estagiando['14']),
                '15'=> count($estagiando['15']), 
                '16'=> count($estagiando['16']), 
                
                ],
            'listaCursos'=>$listaCursos
         
        ]);
 
   } 
     public function relatorioGraficoAction()
    {
        $this->sairComumAction();
                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");              
                $request = $this->getRequest();
                $lista = $em->getRepository("Base\Entity\Dados")->findAll();
                $quantidadeCursos = count($lista);
               
                if($request->isPost()){
                        $ano = $request->getPost('ano');
                        $listaTodosCursos = $em->getRepository("Vaga\Entity\Vaga")->findByanoVaga($ano);
                        $mes = [];
                        $cursoVagas = [];
                        $cursoTce = [];
                        $cursoTa = [];
                        $cursoInstituicao = [];
                        $cursoEmpresa = [];
                        
                         for($count = 1 ;$count<=12 ;$count++){
                         $mes[$count]=$em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano, $count) ;   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTce[$count] = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE',$count );   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTa[$count] = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA',$count );   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoInstituicao[$count] =  $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição', $count );  
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoEmpresa[$count] = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa', $count ); 
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoVagas[$count] = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano, $count);   
                         }
                    $tce = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo ($ano, 'TCE' );
                    $ta = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo($ano,  'TA' );
                    $rt1Instituicao = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo ($ano, 'Instituição');
                    $rtEmpresa = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo ($ano, 'Empresa');
                
                    
                        return new ViewModel([
                            'listaTodosCursos'=>$listaTodosCursos,
                            'rowTodosCursos'=> count($listaTodosCursos),
                            'listaDados' => $lista,
                            
                            'mes'=>[
                                '1' =>  count($mes[1]),
                                '2' =>  count($mes[2]),
                                '3' =>  count($mes[3]),
                                '4' =>  count($mes[4]),
                                '5' =>  count($mes[5]),
                                '6' =>  count($mes[6]),
                                '7' =>  count($mes[7]),
                                '8' =>  count($mes[8]),
                                '9' =>  count($mes[9]),
                                '10' =>  count($mes[10]),
                                '11' =>  count($mes[11]),
                                '12' =>  count($mes[12]),         
                            ],
         
                            'cursoVagas'=>[
                                '1' =>  count($cursoVagas[1]),
                                '2' =>  count($cursoVagas[2]),
                                '3' =>  count($cursoVagas[3]),
                                '4' =>  count($cursoVagas[4]),
                                '5' =>  count($cursoVagas[5]),
                                '6' =>  count($cursoVagas[6]),
                                '7' =>  count($cursoVagas[7]),
                                '8' =>  count($cursoVagas[8]),
                                '9' =>  count($cursoVagas[9]),
                                '10' =>  count($cursoVagas[10]),
                                '11' =>  count($cursoVagas[11]),
                                '12' =>  count($cursoVagas[12]),
                                '13' =>  count($cursoVagas[13]),
                                '14' =>  count($cursoVagas[14]),
                                '15' =>  count($cursoVagas[15]),
                                '16' =>  count($cursoVagas[16]),
                                
                                
                            ],
                            'cursoTce' =>[
                                '1' =>  count($cursoTce[1]),
                                '2' =>  count($cursoTce[2]),
                                '3' =>  count($cursoTce[3]),
                                '4' =>  count($cursoTce[4]),
                                '5' =>  count($cursoTce[5]),
                                '6' =>  count($cursoTce[6]),
                                '7' =>  count($cursoTce[7]),
                                '8' =>  count($cursoTce[8]),
                                '9' =>  count($cursoTce[9]),
                                '10' =>  count($cursoTce[10]),
                                '11' =>  count($cursoTce[11]),
                                '12' =>  count($cursoTce[12]),
                                '13' =>  count($cursoTce[13]),
                                '14' =>  count($cursoTce[14]),
                                '15' =>  count($cursoTce[15]),
                                '16' =>  count($cursoTce[16]),
                                
                            ],
                            'cursoTa'=>[
                                '1' =>  count($cursoTa[1]),
                                '2' =>  count($cursoTa[2]),
                                '3' =>  count($cursoTa[3]),
                                '4' =>  count($cursoTa[4]),
                                '5' =>  count($cursoTa[5]),
                                '6' =>  count($cursoTa[6]),
                                '7' =>  count($cursoTa[7]),
                                '8' =>  count($cursoTa[8]),
                                '9' =>  count($cursoTa[9]),
                                '10' =>  count($cursoTa[10]),
                                '11' =>  count($cursoTa[11]),
                                '12' =>  count($cursoTa[12]),
                                '13' =>  count($cursoTa[13]),
                                '14' =>  count($cursoTa[14]),
                                '15' =>  count($cursoTa[15]),
                                '16' =>  count($cursoTa[16]),
                                
                            ],
                            'cursoInstituicao'=>[
                                '1' =>  count($cursoInstituicao[1]),
                                '2' =>  count($cursoInstituicao[2]),
                                '3' =>  count($cursoInstituicao[3]),
                                '4' =>  count($cursoInstituicao[4]),
                                '5' =>  count($cursoInstituicao[5]),
                                '6' =>  count($cursoInstituicao[6]),
                                '7' =>  count($cursoInstituicao[7]),
                                '8' =>  count($cursoInstituicao[8]),
                                '9' =>  count($cursoInstituicao[9]),
                                '10' =>  count($cursoInstituicao[10]),
                                '11' =>  count($cursoInstituicao[11]),
                                '12' =>  count($cursoInstituicao[12]),
                                '13' =>  count($cursoInstituicao[13]),
                                '14' =>  count($cursoInstituicao[14]),
                                '15' =>  count($cursoInstituicao[15]),
                                '16' =>  count($cursoInstituicao[16]),
                                
                            ],
                            'cursoEmpresa'=>[
                                '1' =>  count($cursoEmpresa[1]),
                                '2' =>  count($cursoEmpresa[2]),
                                '3' =>  count($cursoEmpresa[3]),
                                '4' =>  count($cursoEmpresa[4]),
                                '5' =>  count($cursoEmpresa[5]),
                                '6' =>  count($cursoEmpresa[6]),
                                '7' =>  count($cursoEmpresa[7]),
                                '8' =>  count($cursoEmpresa[8]),
                                '9' =>  count($cursoEmpresa[9]),
                                '10' =>  count($cursoEmpresa[10]),
                                '11' =>  count($cursoEmpresa[11]),
                                '12' =>  count($cursoEmpresa[12]),
                                '13' =>  count($cursoEmpresa[13]),
                                '14' =>  count($cursoEmpresa[14]),
                                '15' =>  count($cursoEmpresa[15]),
                                '16' =>  count($cursoEmpresa[16]),
                                
                            ],
                            'ano'=>$ano,          
                            'tceRow'=> count($tce),
                            'taRow'=> count($ta),
                            'rtInstituicaoRow'=> count($rt1Instituicao) ,
                            'rtEmpresa'=> count($rtEmpresa),                           
                        ]);
                        
                }else{
                        
                        $listaTodosCursos = $em->getRepository("Vaga\Entity\Vaga")->findByanoVaga(date('Y'));
                        $mes = [];
                        $cursoVagas = [];
                        $cursoTce = [];
                        $cursoTa = [];
                        $cursoInstituicao = [];
                        $cursoEmpresa = [];
                        
                         for($count = 1 ;$count<=12 ;$count++){
                         $mes[$count]=$em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'), $count) ;   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTce[$count] = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE',$count );   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTa[$count] = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA',$count );   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoInstituicao[$count] =  $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição', $count );  
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoEmpresa[$count] = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa', $count ); 
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoVagas[$count] = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'), $count);   
                         }
                    $tce = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo (date('Y'), 'TCE' );
                    $ta = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo(date('Y'),  'TA' );
                    $rt1Instituicao = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo (date('Y'), 'Instituição');
                    $rtEmpresa = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo (date('Y'), 'Empresa');
                
                    
                        return new ViewModel([
                            'listaTodosCursos'=>$listaTodosCursos,
                            'rowTodosCursos'=> count($listaTodosCursos),
                            'listaDados' => $lista,
                            
                            'mes'=>[
                                '1' =>  count($mes[1]),
                                '2' =>  count($mes[2]),
                                '3' =>  count($mes[3]),
                                '4' =>  count($mes[4]),
                                '5' =>  count($mes[5]),
                                '6' =>  count($mes[6]),
                                '7' =>  count($mes[7]),
                                '8' =>  count($mes[8]),
                                '9' =>  count($mes[9]),
                                '10' =>  count($mes[10]),
                                '11' =>  count($mes[11]),
                                '12' =>  count($mes[12]),         
                            ],
                            'cursoTce' =>[
                                '1' =>  count($cursoTce[1]),
                                '2' =>  count($cursoTce[2]),
                                '3' =>  count($cursoTce[3]),
                                '4' =>  count($cursoTce[4]),
                                '5' =>  count($cursoTce[5]),
                                '6' =>  count($cursoTce[6]),
                                '7' =>  count($cursoTce[7]),
                                '8' =>  count($cursoTce[8]),
                                '9' =>  count($cursoTce[9]),
                                '10' =>  count($cursoTce[10]),
                                '11' =>  count($cursoTce[11]),
                                '12' =>  count($cursoTce[12]),
                                '13' =>  count($cursoTce[13]),
                                '14' =>  count($cursoTce[14]),
                                '15' =>  count($cursoTce[15]),
                                '16' =>  count($cursoTce[16]),
                                
                            ],
         
                            'cursoVagas'=>[
                                '1' =>  count($cursoVagas[1]),
                                '2' =>  count($cursoVagas[2]),
                                '3' =>  count($cursoVagas[3]),
                                '4' =>  count($cursoVagas[4]),
                                '5' =>  count($cursoVagas[5]),
                                '6' =>  count($cursoVagas[6]),
                                '7' =>  count($cursoVagas[7]),
                                '8' =>  count($cursoVagas[8]),
                                '9' =>  count($cursoVagas[9]),
                                '10' =>  count($cursoVagas[10]),
                                '11' =>  count($cursoVagas[11]),
                                '12' =>  count($cursoVagas[12]),
                                '13' =>  count($cursoVagas[13]),
                                '14' =>  count($cursoVagas[14]),
                                '15' =>  count($cursoVagas[15]),
                                '16' =>  count($cursoVagas[16]),
                               
                            ],
                            'cursoTa'=>[
                                '1' =>  count($cursoTa[1]),
                                '2' =>  count($cursoTa[2]),
                                '3' =>  count($cursoTa[3]),
                                '4' =>  count($cursoTa[4]),
                                '5' =>  count($cursoTa[5]),
                                '6' =>  count($cursoTa[6]),
                                '7' =>  count($cursoTa[7]),
                                '8' =>  count($cursoTa[8]),
                                '9' =>  count($cursoTa[9]),
                                '10' =>  count($cursoTa[10]),
                                '11' =>  count($cursoTa[11]),
                                '12' =>  count($cursoTa[12]),
                                '13' =>  count($cursoTa[13]),
                                '14' =>  count($cursoTa[14]),
                                '15' =>  count($cursoTa[15]),
                                '16' =>  count($cursoTa[16]),
                               
                            ],
                            'cursoInstituicao'=>[
                                '1' =>  count($cursoInstituicao[1]),
                                '2' =>  count($cursoInstituicao[2]),
                                '3' =>  count($cursoInstituicao[3]),
                                '4' =>  count($cursoInstituicao[4]),
                                '5' =>  count($cursoInstituicao[5]),
                                '6' =>  count($cursoInstituicao[6]),
                                '7' =>  count($cursoInstituicao[7]),
                                '8' =>  count($cursoInstituicao[8]),
                                '9' =>  count($cursoInstituicao[9]),
                                '10' =>  count($cursoInstituicao[10]),
                                '11' =>  count($cursoInstituicao[11]),
                                '12' =>  count($cursoInstituicao[12]),
                                '13' =>  count($cursoInstituicao[13]),
                                '14' =>  count($cursoInstituicao[14]),
                                '15' =>  count($cursoInstituicao[15]),
                                '16' =>  count($cursoInstituicao[16]),
                               
                            ],
                            'cursoEmpresa'=>[
                                '1' =>  count($cursoEmpresa[1]),
                                '2' =>  count($cursoEmpresa[2]),
                                '3' =>  count($cursoEmpresa[3]),
                                '4' =>  count($cursoEmpresa[4]),
                                '5' =>  count($cursoEmpresa[5]),
                                '6' =>  count($cursoEmpresa[6]),
                                '7' =>  count($cursoEmpresa[7]),
                                '8' =>  count($cursoEmpresa[8]),
                                '9' =>  count($cursoEmpresa[9]),
                                '10' =>  count($cursoEmpresa[10]),
                                '11' =>  count($cursoEmpresa[11]),
                                '12' =>  count($cursoEmpresa[12]),
                                '13' =>  count($cursoEmpresa[13]),
                                '14' =>  count($cursoEmpresa[14]),
                                '15' =>  count($cursoEmpresa[15]),
                                '16' =>  count($cursoEmpresa[16]),
                                
                            ],
                            'ano'=> date('Y'),          
                            'tceRow'=> count($tce),
                            'taRow'=> count($ta),
                            'rtInstituicaoRow'=> count($rt1Instituicao) ,
                            'rtEmpresa'=> count($rtEmpresa),                           
                ]);
                        
                         }
    } 
   
    public function infoEADAction(){
         $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga($curso);
        $selectCurso = $em->getRepository("Base\Entity\Dados")->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\Aluno")->findByCurso($curso1);            
        
        
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        
        $mes = [];
         for($Count = 1 ;$Count<=12 ;$Count++){
                         $mes[$Count]=$em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVagaAndCursoVaga(date('Y'), $Count,$curso) ;   
                         }
     
        return new ViewModel(
                array(
                    'countListaAlunosCadastrados'=>count($listaAlunosCadastrados),
                    'listaAlunosCadastrados'=>$listaAlunosCadastrados,
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaVaga'=>$listaVaga,
                    'countListaTotalVaga'=> count($listaVaga),
                    'countListaEstagiando'=>count($listaVagaEstagiando),
                    'countListaEncerrado'=>count($listaVaga) - count($listaVagaEstagiando),
                    'mensagem'=>$menstagem=   '<div class="alert-danger" style="margin: initial">
                        <br/>
                        <h4 style="text-align: center">Sem dados à apresentar!</h4><br/>      
                        </div>
                    <tr>',
                    'curso'=>$selectCurso,
                    'listaMensal'=>$mes
                    
                    )
                );
    }
      public function infoEADEstagiandoAction(){
           $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('',$curso);
        $selectCurso = $em->getRepository("Base\Entity\Dados")->findByIddados($curso);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\Aluno")->findByCurso($curso1);            
        
        
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
     
        return new ViewModel(
                array(
                    'countListaAlunosCadastrados'=>count($listaAlunosCadastrados),
                    'listaAlunosCadastrados'=>$listaAlunosCadastrados,
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaVaga'=>$listaVaga,
                    'countListaTotalVaga'=> count($listaVaga),
                    'countListaEstagiando'=>count($listaVagaEstagiando),
                    'countListaEncerrado'=>count($listaVaga) - count($listaVagaEstagiando),
                    'mensagem'=>$menstagem=   '<div class="alert-danger" style="margin: initial">
                        <br/>
                        <h4 style="text-align: center">Sem dados à apresentar!</h4><br/>      
                        </div>
                    <tr>'
                    ,'curso'=>$selectCurso
                    )
                );
    }
     public function infoEADEncerradoAction(){
          $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga($curso);
        $selectCurso = $em->getRepository("Base\Entity\Dados")->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\Aluno")->findByCurso($curso1);            
        
        
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
     
        return new ViewModel(
                array(
                    'countListaAlunosCadastrados'=>count($listaAlunosCadastrados),
                    'listaAlunosCadastrados'=>$listaAlunosCadastrados,
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaVaga'=>$listaVaga,
                    'countListaTotalVaga'=> count($listaVaga),
                    'countListaEstagiando'=>count($listaVagaEstagiando),
                    'countListaEncerrado'=>count($listaVaga) - count($listaVagaEstagiando),
                    'mensagem'=>$menstagem =  '<div class="alert-danger" style="margin: initial">
                        <br/>
                        <h4 style="text-align: center">Sem dados à apresentar!</h4><br/>      
                        </div>
                    <tr>'
                    ,'curso'=>$selectCurso
                    )
                );
    }
    public function infoEADAlunosCadastradosAction(){
        $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        
        $request = $this->getRequest(); 
            
        
        
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga($curso);
        $selectCurso = $em->getRepository("Base\Entity\Dados")->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\Aluno")->findByCurso($curso1);
       
        
        
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaAlunosCadastrados));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        if($request->isPost()){
                $data = $this->params()->fromPost();
                $aluno = new Aluno(); 

                switch ($data['buscar']){
                    case 'buscarPorMatricula':
                            $matricula = $request->getPost('porMatricula');
                            $aluno->setMatricula($matricula);
                            $lista = $em->getRepository("Aluno\Entity\Aluno")->findByMatriculaAndCurso($aluno->getMatricula(), $curso1);
                            break;
                    case 'buscarPorNome':
                            $nome = $request->getPost('porNome');
                            $aluno->setNome($nome);
                            $lista = $em->getRepository("Aluno\Entity\Aluno")->findByNomeAndCurso($aluno->getNome(), $curso1);
                            break;
                }
                return new ViewModel([
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaVaga'=>$listaVaga,
                    'countListaTotalVaga'=> count($listaVaga),
                    'countListaEstagiando'=>count($listaVagaEstagiando),
                    'countListaAlunosCadastrados'=>count($listaAlunosCadastrados),
                    'listaAlunosCadastrados'=>$listaAlunosCadastrados,
                    'countListaEncerrado'=>count($listaVaga) - count($listaVagaEstagiando),
                    'mensagem'=>$menstagem =  '<div class="alert-danger" style="margin: initial">
                        <br/>
                        <h4 style="text-align: center">Sem dados à apresentar!</h4><br/>      
                        </div>
                    <tr>'
                    ,'curso'=>$selectCurso,
        'lista' => $lista,
           
            ]);
        
            }
     
        return new ViewModel(
                array(
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaVaga'=>$listaVaga,
                    'countListaTotalVaga'=> count($listaVaga),
                    'countListaEstagiando'=>count($listaVagaEstagiando),
                    'countListaAlunosCadastrados'=>count($listaAlunosCadastrados),
                    'listaAlunosCadastrados'=>$listaAlunosCadastrados,
                    'countListaEncerrado'=>count($listaVaga) - count($listaVagaEstagiando),
                    'mensagem'=>$menstagem =  '<div class="alert-danger" style="margin: initial">
                        <br/>
                        <h4 style="text-align: center">Sem dados à apresentar!</h4><br/>      
                        </div>
                    <tr>'
                    ,'curso'=>$selectCurso,
                    
                    )
                );
    }
    public function infoEADEstatisticasAction(){
        $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga($curso);
        $selectCurso = $em->getRepository("Base\Entity\Dados")->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('',$curso);
         $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\Aluno")->findByCurso($curso1);   
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(3);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        $mes = [];
         for($Count = 1 ;$Count<=12 ;$Count++){
                         $mes[$Count]=$em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVagaAndCursoVaga(date('Y'), $Count,$curso) ;           
         }
        
        return new ViewModel(
                array(
                    'getPages'=>$getPages,
                    'pageNumber'=>$pageNumber,
                    'count'=>$count,
                    'pagination'=>$pagination,
                    'listaVaga'=>$listaVaga,
                    'countListaTotalVaga'=> count($listaVaga),
                    'countListaAlunosCadastrados'=>count($listaAlunosCadastrados),
                    'countListaEstagiando'=>count($listaVagaEstagiando),
                    'countListaEncerrado'=>count($listaVaga) - count($listaVagaEstagiando),
                    'listaAlunosCadastrados'=>$listaAlunosCadastrados,
                    
                    'mensagem'=>$menstagem=   '<div class="alert-danger" style="margin: initial">
                        <br/>
                        <h4 style="text-align: center">Sem dados à apresentar!</h4><br/>      
                        </div>
                    <tr>',
                    'curso'=>$selectCurso,
                    'listaMensal'=>$mes
                    
                    )
                );
    }
}
    
