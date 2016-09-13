<?php

namespace Relatorio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RelatorioController extends AbstractActionController {
    
    public function relatorioAction()
    {$this->sairAction();
       
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findAll();
            $findCurso = $em->getRepository("Usuario\Entity\Aluno")->findAll();
            $findEmpresa = $em->getRepository("Usuario\Entity\Empresa")->findAll();
            $recisaoRow = $em->getRepository("Vaga\Entity\Vaga")->findByRecisao('');
            $findAgente = $em->getRepository("Usuario\Entity\Agente")->findAll();
            $listaContratos = $em->getRepository("Vaga\Entity\Encaminhamento")->findAll();
            $row = count($findCurso);
            $rowRecisao= count($recisaoRow);
            $rowEmpresa = count($findEmpresa);
            $rowVaga = count($listaVaga);
            $rowAgente = count($findAgente);
            $rowContratosEncerrados = $rowVaga - $rowRecisao;
            $rowContratos = count($listaContratos);
           
                //....:::Quantidade de estágios por curso:::......
                $administracao = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('1');
                $pedagogia = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('2');
                $rh = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('3');
                $turismo = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('4');
                $gti = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('5');
                $ads = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('6');
                $contabeis = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('7');
                $economia = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('8');
                $filosofia = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('9');
                $gestaoPublica = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('10');
                $gestaoComercio= $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('11');
                $gestaoFinanceira = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('12');
                $letras = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('13');
                $proform = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('14');
                $segurancaInformacao = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('15');
                $segurancaPublica = $em->getRepository("Vaga\Entity\Vaga")->findBycursoVaga('16');
            
                    $administracaoRow = count($administracao);
                    $pedagogiaRow= count($pedagogia);
                    $rhRow = count($rh);
                    $turismoRow= count($turismo);
                    $gtiRow = count($gti);
                    $adsRow= count($ads);
                    $contabeisRow = count( $contabeis);
                    $economiaRow = count( $economia);
                    $filosofiaRow = count($filosofia);
                    $gestaoPublicaRow = count( $gestaoPublica);
                    $gestaoComercioRow= count( $gestaoComercio);
                    $gestaoFinanceiraRow = count($gestaoFinanceira);
                    $letrasRow = count( $letras);
                    $proformRow = count($proform);
                    $segurancaInformacaoRow = count($segurancaInformacao);
                    $segurancaPublicaRow = count($segurancaPublica);  
                    
                    //........:::Estágios Em andamento por curso:::.............
                $administracaoOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','1');
                $pedagogiaOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','2');
                $rhOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','3');
                $turismoOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','4');
                $gtiOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','5');
                $adsOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','6');
                $contabeisOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','7');
                $economiaOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','8');
                $filosofiaOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','9');
                $gestaoPublicaOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','10');
                $gestaoComercioOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','11');
                $gestaoFinanceiraOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','12');
                $letrasOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','13');
                $proformOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','14');
                $segurancaInformacaoOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','15');
                $segurancaPublicaOn = $em->getRepository("Vaga\Entity\Vaga")->findByRecisaoAndCursoVaga('','16');
            
                    $administracaoOnRow = count($administracaoOn);
                    $pedagogiaOnRow= count($pedagogiaOn);
                    $rhOnRow = count($rhOn);
                    $turismoOnRow= count($turismoOn);
                    $gtiOnRow = count($gtiOn);
                    $adsOnRow= count($adsOn);
                    $contabeisOnRow = count( $contabeisOn);
                    $economiaOnRow = count( $economiaOn);
                    $filosofiaOnRow = count($filosofiaOn);
                    $gestaoPublicaOnRow = count( $gestaoPublicaOn);
                    $gestaoComercioOnRow= count( $gestaoComercioOn);
                    $gestaoFinanceiraOnRow = count($gestaoFinanceiraOn);
                    $letrasOnRow = count( $letrasOn);
                    $proformOnRow = count($proformOn);
                    $segurancaInformacaoOnRow = count($segurancaInformacaoOn);
                    $segurancaPublicaOnRow = count($segurancaPublicaOn);
                    
                    
            //..........:::Estágios por mes:::...... 
                    
                        
    
        return new ViewModel([
            'fetchRow'=>$findCurso,
            'row'=> $row,
            'recisaoRow'=>$rowRecisao,
            'rowEmpresa' =>$rowEmpresa,
            'rowVaga'=>$rowVaga,
            'rowAgente'=>$rowAgente,
            'rowContratosEncerrados'=>$rowContratosEncerrados,
            'rowContratos'=>$rowContratos,
            
            //....:::Quantidade de Estágios:::......
                'administracao' =>   $administracaoRow,
                'pedagogia' =>  $pedagogiaRow,
                'rh' => $rhRow, 
                'turismo' =>$turismoRow,
                'gti'=>$gtiRow, 
                'ads' =>$adsRow,
                'contabeis' =>$contabeisRow, 
                'economia'=>$economiaRow,
                'filosofia'=>$filosofiaRow, 
                'gestaoPublica'=>$gestaoPublicaRow, 
                'gestaoComercio'=>$gestaoComercioRow,
                'gestaoFinanceira'=>$gestaoFinanceiraRow, 
                'letras'=>$letrasRow ,
                'proform'=>$proformRow ,
                'segurancaInformacao'=>$segurancaInformacaoRow, 
                'segurancaPublica'=>$segurancaPublicaRow ,
                
             //........:::Estágios Em andamento:::.............
                'administracaoOn' =>   $administracaoOnRow,
                'pedagogiaOn' =>  $pedagogiaOnRow,
                'rhOn' => $rhOnRow, 
                'turismoOn' =>$turismoOnRow,
                'gtiOn'=>$gtiOnRow, 
                'adsOn' =>$adsOnRow,
                'contabeisOn' =>$contabeisOnRow, 
                'economiaOn'=>$economiaOnRow,
                'filosofiaOn'=>$filosofiaOnRow, 
                'gestaoPublicaOn'=>$gestaoPublicaOnRow, 
                'gestaoComercioOn'=>$gestaoComercioOnRow,
                'gestaoFinanceiraOn'=>$gestaoFinanceiraOnRow, 
                'letrasOn'=>$letrasOnRow ,
                'proformOn'=>$proformOnRow ,
                'segurancaInformacaoOn'=>$segurancaInformacaoOnRow, 
                'segurancaPublicaOn'=>$segurancaPublicaOnRow ,
            //..............:::Estágios por mes:::................
            
           
                
        ]);
 
   }
   
