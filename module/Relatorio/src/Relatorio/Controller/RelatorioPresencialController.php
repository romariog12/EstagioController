<?php

namespace Relatorio\Controller;

use Auth\Controller\AdministradorAbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Aluno\Entity\AlunoPresencial;
use Base\Model\Entity;
class RelatorioPresencialController extends AdministradorAbstractActionController {
    function __construct() {
        $this->CountPerPage = '10';
    }

    public function relatorioAction()
    {    
            $em = $this->getServiceLocator()->get(Entity::em);
            $listaVaga = $em->getRepository(Entity::vaga)
                    ->findAll();
            $findCurso = $em->getRepository(Entity::aluno)
                    ->findAll();
            $findEmpresa = $em->getRepository(Entity::empresa)
                    ->findAll();
            $recisaoRow = $em->getRepository(Entity::vaga)
                    ->findByRecisao('');
            $findAgente = $em->getRepository(Entity::agente)
                    ->findAll();
            $listaContratos = $em->getRepository(Entity::documento)
                    ->findAll();
            $listaCursos = $em->getRepository(Entity::dados)
                    ->findAll();
            $quantidadeCursos = count($listaCursos);
            
                //....:::Quantidade de estágios por curso:::......
                $totalEstagioPorCurso = [];
                $estagiando = [];
                for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                    $totalEstagioPorCurso[$count] =  count($em->getRepository(Entity::vaga)
                            ->findBycursoVaga($count));
                    $estagiando[$count] = count($em->getRepository(Entity::vaga)
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
                $em = $this->getServiceLocator()->get(Entity::em);              
                $request = $this->getRequest();
                $lista = $em->getRepository(Entity::dados)->findAll();
                $quantidadeCursos = count($lista);
               
                if($request->isPost()){
                        $ano = $request->getPost('ano');
                        $listaTodosCursos = $em->getRepository(Entity::vaga)
                                ->findByanoVaga($ano);
                        $mes = [];
                        $cursoVagas = [];
                        $cursoTce = [];
                        $cursoTa = [];
                        
                         for($count = 1 ;$count<=12 ;$count++){
                         $mes[$count]= count($em->getRepository(Entity::vaga)
                                 ->findByAnoVagaAndMesVaga($ano, $count)) ;   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTce[$count] = count($em->getRepository(Entity::documento)
                                 ->findByAnoDocumentoAndTipoAndCurso ($ano, 'TCE',$count ));   
                         $cursoTa[$count] = count($em->getRepository(Entity::documento)
                                 ->findByAnoDocumentoAndTipoAndCurso ($ano, 'TA',$count ));
                         $cursoVagas[$count] = count($em->getRepository(Entity::vaga)
                                 ->findByAnoVagaAndCursoVaga($ano, $count));   
                         }
                         
                         
                    $tce = $em->getRepository(Entity::documento)
                            ->findByAnoVagaAndTipo ($ano, 'TCE' );
                    $ta = $em->getRepository(Entity::documento)
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
                        
                        $listaTodosCursos = $em->getRepository(Entity::vaga)
                                ->findByanoVaga(date('Y'));
                        $mes = [];
                        $cursoVagas = [];
                        $cursoTce = [];
                        $cursoTa = [];
                         for($count = 1 ;$count<=12 ;$count++){
                         $mes[$count]=count($em->getRepository(Entity::vaga)
                                 ->findByAnoVagaAndMesVaga(date('Y'), $count)) ;   
                         }
                         for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                         $cursoTce[$count] = count($em->getRepository(Entity::documento)
                                 ->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TCE',$count ));
                         $cursoTa[$count] = count($em->getRepository(Entity::documento)
                                 ->findByAnoDocumentoAndTipoAndCurso (date('Y'), 'TA',$count ));
                         $cursoVagas[$count] = count($em->getRepository(Entity::vaga)
                                 ->findByAnoVagaAndCursoVaga(date('Y'), $count));  
                         }
                        
                    $tce = $em->getRepository(Entity::documento)
                            ->findByAnoVagaAndTipo (date('Y'), 'TCE' );
                    $ta = $em->getRepository(Entity::documento)
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
       
        $em = $this->getServiceLocator()->get(Entity::em);
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vaga)
                ->findBycursoVaga($curso);
        $selectCurso = $em->getRepository(Entity::dados)
                ->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vaga)
                ->findByRecisaoAndCursoVaga('',$curso);
         $listaAlunosCadastrados = $em->getRepository(Entity::aluno)
                 ->findByCurso($curso1);   
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage( $this->CountPerPage);
        $count = $pagination->count();
        $pageNumber = $pagination->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        $mes = [];
         for($Count = 1 ;$Count<=12 ;$Count++){
                         $mes[$Count]=$em->getRepository(Entity::vaga)
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
        
        $em = $this->getServiceLocator()->get(Entity::em);
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vaga)
                ->findBycursoVaga($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vaga)
                ->findByRecisaoAndCursoVaga('',$curso);
        $selectCurso = $em->getRepository(Entity::dados)
                ->findByIddados($curso);
        $listaAlunosCadastrados = $em->getRepository(Entity::aluno)
                ->findByCurso($curso1);
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage($this->CountPerPage);
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
        
        $em = $this->getServiceLocator()->get(Entity::em);
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vaga)
                ->findBycursoVaga($curso);
        $selectCurso = $em->getRepository(Entity::dados)
                ->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vaga)
                ->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository(Entity::aluno)
                ->findByCurso($curso1);
        $listaVagasEncerradas = $em->getRepository(Entity::vaga)
                ->findBySituacaoAndCursoVaga('0',$curso);
       
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVagasEncerradas));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage($this->CountPerPage);
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
                    'countListaEncerrado'=>count($listaVagasEncerradas),
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
       
        $em = $this->getServiceLocator()->get(Entity::em);
        $request = $this->getRequest(); 
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vaga)
                ->findBycursoVaga($curso);
        $selectCurso = $em->getRepository(Entity::dados)
                ->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vaga)
                ->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository(Entity::aluno)
                ->findByCurso($curso1);  
        
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaAlunosCadastrados));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage($this->CountPerPage);
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
                            $lista = $em->getRepository(Entity::aluno)
                                    ->findByMatriculaAndCurso($aluno->getMatricula(), $curso1);
                            break;
                    case 'buscarPorNome':
                            $nome = $request->getPost('porNome');
                            $aluno->setNome($nome);
                            $lista = $em->getRepository(Entity::aluno)
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
       
        $em = $this->getServiceLocator()->get(Entity::em);
        $curso = $this->params()->fromRoute("curso", 0);
        $curso1 = $this->params()->fromRoute("curso1", 0);
        $page = $this->params()->fromRoute("page");
        $listaVaga = $em->getRepository(Entity::vaga)
                ->findBycursoVaga($curso);
        $selectCurso = $em->getRepository(Entity::dados)
                ->findByIddados($curso);
        $listaVagaEstagiando = $em->getRepository(Entity::vaga)
                ->findByRecisaoAndCursoVaga('',$curso);
        $listaAlunosCadastrados = $em->getRepository(Entity::aluno)
                ->findByCurso($curso1);   
        //pagination
        $pagination = new Paginator( new ArrayAdapter($listaVaga));
        $pagination->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage($this->CountPerPage);
        $count = $pagination->count();
        $pageNumber = $pagination
                ->getCurrentPageNumber();
        $getPages = $pagination->getPages();
        $mes = [];
         for($Count = 1 ;$Count<=12 ;$Count++){
                         $mes[$Count]=$em->getRepository(Entity::vaga)
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
                    
                    'mensagem'=>$mensagem=   '<div class="alert-danger" style="margin: initial">
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
    
