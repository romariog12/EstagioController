<?php

namespace Relatorio\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Aluno\Entity\AlunoPresencial;
use Base\Model\Entity;
use Auth\Model\Session;
class RelatorioPresencialController extends AbstractActionController {
    
    public function relatorioAction()
    {    
            $session = new Session();
            $session->sairAdministradorAction();
          
            
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaVaga = $em->getRepository(Entity::vagaPresencial)
                    ->findAll();
            $findCurso = $em->getRepository(Entity::alunoPresencial)
                    ->findAll();
            $findEmpresa = $em->getRepository(Entity::empresa)
                    ->findAll();
            $recisaoRow = $em->getRepository(Entity::vagaPresencial)
                    ->findByRecisao('');
            $findAgente = $em->getRepository(Entity::agente)
                    ->findAll();
            $listaContratos = $em->getRepository(Entity::documentoPresencial)
                    ->findAll();
            $listaCursos = $em->getRepository(Entity::dadosPresencial)
                    ->findAll();
            $quantidadeCursos = count($listaCursos);
            
                //....:::Quantidade de estágios por curso:::......
                $totalEstagioPorCurso = [];
                $estagiando = [];
                for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                    $totalEstagioPorCurso[$count] =  count($em->getRepository(Entity::vagaPresencial)
                            ->findBycursoVaga($count));
                    $estagiando[$count] = count($em->getRepository(Entity::vagaPresencial)
                        ->findByRecisaoAndCursoVaga('',$count));
                }
           
               
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
              $totalEstagioPorCurso
                ],
                
             //........:::Estágios Em andamento:::.............    
                'listaestagiando'=>
                [
                $estagiando
                ],
            'listaCursos'=>$listaCursos,
            'quantidadeCursos'=> $quantidadeCursos
         
        ]);
 
   } 
     public function relatorioGraficoAction()
    {
        $this->sairComumAction();
                $em = $this->getServiceLocator()->get(Entity::em);              
                $request = $this->getRequest();
                $lista = $em->getRepository(Entity::dadosPresencial)->findAll();
                $quantidadeCursos = count($lista);
               
                if($request->isPost()){
                        $ano = $request->getPost('ano');
                        $listaTodosCursos = $em->getRepository(Entity::vagaPresencial)
                                ->findByanoVaga($ano);
                        $mes = [];
                        $cursoVagas = [];
                        $cursoTce = [];
                        $cursoTa = [];
                        
                         for($count = 1 ;$count<=12 ;$count++){
                         $mes[$count]= count($em->getRepository(Entity::vagaPresencial)
                                 ->findByAnoVagaAndMesVaga($ano, $count)) ;   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTce[$count] = count($em->getRepository(Entity::documentoPresencial)
                                 ->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE',$count ));   
                         $cursoTa[$count] = count($em->getRepository(Entity::documentoPresencial)
                                 ->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA',$count ));
                         $cursoVagas[$count] = count($em->getRepository(Entity::vagaPresencial)
                                 ->findByAnoVagaAndCursoVaga($ano, $count));   
                         }
                         
                         
                    $tce = $em->getRepository(Entity::documentoPresencial)
                            ->findByAnoVagaAndTipo ($ano, 'TCE' );
                    $ta = $em->getRepository(Entity::documentoPresencial)
                            ->findByAnoVagaAndTipo($ano,  'TA' );
                        return new ViewModel([
                            'listaTodosCursos'=>$listaTodosCursos,
                            'rowTodosCursos'=> count($listaTodosCursos),
                            'listaDados' => $lista,
                            
                            'mes'=>[
                                $mes    
                            ],
         
                            'cursoVagas'=>[
                                $cursoVagas
                                
                            ],
                            'cursoTce' =>[
                                $cursoTce
                            ],
                            'cursoTa'=>[
                                $cursoTa
                            ],
                            
                           
                            'ano'=>$ano,          
                            'tceRow'=> count($tce),
                            'taRow'=> count($ta),                      
                        ]);
                        
                }else{
                        
                        $listaTodosCursos = $em->getRepository(Entity::vagaPresencial)
                                ->findByanoVaga(date('Y'));
                        $mes = [];
                        $cursoVagas = [];
                        $cursoTce = [];
                        $cursoTa = [];
                         for($count = 1 ;$count<=12 ;$count++){
                         $mes[$count]=count($em->getRepository(Entity::vagaPresencial)
                                 ->findByAnoVagaAndMesVaga(date('Y'), $count)) ;   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTce[$count] = count($em->getRepository(Entity::documentoPresencial)
                                 ->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE',$count ));
                         $cursoTa[$count] = count($em->getRepository(Entity::documentoPresencial)
                                 ->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA',$count ));
                         $cursoVagas[$count] = count($em->getRepository(Entity::vagaPresencial)
                                 ->findByAnoVagaAndCursoVaga(date('Y'), $count));  
                         }
                        
                    $tce = $em->getRepository(Entity::documentoPresencial)
                            ->findByAnoVagaAndTipo (date('Y'), 'TCE' );
                    $ta = $em->getRepository(Entity::documentoPresencial)
                            ->findByAnoVagaAndTipo(date('Y'),  'TA' );
                    
                        return new ViewModel([
                            'listaTodosCursos'=>$listaTodosCursos,
                            'rowTodosCursos'=> count($listaTodosCursos),
                            'listaDados' => $lista,
                            
                            'mes'=>[
                               $mes         
                            ],
         
                            'cursoVagas'=>[
                                $cursoVagas
                                
                            ],
                            'cursoTce' =>[
                                $cursoTce
                            ],
                            'cursoTa'=>[
                                $cursoTa
                            ],  
                            'ano'=> date('Y'),          
                            'tceRow'=> count($tce),
                            'taRow'=> count($ta)                          
                ]);
                        
                         }
    } 
   
    public function infoPresencialAction(){
        
        $this->sairComumAction();
        $em = $this->getServiceLocator()->get(Entity::em);
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vagaPresencial)
                ->findBycursoVaga($curso);
        $selectCurso = $em->getRepository(Entity::dadosPresencial)
                ->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)
                ->findByRecisaoAndCursoVaga('',$curso);
         $listaAlunosCadastrados = $em->getRepository(Entity::alunoPresencial)
                 ->findByCurso($curso1);   
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(10);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        $mes = [];
         for($Count = 1 ;$Count<=12 ;$Count++){
                         $mes[$Count]=$em->getRepository(Entity::vagaPresencial)
                                 ->findByAnoVagaAndMesVagaAndCursoVaga(date('Y'), $Count,$curso) ;           
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
        $em = $this->getServiceLocator()->get(Entity::em);
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vagaPresencial)
                ->findBycursoVaga($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)
                ->findByRecisaoAndCursoVaga('',$curso);
        $selectCurso = $em->getRepository(Entity::dadosPresencial)
                ->findByIddados($curso);
        $listaAlunosCadastrados = $em->getRepository(Entity::alunoPresencial)
                ->findByCurso($curso1);
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(10);
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
        $em = $this->getServiceLocator()->get(Entity::em);
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vagaPresencial)
                ->findBycursoVaga($curso);
        $selectCurso = $em->getRepository(Entity::dadosPresencial)
                ->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)
                ->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository(Entity::alunoPresencial)
                ->findByCurso($curso1);
       
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(10);
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
        $em = $this->getServiceLocator()->get(Entity::em);
        $request = $this->getRequest(); 
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vagaPresencial)
                ->findBycursoVaga($curso);
        $selectCurso = $em->getRepository(Entity::dadosPresencial)
                ->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)
                ->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository(Entity::alunoPresencial)
                ->findByCurso($curso1);  
        
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaAlunosCadastrados));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(10);
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
                            $lista = $em->getRepository(Entity::alunoPresencial)
                                    ->findByMatriculaAndCurso($aluno->getMatricula(), $curso1);
                            break;
                    case 'buscarPorNome':
                            $nome = $request->getPost('porNome');
                            $aluno->setNome($nome);
                            $lista = $em->getRepository(Entity::alunoPresencial)
                                    ->findByNomeAndCurso($aluno->getNome(), $curso1);
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
                    'mensagem'=>$menstagem = 
                    '<div class="alert-danger" style="margin: initial"><br/>
                        <h4 style="text-align: center">Sem dados à apresentar!</h4><br/>      
                    </div><tr>',
                    'curso'=>$selectCurso,
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
        $em = $this->getServiceLocator()->get(Entity::em);
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vagaPresencial)
                ->findBycursoVaga($curso);
        $selectCurso = $em->getRepository(Entity::dadosPresencial)
                ->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vagaPresencial)
                ->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository(Entity::alunoPresencial)
                ->findByCurso($curso1);   
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(3);
        $count = $pagination->count();
        $pageNumber = $pagination
                ->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        $mes = [];
         for($Count = 1 ;$Count<=12 ;$Count++){
                         $mes[$Count]=$em->getRepository(Entity::vagaPresencial)
                                 ->findByAnoVagaAndMesVagaAndCursoVaga(date('Y'), $Count,$curso) ;           
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
    