     public function relatorioGraficoAction()
    {$this->sairAction();
       
              $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");      
                    
            //..........:::Estágios por mes:::...... 
              
                     $request = $this->getRequest();
   
                if($request->isPost()){
                $ano = $request->getPost('ano');
                        
                        
                  //....:::Quantidade de estágios por curso:::......
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

                            $janeiroRow = count( $janeiro);
                            $fevereiroRow= count($fevereiro);
                            $marcoRow = count( $marco);
                            $abrilRow= count( $abril);
                            $maioRow = count( $maio);
                            $junhoRow= count( $junho);
                            $julhoRow = count($julho);
                            $agostoRow = count(  $agosto);
                            $setembroRow = count($setembro);
                            $outubroRow = count(  $outubro);
                            $novembroRow= count( $novembro);
                            $dezembroRow = count($dezembro);
                            $rowTodosCursos = count($listaTodosCursos);
                            
                            
                            
                            
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

                                    $administracaoRow = count($administracao);
                                    $pedagogiaRow= count($pedagogia);
                                    $rhRow = count($rh);
                                    $turismoRow= count($turismo);
                                    $gtiRow = count($gti);
                                    $adsRow= count($ads);
                                    $contabeisRow = count( $contabeis);
                                    $economiaRow = count( $economia);
                                    $filosofiaRow = count($filosofia);
                                    $gestaoPublicaRow = count( $gestaoPublica);
                                    $gestaoComercioRow= count( $gestaoComercio);
                                    $gestaoFinanceiraRow = count($gestaoFinanceira);
                                    $letrasRow = count( $letras);
                                    $proformRow = count($proform);
                                    $segurancaInformacaoRow = count($segurancaInformacao);
                                    $segurancaPublicaRow = count($segurancaPublica); 
                        
                
                        return new ViewModel([
                            
                            'rowTodosCursos'=>$rowTodosCursos,
                                
                                
                                'janeiro' =>   $janeiroRow,
                                'fevereiro' =>  $fevereiroRow,
                                'marco' => $marcoRow, 
                                'abril' =>$abrilRow,
                                'maio'=>$maioRow, 
                                'junho' =>$junhoRow,
                                'julho' => $julhoRow,
                                'agosto' =>$agostoRow, 
                                'setembro'=>$setembroRow,
                                'outubro'=>$outubroRow, 
                                'novembro'=>$novembroRow, 
                                'dezembro'=>$dezembroRow,
                            
                            'ano'=>$ano,
                                
                                
                                'administracao' =>   $administracaoRow,
                                'pedagogia' =>  $pedagogiaRow,
                                'rh' => $rhRow, 
                                'turismo' =>$turismoRow,
                                'gti'=>$gtiRow, 
                                'ads' =>$adsRow,
                                'contabeis' =>$contabeisRow, 
                                'economia'=>$economiaRow,
                                'filosofia'=>$filosofiaRow, 
                                'gestaoPublica'=>$gestaoPublicaRow, 
                                'gestaoComercio'=>$gestaoComercioRow,
                                'gestaoFinanceira'=>$gestaoFinanceiraRow, 
                                'letras'=>$letrasRow ,
                                'proform'=>$proformRow ,
                                'segurancaInformacao'=>$segurancaInformacaoRow, 
                                'segurancaPublica'=>$segurancaPublicaRow ,
                                
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

                            $janeiroRow = count( $janeiro);
                            $fevereiroRow= count($fevereiro);
                            $marcoRow = count( $marco);
                            $abrilRow= count( $abril);
                            $maioRow = count( $maio);
                            $junhoRow= count( $junho);
                            $julhoRow = count($julho);
                            $agostoRow = count(  $agosto);
                            $setembroRow = count($setembro);
                            $outubroRow = count(  $outubro);
                            $novembroRow= count( $novembro);
                            $dezembroRow = count($dezembro);
                            $rowTodosCursos = count($listaTodosCursos);
                    
                    
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

                                    $administracaoRow = count($administracao);
                                    $pedagogiaRow= count($pedagogia);
                                    $rhRow = count($rh);
                                    $turismoRow= count($turismo);
                                    $gtiRow = count($gti);
                                    $adsRow= count($ads);
                                    $contabeisRow = count( $contabeis);
                                    $economiaRow = count( $economia);
                                    $filosofiaRow = count($filosofia);
                                    $gestaoPublicaRow = count( $gestaoPublica);
                                    $gestaoComercioRow= count( $gestaoComercio);
                                    $gestaoFinanceiraRow = count($gestaoFinanceira);
                                    $letrasRow = count( $letras);
                                    $proformRow = count($proform);
                                    $segurancaInformacaoRow = count($segurancaInformacao);
                                    $segurancaPublicaRow = count($segurancaPublica);
                    
             return new ViewModel([
                          
                                
                                'rowTodosCursos'=>$rowTodosCursos,
                                'janeiro' =>   $janeiroRow,
                                'fevereiro' =>  $fevereiroRow,
                                'marco' => $marcoRow, 
                                'abril' =>$abrilRow,
                                'maio'=>$maioRow, 
                                'junho' =>$junhoRow,
                                'julho' => $julhoRow,
                                'agosto' =>$agostoRow, 
                                'setembro'=>$setembroRow,
                                'outubro'=>$outubroRow, 
                                'novembro'=>$novembroRow, 
                                'dezembro'=>$dezembroRow,
                                
                                
                                'administracao' =>   $administracaoRow,
                                'pedagogia' =>  $pedagogiaRow,
                                'rh' => $rhRow, 
                                'turismo' =>$turismoRow,
                                'gti'=>$gtiRow, 
                                'ads' =>$adsRow,
                                'contabeis' =>$contabeisRow, 
                                'economia'=>$economiaRow,
                                'filosofia'=>$filosofiaRow, 
                                'gestaoPublica'=>$gestaoPublicaRow, 
                                'gestaoComercio'=>$gestaoComercioRow,
                                'gestaoFinanceira'=>$gestaoFinanceiraRow, 
                                'letras'=>$letrasRow ,
                                'proform'=>$proformRow ,
                                'segurancaInformacao'=>$segurancaInformacaoRow, 
                                'segurancaPublica'=>$segurancaPublicaRow ,
                                
                                
                        ]);
       
                }
    }
   
   
  
}
    
