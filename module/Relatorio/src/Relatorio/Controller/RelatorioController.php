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
            $row = count($findCurso);
            $rowRecisao= count($recisaoRow);
            $rowEmpresa = count($findEmpresa);
            $rowVaga = count($listaVaga);
            $rowAgente = count($findAgente);
            $rowContratosEncerrados = $rowVaga - $rowRecisao;
           
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
                  // filtro-> $rowMensal1 -> $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('$rowMensal');
                    $rowMensal01 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('01');
                    $rowMensal02 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('02');
                    $rowMensal03 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('03');
                    $rowMensal04 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('04');
                    $rowMensal05 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('05');
                    $rowMensal06 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('06');
                    $rowMensal07 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('07');
                    $rowMensal08 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('08');
                    $rowMensal09 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('09');
                    $rowMensal010 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('10');
                    $rowMensal011 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('11'); 
                    $rowMensal012 = $em->getRepository("Vaga\Entity\Vaga")->findBymesVaga('12');
                        $rowMensal1 = count($rowMensal01);
                        $rowMensal2 = count($rowMensal02);
                        $rowMensal3 = count($rowMensal03);
                        $rowMensal4 = count($rowMensal04);
                        $rowMensal5 = count($rowMensal05);
                        $rowMensal6 = count($rowMensal06);
                        $rowMensal7 = count($rowMensal07);
                        $rowMensal8 = count($rowMensal08);
                        $rowMensal9 = count($rowMensal09);
                        $rowMensal10 = count($rowMensal010);
                        $rowMensal11 = count($rowMensal011); 
                        $rowMensal12 = count($rowMensal012);
                        

                    
            
        return new ViewModel([
            'fetchRow'=>$findCurso,
            'row'=> $row,
            'recisaoRow'=>$rowRecisao,
            'rowEmpresa' =>$rowEmpresa,
            'rowVaga'=>$rowVaga,
            'rowAgente'=>$rowAgente,
            'rowContratosEncerrados'=>$rowContratosEncerrados,
            
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
            
            'rowMensal01'=>$rowMensal1,
            'rowMensal02'=>$rowMensal2,
            'rowMensal03'=> $rowMensal3,
            'rowMensal04'=> $rowMensal4,
            'rowMensal05'=> $rowMensal5,
            'rowMensal06'=>$rowMensal6,
            'rowMensal07'=> $rowMensal7,
            'rowMensal08'=>$rowMensal8,
            'rowMensal09'=>$rowMensal9,
            'rowMensal10'=>$rowMensal10,
            'rowMensal11'=>$rowMensal11,
            'rowMensal12'=>$rowMensal12
                
        ]);
 
   }
  
}
    
