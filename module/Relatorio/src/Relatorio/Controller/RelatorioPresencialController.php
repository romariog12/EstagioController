<?php

namespace Relatorio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Aluno\Entity\AlunoPresencial;

class RelatorioPresencialController extends AbstractActionController {
    
    public function relatorioAction()
    {    $this->sairComumAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findAll();
            $findCurso = $em->getRepository("Aluno\Entity\AlunoPresencial")->findAll();
            $findEmpresa = $em->getRepository("Administrador\Entity\Empresa")->findAll();
            $recisaoRow = $em->getRepository("Vaga\Entity\VagaPresencial")->findByRecisao('');
            $findAgente = $em->getRepository("Administrador\Entity\Agente")->findAll();
            $listaContratos = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findAll();
            $listaCursos = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
            $quantidadeCursos = count($listaCursos);
            
                //....:::Quantidade de estágios por curso:::......
                $totalEstagioPorCurso = [];
                for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                    $totalEstagioPorCurso[$count] =  $em->getRepository("Vaga\Entity\VagaPresencial")->findBycursoVaga($count);
                }
           
                //........:::Estágios Em andamento por curso:::.............
                $estagiando = [];
                for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                $estagiando[$count] = $em->getRepository("Vaga\Entity\VagaPresencial")->findByRecisaoAndCursoVaga('',$count);
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
                '17'=> count($totalEstagioPorCurso['17']),
                '18'=> count($totalEstagioPorCurso['18']),
                '19'=> count($totalEstagioPorCurso['19']),
                '20'=> count($totalEstagioPorCurso['20']),
                '21'=> count($totalEstagioPorCurso['21']),
                '22'=> count($totalEstagioPorCurso['22']),
                '23'=> count($totalEstagioPorCurso['23']),
                '24'=> count($totalEstagioPorCurso['24']),
                '25'=> count($totalEstagioPorCurso['25']),
                '26'=> count($totalEstagioPorCurso['26']),
                '27'=> count($totalEstagioPorCurso['27']),
                '28'=> count($totalEstagioPorCurso['28']),
                '29'=> count($totalEstagioPorCurso['29']),
                '30'=> count($totalEstagioPorCurso['30']),
                '31'=> count($totalEstagioPorCurso['31']),
                '32'=> count($totalEstagioPorCurso['32']),
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
                 '17'=> count($estagiando['17']),
                '18'=> count($estagiando['18']),
                '19'=> count($estagiando['19']),
                '20'=> count($estagiando['20']),
                '21'=> count($estagiando['21']),
                '22'=> count($estagiando['22']),
                '23'=> count($estagiando['23']),
                '24'=> count($estagiando['24']),
                '25'=> count($estagiando['25']),
                '26'=> count($estagiando['26']),
                '27'=> count($estagiando['27']),
                '28'=> count($estagiando['28']),
                '29'=> count($estagiando['29']),
                '30'=> count($estagiando['30']),
                '31'=> count($estagiando['31']),
                '32'=> count($estagiando['32']),
                ],
            'listaCursos'=>$listaCursos
         
        ]);
 
   } 
     public function relatorioGraficoAction()
    {
        $this->sairComumAction();
                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");              
                $request = $this->getRequest();
                $lista = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
                $quantidadeCursos = count($lista);
               
                if($request->isPost()){
                        $ano = $request->getPost('ano');
                        $listaTodosCursos = $em->getRepository("Vaga\Entity\VagaPresencial")->findByanoVaga($ano);
                        $mes = [];
                        $cursoVagas = [];
                        $cursoTce = [];
                        $cursoTa = [];
                        $cursoInstituicao = [];
                        $cursoEmpresa = [];
                        
                         for($count = 1 ;$count<=12 ;$count++){
                         $mes[$count]=$em->getRepository("Vaga\Entity\VagaPresencial")->findByAnoVagaAndMesVaga($ano, $count) ;   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTce[$count] = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE',$count );   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTa[$count] = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA',$count );   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoInstituicao[$count] =  $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição', $count );  
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoEmpresa[$count] = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa', $count ); 
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoVagas[$count] = $em->getRepository("Vaga\Entity\VagaPresencial")->findByAnoVagaAndCursoVaga($ano, $count);   
                         }
                    $tce = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoVagaAndTipo ($ano, 'TCE' );
                    $ta = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoVagaAndTipo($ano,  'TA' );
                    $rt1Instituicao = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoVagaAndTipo ($ano, 'Instituição');
                    $rtEmpresa = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoVagaAndTipo ($ano, 'Empresa');
                
                    
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
                                '17' =>  count($cursoVagas[17]),
                                '18' =>  count($cursoVagas[18]),
                                '19' =>  count($cursoVagas[19]),
                                '20' =>  count($cursoVagas[20]),
                                '21' =>  count($cursoVagas[21]),
                                '22' =>  count($cursoVagas[22]),
                                '23' =>  count($cursoVagas[23]),
                                '24' =>  count($cursoVagas[24]),
                                '25' =>  count($cursoVagas[25]),
                                '26' =>  count($cursoVagas[26]),
                                '27' =>  count($cursoVagas[27]),
                                '28' =>  count($cursoVagas[28]),
                                '29' =>  count($cursoVagas[29]),
                                '30' =>  count($cursoVagas[30]),
                                '31' =>  count($cursoVagas[31]),
                                '32' =>  count($cursoVagas[32]),
                                
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
                                '17' =>  count($cursoTce[17]),
                                '18' =>  count($cursoTce[18]),
                                '19' =>  count($cursoTce[19]),
                                '20' =>  count($cursoTce[20]),
                                '21' =>  count($cursoTce[21]),
                                '22' =>  count($cursoTce[22]),
                                '23' =>  count($cursoTce[23]),
                                '24' =>  count($cursoTce[24]),
                                '25' =>  count($cursoTce[25]),
                                '26' =>  count($cursoTce[26]),
                                '27' =>  count($cursoTce[27]),
                                '28' =>  count($cursoTce[28]),
                                '29' =>  count($cursoTce[29]),
                                '30' =>  count($cursoTce[30]),
                                '31' =>  count($cursoTce[31]),
                                '32' =>  count($cursoTce[32]),
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
                                '17' =>  count($cursoTa[17]),
                                '18' =>  count($cursoTa[18]),
                                '19' =>  count($cursoTa[19]),
                                '20' =>  count($cursoTa[20]),
                                '21' =>  count($cursoTa[21]),
                                '22' =>  count($cursoTa[22]),
                                '23' =>  count($cursoTa[23]),
                                '24' =>  count($cursoTa[24]),
                                '25' =>  count($cursoTa[25]),
                                '26' =>  count($cursoTa[26]),
                                '27' =>  count($cursoTa[27]),
                                '28' =>  count($cursoTa[28]),
                                '29' =>  count($cursoTa[29]),
                                '30' =>  count($cursoTa[30]),
                                '31' =>  count($cursoTa[31]),
                                '32' =>  count($cursoTa[32]),
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
                                '17' =>  count($cursoInstituicao[17]),
                                '18' =>  count($cursoInstituicao[18]),
                                '19' =>  count($cursoInstituicao[19]),
                                '20' =>  count($cursoInstituicao[20]),
                                '21' =>  count($cursoInstituicao[21]),
                                '22' =>  count($cursoInstituicao[22]),
                                '23' =>  count($cursoInstituicao[23]),
                                '24' =>  count($cursoInstituicao[24]),
                                '25' =>  count($cursoInstituicao[25]),
                                '26' =>  count($cursoInstituicao[26]),
                                '27' =>  count($cursoInstituicao[27]),
                                '28' =>  count($cursoInstituicao[28]),
                                '29' =>  count($cursoInstituicao[29]),
                                '30' =>  count($cursoInstituicao[30]),
                                '31' =>  count($cursoInstituicao[31]),
                                '32' =>  count($cursoInstituicao[32]),
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
                                '17' =>  count($cursoEmpresa[17]),
                                '18' =>  count($cursoEmpresa[18]),
                                '19' =>  count($cursoEmpresa[19]),
                                '20' =>  count($cursoEmpresa[20]),
                                '21' =>  count($cursoEmpresa[21]),
                                '22' =>  count($cursoEmpresa[22]),
                                '23' =>  count($cursoEmpresa[23]),
                                '24' =>  count($cursoEmpresa[24]),
                                '25' =>  count($cursoEmpresa[25]),
                                '26' =>  count($cursoEmpresa[26]),
                                '27' =>  count($cursoEmpresa[27]),
                                '28' =>  count($cursoEmpresa[28]),
                                '29' =>  count($cursoEmpresa[29]),
                                '30' =>  count($cursoEmpresa[30]),
                                '31' =>  count($cursoEmpresa[31]),
                                '32' =>  count($cursoEmpresa[32]),
                            ],
                            'ano'=>$ano,          
                            'tceRow'=> count($tce),
                            'taRow'=> count($ta),
                            'rtInstituicaoRow'=> count($rt1Instituicao) ,
                            'rtEmpresa'=> count($rtEmpresa),                           
                        ]);
                        
                }else{
                        
                        $listaTodosCursos = $em->getRepository("Vaga\Entity\VagaPresencial")->findByanoVaga(date('Y'));
                        $mes = [];
                        $cursoVagas = [];
                        $cursoTce = [];
                        $cursoTa = [];
                        $cursoInstituicao = [];
                        $cursoEmpresa = [];
                        
                         for($count = 1 ;$count<=12 ;$count++){
                         $mes[$count]=$em->getRepository("Vaga\Entity\VagaPresencial")->findByAnoVagaAndMesVaga(date('Y'), $count) ;   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTce[$count] = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE',$count );   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTa[$count] = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA',$count );   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoInstituicao[$count] =  $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição', $count );  
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoEmpresa[$count] = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa', $count ); 
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoVagas[$count] = $em->getRepository("Vaga\Entity\VagaPresencial")->findByAnoVagaAndCursoVaga(date('Y'), $count);   
                         }
                    $tce = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoVagaAndTipo (date('Y'), 'TCE' );
                    $ta = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoVagaAndTipo(date('Y'),  'TA' );
                    $rt1Instituicao = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoVagaAndTipo (date('Y'), 'Instituição');
                    $rtEmpresa = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByAnoVagaAndTipo (date('Y'), 'Empresa');
                
                    
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
                                '17' =>  count($cursoVagas[17]),
                                '18' =>  count($cursoVagas[18]),
                                '19' =>  count($cursoVagas[19]),
                                '20' =>  count($cursoVagas[20]),
                                '21' =>  count($cursoVagas[21]),
                                '22' =>  count($cursoVagas[22]),
                                '23' =>  count($cursoVagas[23]),
                                '24' =>  count($cursoVagas[24]),
                                '25' =>  count($cursoVagas[25]),
                                '26' =>  count($cursoVagas[26]),
                                '27' =>  count($cursoVagas[27]),
                                '28' =>  count($cursoVagas[28]),
                                '29' =>  count($cursoVagas[29]),
                                '30' =>  count($cursoVagas[30]),
                                '31' =>  count($cursoVagas[31]),
                                '32' =>  count($cursoVagas[32]),
                                
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
                                '17' =>  count($cursoTce[17]),
                                '18' =>  count($cursoTce[18]),
                                '19' =>  count($cursoTce[19]),
                                '20' =>  count($cursoTce[20]),
                                '21' =>  count($cursoTce[21]),
                                '22' =>  count($cursoTce[22]),
                                '23' =>  count($cursoTce[23]),
                                '24' =>  count($cursoTce[24]),
                                '25' =>  count($cursoTce[25]),
                                '26' =>  count($cursoTce[26]),
                                '27' =>  count($cursoTce[27]),
                                '28' =>  count($cursoTce[28]),
                                '29' =>  count($cursoTce[29]),
                                '30' =>  count($cursoTce[30]),
                                '31' =>  count($cursoTce[31]),
                                '32' =>  count($cursoTce[32]),
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
                                '17' =>  count($cursoTa[17]),
                                '18' =>  count($cursoTa[18]),
                                '19' =>  count($cursoTa[19]),
                                '20' =>  count($cursoTa[20]),
                                '21' =>  count($cursoTa[21]),
                                '22' =>  count($cursoTa[22]),
                                '23' =>  count($cursoTa[23]),
                                '24' =>  count($cursoTa[24]),
                                '25' =>  count($cursoTa[25]),
                                '26' =>  count($cursoTa[26]),
                                '27' =>  count($cursoTa[27]),
                                '28' =>  count($cursoTa[28]),
                                '29' =>  count($cursoTa[29]),
                                '30' =>  count($cursoTa[30]),
                                '31' =>  count($cursoTa[31]),
                                '32' =>  count($cursoTa[32]),
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
                                '17' =>  count($cursoInstituicao[17]),
                                '18' =>  count($cursoInstituicao[18]),
                                '19' =>  count($cursoInstituicao[19]),
                                '20' =>  count($cursoInstituicao[20]),
                                '21' =>  count($cursoInstituicao[21]),
                                '22' =>  count($cursoInstituicao[22]),
                                '23' =>  count($cursoInstituicao[23]),
                                '24' =>  count($cursoInstituicao[24]),
                                '25' =>  count($cursoInstituicao[25]),
                                '26' =>  count($cursoInstituicao[26]),
                                '27' =>  count($cursoInstituicao[27]),
                                '28' =>  count($cursoInstituicao[28]),
                                '29' =>  count($cursoInstituicao[29]),
                                '30' =>  count($cursoInstituicao[30]),
                                '31' =>  count($cursoInstituicao[31]),
                                '32' =>  count($cursoInstituicao[32]),
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
                                '17' =>  count($cursoEmpresa[17]),
                                '18' =>  count($cursoEmpresa[18]),
                                '19' =>  count($cursoEmpresa[19]),
                                '20' =>  count($cursoEmpresa[20]),
                                '21' =>  count($cursoEmpresa[21]),
                                '22' =>  count($cursoEmpresa[22]),
                                '23' =>  count($cursoEmpresa[23]),
                                '24' =>  count($cursoEmpresa[24]),
                                '25' =>  count($cursoEmpresa[25]),
                                '26' =>  count($cursoEmpresa[26]),
                                '27' =>  count($cursoEmpresa[27]),
                                '28' =>  count($cursoEmpresa[28]),
                                '29' =>  count($cursoEmpresa[29]),
                                '30' =>  count($cursoEmpresa[30]),
                                '31' =>  count($cursoEmpresa[31]),
                                '32' =>  count($cursoEmpresa[32]),
                            ],
                            'ano'=> date('Y'),          
                            'tceRow'=> count($tce),
                            'taRow'=> count($ta),
                            'rtInstituicaoRow'=> count($rt1Instituicao) ,
                            'rtEmpresa'=> count($rtEmpresa),                           
                ]);
                        
                         }
    } 
   
    public function infoPresencialAction(){
         $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findBycursoVaga($curso);
        $selectCurso = $em->getRepository("Base\Entity\DadosPresencial")->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\VagaPresencial")->findByRecisaoAndCursoVaga('',$curso);
         $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByCurso($curso1);   
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        $mes = [];
         for($Count = 1 ;$Count<=12 ;$Count++){
                         $mes[$Count]=$em->getRepository("Vaga\Entity\VagaPresencial")->findByAnoVagaAndMesVagaAndCursoVaga(date('Y'), $Count,$curso) ;           
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
      public function infoPresencialEstagiandoAction(){
           $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findBycursoVaga($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\VagaPresencial")->findByRecisaoAndCursoVaga('',$curso);
        $selectCurso = $em->getRepository("Base\Entity\DadosPresencial")->findByIddados($curso);
        $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByCurso($curso1);
       
        
        
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
     
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
                    'countListaEncerrado'=>count($listaVaga) - count($listaVagaEstagiando),
                    'listaAlunosCadastrados'=>$listaAlunosCadastrados,
                    'mensagem'=>$menstagem=   '<div class="alert-danger" style="margin: initial">
                        <br/>
                        <h4 style="text-align: center">Sem dados à apresentar!</h4><br/>      
                        </div>
                    <tr>'
                    ,'curso'=>$selectCurso
                    )
                );
    }
     public function infoPresencialEncerradoAction(){
          $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findBycursoVaga($curso);
        $selectCurso = $em->getRepository("Base\Entity\DadosPresencial")->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\VagaPresencial")->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByCurso($curso1);
       
        
        
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
     
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
                    'countListaEncerrado'=>count($listaVaga) - count($listaVagaEstagiando),
                    'listaAlunosCadastrados'=>$listaAlunosCadastrados,
                    'mensagem'=>$menstagem =  '<div class="alert-danger" style="margin: initial">
                        <br/>
                        <h4 style="text-align: center">Sem dados à apresentar!</h4><br/>      
                        </div>
                    <tr>'
                    ,'curso'=>$selectCurso
                    )
                );
    }
    public function infoPresencialAlunosCadastradosAction(){
        $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        
        $request = $this->getRequest(); 
            
        
        
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findBycursoVaga($curso);
        $selectCurso = $em->getRepository("Base\Entity\DadosPresencial")->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\VagaPresencial")->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByCurso($curso1);
       
        
        
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaAlunosCadastrados));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(10);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        if($request->isPost()){
                $data = $this->params()->fromPost();
                $aluno = new AlunoPresencial(); 

                switch ($data['buscar']){
                    case 'buscarPorMatricula':
                            $matricula = $request->getPost('porMatricula');
                            $aluno->setMatricula($matricula);
                            $lista = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByMatriculaAndCurso($aluno->getMatricula(), $curso1);
                            break;
                    case 'buscarPorNome':
                            $nome = $request->getPost('porNome');
                            $aluno->setNome($nome);
                            $lista = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByNomeAndCurso($aluno->getNome(), $curso1);
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
     public function infoEstatisticasAction(){
        $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findBycursoVaga($curso);
        $selectCurso = $em->getRepository("Base\Entity\DadosPresencial")->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository("Vaga\Entity\VagaPresencial")->findByRecisaoAndCursoVaga('',$curso);
         $listaAlunosCadastrados = $em->getRepository("Aluno\Entity\AlunoPresencial")->findByCurso($curso1);   
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)->setDefaultItemCountPerPage(3);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        $mes = [];
         for($Count = 1 ;$Count<=12 ;$Count++){
                         $mes[$Count]=$em->getRepository("Vaga\Entity\VagaPresencial")->findByAnoVagaAndMesVagaAndCursoVaga(date('Y'), $Count,$curso) ;           
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
    
