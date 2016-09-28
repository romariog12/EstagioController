<?php

namespace Relatorio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class RelatorioEADController extends AbstractActionController {
    
    public function relatorioAction()
    {$this->sairAction();   
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findAll();
            $findCurso = $em->getRepository("Usuario\Entity\Aluno")->findAll();
            $findEmpresa = $em->getRepository("Usuario\Entity\Empresa")->findAll();
            $recisaoRow = $em->getRepository("Vaga\Entity\Vaga")->findByRecisao('');
            $findAgente = $em->getRepository("Usuario\Entity\Agente")->findAll();
            $listaContratos = $em->getRepository("Vaga\Entity\Encaminhamento")->findAll();
            $listaCursos = $em->getRepository("Base\Entity\Dados")->findAll();
            
                //....:::Quantidade de estágios por curso:::......
                $totalEstagioPorCurso = [];
                for($count = 1 ;$count<=16 ;$count++){
                    $totalEstagioPorCurso[$count] =  $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga($count);
                }
           
                //........:::Estágios Em andamento por curso:::.............
                $estagiando = [];
                for($count = 1 ;$count<=16 ;$count++){
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
    {$this->sairAction();
       
                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");              
                $request = $this->getRequest();
                if($request->isPost()){
                $ano = $request->getPost('ano');
                $listaTodosCursos = $em->getRepository("Vaga\Entity\Vaga")->findByanoVaga($ano);
                 $janeiro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano, '01') ;
                        $fevereiro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'02');
                        $marco = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'03');
                        $abril = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'04');
                        $maio = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'05');
                        $junho = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'06');
                        $julho = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'07');
                        $agosto = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'08');
                        $setembro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'09');
                        $outubro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'10');
                        $novembro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'11');
                        $dezembro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga($ano,'12');

       
                                $administracao = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'1');
                                $pedagogia = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'2');
                                $rh = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'3');
                                $turismo = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'4');
                                $gti = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'5');
                                $ads = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'6');
                                $contabeis = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'7');
                                $economia = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'8');
                                $filosofia = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'9');
                                $gestaoPublica = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'10');
                                $gestaoComercio= $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'11');
                                $gestaoFinanceira = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'12');
                                $letras = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'13');
                                $proform = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'14');
                                $segurancaInformacao = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'15');
                                $segurancaPublica = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga($ano,'16');
                 
            
                    $administracaoTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','1' );
                    $administracaoTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','1' );
                    $administracaoInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','1' );
                    $administracaoEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','1' );
                    
                    $pedagogiaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','2' );
                    $pedagogiaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','2' );
                    $pedagogiaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','2' );
                    $pedagogiaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','2' );
                    
                    $rhTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','3' );
                    $rhTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','3' );
                    $rhInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','3' );
                    $rhEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','3' );
                    
                    $turismoTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','4' );
                    $turismoTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','4' );
                    $turismoInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','4' );
                    $turismoEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','4' );
                    
                    $gtiTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','5' );
                    $gtiTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','5' );
                    $gtiInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','5' );
                    $gtiEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','5' );
                    
                    $adsTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','6' );
                    $adsTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','6' );
                    $adsInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','6' );
                    $adsEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','6' );
                    
                    $contabeisTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','7' );
                    $contabeisTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','7' );
                    $contabeisInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','7' );
                    $contabeisEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','7' );
                    
                    $economiaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','8' );
                    $economiaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','8' );
                    $economiaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','8' );
                    $economiaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','8' );
                    
                    $filosofiaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','9' );
                    $filosofiaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','9' );
                    $filosofiaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','9' );
                    $filosofiaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','9' );
                    
                    $gestaoPublicaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','10' );
                    $gestaoPublicaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','10' );
                    $gestaoPublicaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','10' );
                    $gestaoPublicaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','10' );
                    
                    $gestaoComercioTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','11' );
                    $gestaoComercioTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','11' );
                    $gestaoComercioInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','11' );
                    $gestaoComercioEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','11' );
                    
                    $gestaoFinanceiraTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','12' );
                    $gestaoFinanceiraTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','12' );
                    $gestaoFinanceiraInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','12' );
                    $gestaoFinanceiraEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','12' );
                    
                    $letrasTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','13' );
                    $letrasTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','13' );
                    $letrasInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','13' );
                    $letrasEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','13' );
                    
                    $proformTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','14' );
                    $proformTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','14' );
                    $proformInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','14' );
                    $proformEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','14' );
                    
                    $segurancaInformacaoTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','15' );
                    $segurancaInformacaoTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','15' );
                    $segurancaInformacaoInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','15' );
                    $segurancaInformacaoEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','15' );
                    
                    $segurancaPublicaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE','16' );
                    $segurancaPublicaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA','16' );
                    $segurancaPublicaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Instituição','16' );
                    $segurancaPublicaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso ($ano, 'Empresa','16' );
                    
                    //Documentos discriminados
                    
                    $tce = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo ($ano, 'TCE' );
                    $ta = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo($ano,  'TA' );
                    $rt1Instituicao = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo ($ano, 'Instituição');
                    $rtEmpresa = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo ($ano, 'Empresa');
                
                    
                        return new ViewModel([
                             
                                'rowTodosCursos'=> count($listaTodosCursos),
                                'janeiro' =>  count( $janeiro),
                                'fevereiro' => count($fevereiro),
                                'marco' => count( $marco), 
                                'abril' =>count( $abril),
                                'maio'=> count( $maio), 
                                'junho' => count( $junho),
                                'julho' =>count($julho),
                                'agosto' => count(  $agosto), 
                                'setembro'=>count($setembro),
                                'outubro'=> count(  $outubro), 
                                'novembro'=>count( $novembro), 
                                'dezembro'=>count($dezembro),                 
                                'ano'=>$ano,   
                                'administracao' => count($administracao),
                                'pedagogia' => count($pedagogia),
                                'rh' => count($rh), 
                                'turismo' =>count($turismo),
                                'gti'=>count($gti), 
                                'ads' =>count($ads),
                                'contabeis' =>count( $contabeis), 
                                'economia'=>count( $economia),
                                'filosofia'=>count($filosofia), 
                                'gestaoPublica'=>count( $gestaoPublica), 
                                'gestaoComercio'=>count( $gestaoComercio),
                                'gestaoFinanceira'=>count($gestaoFinanceira), 
                                'letras'=>count( $letras) ,
                                'proform'=>count($proform) ,
                                'segurancaInformacao'=>count($segurancaInformacao), 
                                'segurancaPublica'=>count($segurancaPublica),
                                
                            'tceRow'=> count($tce),
                                'taRow'=> count($ta),
                                'rtInstituicaoRow'=> 
                                    count($rt1Instituicao) ,
                                'rtEmpresa'=>
                                    count($rtEmpresa),
                            'administracaoTceRow'=> count($administracaoTce),
                            'administracaoTaRow'=> count($administracaoTa),
                            'administracaoInstituicaoRow'=> count($administracaoInstituicao),
                            'administracaoEmpresaRow'=> count($administracaoEmpresa),
                            
                            'pedagogiaTceRow'=> count($pedagogiaTce),
                            'pedagogiaTaRow'=> count($pedagogiaTa),
                            'pedagogiaInstituicaoRow'=> count($pedagogiaInstituicao),
                            'pedagogiaEmpresaRow'=> count($pedagogiaEmpresa),
                            
                            'rhTceRow'=> count($rhTce),
                            'rhTaRow'=> count($rhTa),
                            'rhInstituicaoRow'=> count($rhInstituicao),
                            'rhEmpresaRow'=> count($rhEmpresa),
                            
                            'turismoTceRow'=> count($turismoTce),
                            'turismoTaRow'=> count($turismoTa),
                            'turismoInstituicaoRow'=> count($turismoInstituicao),
                            'turismoEmpresaRow'=> count($turismoEmpresa),
                            
                            'gtiTceRow'=> count($gtiTce),
                            'gtiTaRow'=> count($gtiTa),
                            'gtiInstituicaoRow'=> count($gtiInstituicao),
                            'gtiEmpresaRow'=> count($gtiEmpresa),
                            
                            'adsTceRow'=> count($adsTce),
                            'adsTaRow'=> count($adsTa),
                            'adsInstituicaoRow'=> count($adsInstituicao),
                            'adsEmpresaRow'=> count($adsEmpresa),
                            
                            'contabeisTceRow'=> count($contabeisTce),
                            'contabeisTaRow'=> count($contabeisTa),
                            'contabeisInstituicaoRow'=> count($contabeisInstituicao),
                            'contabeisEmpresaRow'=> count($contabeisEmpresa),
                            
                            'economiaTceRow'=> count($economiaTce),
                            'economiaTaRow'=> count($economiaTa),
                            'economiaInstituicaoRow'=> count($economiaInstituicao),
                            'economiaEmpresaRow'=> count($economiaEmpresa),
                            
                            'filosofiaTceRow'=> count($filosofiaTce),
                            'filosofiaTaRow'=> count($filosofiaTa),
                            'filosofiaInstituicaoRow'=> count($filosofiaInstituicao),
                            'filosofiaEmpresaRow'=> count($filosofiaEmpresa),
                            
                            'gestaoPublicaTceRow'=> count($gestaoPublicaTce),
                            'gestaoPublicaTaRow'=> count($gestaoPublicaTa),
                            'gestaoPublicaInstituicaoRow'=> count($gestaoPublicaInstituicao),
                            'gestaoPublicaEmpresaRow'=> count($gestaoPublicaEmpresa),
                            
                            'gestaoComercioTceRow'=> count($gestaoComercioTce),
                            'gestaoComercioTaRow'=> count($gestaoComercioTa),
                            'gestaoComercioInstituicaoRow'=> count($gestaoComercioInstituicao),
                            'gestaoComercioEmpresaRow'=> count($gestaoComercioEmpresa),
                            
                            'gestaoFinanceiraTceRow'=> count($gestaoFinanceiraTce),
                            'gestaoFinanceiraTaRow'=> count($gestaoFinanceiraTa),
                            'gestaoFinanceiraInstituicaoRow'=> count($gestaoFinanceiraInstituicao),
                            'gestaoFinanceiraEmpresaRow'=> count($gestaoFinanceiraEmpresa),
                            
                            'letrasTceRow'=> count($letrasTce),
                            'letrasTaRow'=> count($letrasTa),
                            'letrasInstituicaoRow'=> count($letrasInstituicao),
                            'letrasEmpresaRow'=> count($letrasEmpresa),
                            
                            'proformTceRow'=> count($proformTce),
                            'proformTaRow'=> count($proformTa),
                            'proformInstituicaoRow'=> count($proformInstituicao),
                            'proformEmpresaRow'=> count($proformEmpresa),
                            
                            'segurancaInformacaoTceRow'=> count($segurancaInformacaoTce),
                            'segurancaInformacaoTaRow'=> count($segurancaInformacaoTa),
                            'segurancaInformacaoInstituicaoRow'=> count($segurancaInformacaoInstituicao),
                            'segurancaInformacaoEmpresaRow'=> count($segurancaInformacaoEmpresa),
                            
                            'segurancaPublicaTceRow'=> count($segurancaPublicaTce),
                            'segurancaPublicaTaRow'=> count($segurancaPublicaTa),
                            'segurancaPublicaInstituicaoRow'=> count($segurancaPublicaInstituicao),
                            'segurancaPublicaEmpresaRow'=> count($segurancaPublicaEmpresa),
                                                        

                                                        
                        ]);
                        
                }else{
                        
                        $listaTodosCursos = $em->getRepository("Vaga\Entity\Vaga")->findByanoVaga(date('Y'));
                        $janeiro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'), '01') ;
                        $fevereiro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'02');
                        $marco = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'03');
                        $abril = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'04');
                        $maio = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'05');
                        $junho = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'06');
                        $julho = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'07');
                        $agosto = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'08');
                        $setembro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'09');
                        $outubro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'10');
                        $novembro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'11');
                        $dezembro = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndMesVaga(date('Y'),'12');
  
                               $administracao = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'1');
                                $pedagogia = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'2');
                                $rh = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'3');
                                $turismo = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'4');
                                $gti = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'5');
                                $ads = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'6');
                                $contabeis = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'7');
                                $economia = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'8');
                                $filosofia = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'9');
                                $gestaoPublica = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'10');
                                $gestaoComercio= $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'11');
                                $gestaoFinanceira = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'12');
                                $letras = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'13');
                                $proform = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'14');
                                $segurancaInformacao = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'15');
                                $segurancaPublica = $em->getRepository("Vaga\Entity\Vaga")->findByAnoVagaAndCursoVaga(date('Y'),'16');
                                     $rtEmpresa = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo (date('Y'), 'Empresa');
                
                                $tce = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo(date('Y'), 'TCE' );
                                    $ta = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo(date('Y'),  'TA' );
                                    $rt1Instituicao = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoVagaAndTipo(date('Y'), '1º RT (Instituição)');
                             
                    $administracaoTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','1' );
                    $administracaoTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','1' );
                    $administracaoInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','1' );
                    $administracaoEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','1' );
                    
                    $pedagogiaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','2' );
                    $pedagogiaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','2' );
                    $pedagogiaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','2' );
                    $pedagogiaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','2' );
                    
                    $rhTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','3' );
                    $rhTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','3' );
                    $rhInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','3' );
                    $rhEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','3' );
                    
                    $turismoTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','4' );
                    $turismoTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','4' );
                    $turismoInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','4' );
                    $turismoEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','4' );
                    
                    $gtiTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','5' );
                    $gtiTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','5' );
                    $gtiInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','5' );
                    $gtiEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','5' );
                    
                    $adsTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','6' );
                    $adsTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','6' );
                    $adsInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','6' );
                    $adsEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','6' );
                    
                    $contabeisTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','7' );
                    $contabeisTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','7' );
                    $contabeisInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','7' );
                    $contabeisEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','7' );
                    
                    $economiaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','8' );
                    $economiaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','8' );
                    $economiaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','8' );
                    $economiaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','8' );
                    
                    $filosofiaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','9' );
                    $filosofiaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','9' );
                    $filosofiaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','9' );
                    $filosofiaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','9' );
                    
                    $gestaoPublicaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','10' );
                    $gestaoPublicaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','10' );
                    $gestaoPublicaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','10' );
                    $gestaoPublicaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','10' );
                    
                    $gestaoComercioTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','11' );
                    $gestaoComercioTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','11' );
                    $gestaoComercioInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','11' );
                    $gestaoComercioEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','11' );
                    
                    $gestaoFinanceiraTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','12' );
                    $gestaoFinanceiraTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','12' );
                    $gestaoFinanceiraInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','12' );
                    $gestaoFinanceiraEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','12' );
                    
                    $letrasTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','13' );
                    $letrasTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','13' );
                    $letrasInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','13' );
                    $letrasEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','13' );
                    
                    $proformTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','14' );
                    $proformTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','14' );
                    $proformInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','14' );
                    $proformEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','14' );
                    
                    $segurancaInformacaoTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','15' );
                    $segurancaInformacaoTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','15' );
                    $segurancaInformacaoInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','15' );
                    $segurancaInformacaoEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','15' );
                    
                    $segurancaPublicaTce  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE','16' );
                    $segurancaPublicaTa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA','16' );
                    $segurancaPublicaInstituicao  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Instituição','16' );
                    $segurancaPublicaEmpresa  = $em->getRepository("Vaga\Entity\Encaminhamento")->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'Empresa','16' );
                    
             return new ViewModel([
                                'rowTodosCursos'=> count($listaTodosCursos),
                                'janeiro' =>  count( $janeiro),
                                'fevereiro' => count($fevereiro),
                                'marco' => count( $marco), 
                                'abril' =>count( $abril),
                                'maio'=> count( $maio), 
                                'junho' => count( $junho),
                                'julho' =>count($julho),
                                'agosto' => count(  $agosto), 
                                'setembro'=>count($setembro),
                                'outubro'=> count(  $outubro), 
                                'novembro'=>count( $novembro), 
                                'dezembro'=>count($dezembro),                 
                                'ano'=> date('Y'),   
                                'administracao' => count($administracao),
                                'pedagogia' => count($pedagogia),
                                'rh' => count($rh), 
                                'turismo' =>count($turismo),
                                'gti'=>count($gti), 
                                'ads' =>count($ads),
                                'contabeis' =>count( $contabeis), 
                                'economia'=>count( $economia),
                                'filosofia'=>count($filosofia), 
                                'gestaoPublica'=>count( $gestaoPublica), 
                                'gestaoComercio'=>count( $gestaoComercio),
                                'gestaoFinanceira'=>count($gestaoFinanceira), 
                                'letras'=>count( $letras) ,
                                'proform'=>count($proform) ,
                                'segurancaInformacao'=>count($segurancaInformacao), 
                                'segurancaPublica'=>count($segurancaPublica),
                 
                                'tceRow'=> count($tce),
                                'taRow'=> count($ta),
                                'rtInstituicaoRow'=> 
                                    count($rt1Instituicao) ,
                                'rtEmpresa'=>
                                    count($rtEmpresa),
                            'administracaoTceRow'=> count($administracaoTce),
                            'administracaoTaRow'=> count($administracaoTa),
                            'administracaoInstituicaoRow'=> count($administracaoInstituicao),
                            'administracaoEmpresaRow'=> count($administracaoEmpresa),
                            
                            'pedagogiaTceRow'=> count($pedagogiaTce),
                            'pedagogiaTaRow'=> count($pedagogiaTa),
                            'pedagogiaInstituicaoRow'=> count($pedagogiaInstituicao),
                            'pedagogiaEmpresaRow'=> count($pedagogiaEmpresa),
                            
                            'rhTceRow'=> count($rhTce),
                            'rhTaRow'=> count($rhTa),
                            'rhInstituicaoRow'=> count($rhInstituicao),
                            'rhEmpresaRow'=> count($rhEmpresa),
                            
                            'turismoTceRow'=> count($turismoTce),
                            'turismoTaRow'=> count($turismoTa),
                            'turismoInstituicaoRow'=> count($turismoInstituicao),
                            'turismoEmpresaRow'=> count($turismoEmpresa),
                            
                            'gtiTceRow'=> count($gtiTce),
                            'gtiTaRow'=> count($gtiTa),
                            'gtiInstituicaoRow'=> count($gtiInstituicao),
                            'gtiEmpresaRow'=> count($gtiEmpresa),
                            
                            'adsTceRow'=> count($adsTce),
                            'adsTaRow'=> count($adsTa),
                            'adsInstituicaoRow'=> count($adsInstituicao),
                            'adsEmpresaRow'=> count($adsEmpresa),
                            
                            'contabeisTceRow'=> count($contabeisTce),
                            'contabeisTaRow'=> count($contabeisTa),
                            'contabeisInstituicaoRow'=> count($contabeisInstituicao),
                            'contabeisEmpresaRow'=> count($contabeisEmpresa),
                            
                            'economiaTceRow'=> count($economiaTce),
                            'economiaTaRow'=> count($economiaTa),
                            'economiaInstituicaoRow'=> count($economiaInstituicao),
                            'economiaEmpresaRow'=> count($economiaEmpresa),
                            
                            'filosofiaTceRow'=> count($filosofiaTce),
                            'filosofiaTaRow'=> count($filosofiaTa),
                            'filosofiaInstituicaoRow'=> count($filosofiaInstituicao),
                            'filosofiaEmpresaRow'=> count($filosofiaEmpresa),
                            
                            'gestaoPublicaTceRow'=> count($gestaoPublicaTce),
                            'gestaoPublicaTaRow'=> count($gestaoPublicaTa),
                            'gestaoPublicaInstituicaoRow'=> count($gestaoPublicaInstituicao),
                            'gestaoPublicaEmpresaRow'=> count($gestaoPublicaEmpresa),
                            
                            'gestaoComercioTceRow'=> count($gestaoComercioTce),
                            'gestaoComercioTaRow'=> count($gestaoComercioTa),
                            'gestaoComercioInstituicaoRow'=> count($gestaoComercioInstituicao),
                            'gestaoComercioEmpresaRow'=> count($gestaoComercioEmpresa),
                            
                            'gestaoFinanceiraTceRow'=> count($gestaoFinanceiraTce),
                            'gestaoFinanceiraTaRow'=> count($gestaoFinanceiraTa),
                            'gestaoFinanceiraInstituicaoRow'=> count($gestaoFinanceiraInstituicao),
                            'gestaoFinanceiraEmpresaRow'=> count($gestaoFinanceiraEmpresa),
                            
                            'letrasTceRow'=> count($letrasTce),
                            'letrasTaRow'=> count($letrasTa),
                            'letrasInstituicaoRow'=> count($letrasInstituicao),
                            'letrasEmpresaRow'=> count($letrasEmpresa),
                            
                            'proformTceRow'=> count($proformTce),
                            'proformTaRow'=> count($proformTa),
                            'proformInstituicaoRow'=> count($proformInstituicao),
                            'proformEmpresaRow'=> count($proformEmpresa),
                            
                            'segurancaInformacaoTceRow'=> count($segurancaInformacaoTce),
                            'segurancaInformacaoTaRow'=> count($segurancaInformacaoTa),
                            'segurancaInformacaoInstituicaoRow'=> count($segurancaInformacaoInstituicao),
                            'segurancaInformacaoEmpresaRow'=> count($segurancaInformacaoEmpresa),
                            
                            'segurancaPublicaTceRow'=> count($segurancaPublicaTce),
                            'segurancaPublicaTaRow'=> count($segurancaPublicaTa),
                            'segurancaPublicaInstituicaoRow'=> count($segurancaPublicaInstituicao),
                            'segurancaPublicaEmpresaRow'=> count($segurancaPublicaEmpresa),
                        ]);
       
                }
    } 
   public function infoEADAction(){
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $curso = $this->params()->fromRoute("curso", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga($curso);
        $selectCurso = $em->getRepository("Base\Entity\Dados")->findByIddados($curso);
       
        
        
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
                    'mensagem'=>$menstagem=  '<p class="navbar-brand" style="color: red">Nenhuma dado encontrado!</p>'
                    ,'curso'=>$selectCurso
                    )
                );
    }
}
    
