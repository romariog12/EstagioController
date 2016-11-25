<?php
namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Vaga\Entity\Vaga;
use Administrador\Entity\Aluno;
use Administrador\Entity\AlunoPresencial;
use Administrador\Entity\Empresa;

class UsuarioComumController extends AbstractActionController
{    
   
    public function buscarAlunoEADAction()   {
   $this->sairComumAction();
    
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    
    if($request->isPost()){
        $data = $this->params()->fromPost();
        $aluno = new Aluno(); 
        
        
        
        switch ($data['buscar']){
            case 'buscarPorMatricula':
                    $matricula = $request->getPost('porMatricula');
                    $aluno->setMatricula($matricula);
                    $lista = $em->getRepository("Administrador\Entity\Aluno")->findByMatricula($aluno->getMatricula());
                    break;
            case 'buscarPorNome':
                    $nome = $request->getPost('porNome');
                    $aluno->setNome($nome);
                    $lista = $em->getRepository("Administrador\Entity\Aluno")->findByNome($aluno->getNome());
                    break;
        }
        

        return new ViewModel([
        'lista' => $lista,
           
            ]);  
        }
    }

    //Vagas cadastradas no Perfil                  
    public function perfilEADAction(){
      $this->sairComumAction();
      $vaga = new Vaga();
      $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdalunovaga($id);
      $listaVagaPresencial = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
      $lista = $em->getRepository("Administrador\Entity\Aluno")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaEncaminhamento = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdvagaEncaminhamento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'listaVagaPresencial'=>$listaVagaPresencial,
                'lista'=>$lista,
                'listaEncaminhamento'=>$listaEncaminhamento
            ]);        
    }
     public function estagiosEADAction(){
       $this->sairComumAction();
      $vaga = new Vaga();
      $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdalunovaga($id);
      $listaAluno = $em->getRepository("Administrador\Entity\Aluno")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaEncaminhamento = $em->getRepository("Vaga\Entity\Encaminhamento")->findByIdvagaEncaminhamento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'lista'=>$listaAluno,
                'listaEncaminhamento'=>$listaEncaminhamento
            ]);        
    }
     public function cadastrarEADAction() {
          $this->sairComumAction();
          $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
          $request = $this->getRequest(); 
          $listaDadosPresencial = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
          $listaDados = $em->getRepository("Base\Entity\Dados")->findAll();
          if($request->isPost())
          {         
               try{  
                $nome = $request->getPost("nome");
                $curso = $request->getPost("curso");
                $matricula = $request->getPost("matricula");
                $modalidade = $request->getPost("modalidade");
                $email = $request->getPost("email");
                $telefone = $request->getPost("telefone");
                $cpf = $request->getPost("cpf");

                $aluno = new \Administrador\Entity\Aluno();
                $aluno->setAdministradorIdadministrador("0");
                $aluno->setNome($nome);
                $aluno->setCurso($curso);
                $aluno->setMatricula($matricula);
                $aluno->setModalidade($modalidade);
                $aluno->setCpf($cpf);
                $aluno->setEmail($email);
                $aluno->setTelefone($telefone);
                    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                    $em->persist($aluno);
                    $em->flush(); 
                                   
                  
          }catch (Exception $e){
             
          }
          echo "<div><p  style='text-align: center ; color: red'>Aluno cadastrado com sucesso!</p>".
                  '<button type="button" class="close pager" data-dismiss="alert">x</button></div>';
         } 
        return new ViewModel(
                [
                    'listaDados'=>$listaDados,
                    'listaDadosPresencial'=> $listaDadosPresencial
                ]);
    }
    public function declaracaoEADAction(){
         $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idAluno = $this->params()->fromRoute("id", 0);
        $idVaga = $this->params()->fromRoute("idVaga", 0);
        $aluno = $em->getRepository("Administrador\Entity\Aluno")->findByIdaluno($idAluno);
        $vaga = $em->getRepository("Vaga\Entity\Vaga")->findByIdvaga($idVaga);
        $colaborador = $this->session()->comum;
      
        return new ViewModel([
            'aluno'=>$aluno,
            'vaga'=>$vaga,
            'colaborador'=>$colaborador
        ]);
    }
    //// Presencial////
    public function buscarAlunoPresencialAction()   {
    $this->sairComumAction();
    $request = $this->getRequest();
    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
    
    if($request->isPost()){
        $data = $this->params()->fromPost();
        $aluno = new AlunoPresencial(); 
        
        
        
        switch ($data['buscar']){
            case 'buscarPorMatricula':
                    $matricula = $request->getPost('porMatricula');
                    $aluno->setMatricula($matricula);
                    $lista = $em->getRepository("Administrador\Entity\AlunoPresencial")->findByMatricula($aluno->getMatricula());
                    break;
            case 'buscarPorNome':
                    $nome = $request->getPost('porNome');
                    $aluno->setNome($nome);
                    $lista = $em->getRepository("Administrador\Entity\AlunoPresencial")->findByNome($aluno->getNome());
                    break;
        }
        

        return new ViewModel([
        'lista' => $lista,
           
            ]);  
        }
    }

    //Vagas cadastradas no Perfil                  
    public function perfilPresencialAction(){
      $this->sairComumAction();
      $vaga = new Vaga();
      $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
      $id = $this->params()->fromRoute("id", 0);
      $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
      $listaVagaPresencial = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
      $lista = $em->getRepository("Administrador\Entity\AlunoPresencial")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaDocumento = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByIdvagaDocumento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'listaVagaPresencial'=>$listaVagaPresencial,
                'lista'=>$lista,
                'listaEncaminhamento'=>$listaDocumento
            ]);        
    }
     public function estagiosPresencialAction(){
        $this->sairComumAction();
        $vaga = new \Vaga\Entity\VagaPresencial();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $id = $this->params()->fromRoute("id", 0);
        $listaVaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdalunovaga($id);
        $listaAluno = $em->getRepository("Administrador\Entity\AlunoPresencial")->findByidaluno($id);
      
        foreach ($listaVaga as $l){
                             $idVaga = $l->getidvaga();
                             $vaga->setIdvaga($idVaga);
                    }
                    $listaDocumento = $em->getRepository("Vaga\Entity\DocumentoPresencial")->findByIdvagaDocumento($vaga->getIdvaga());
        return new ViewModel([
                'listaVaga'=>$listaVaga,
                'lista'=>$listaAluno,
                'listaEncaminhamento'=>$listaDocumento
            ]);        
    }
     public function cadastrarPresencialAction() {
            $this->sairComumAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $request = $this->getRequest(); 
            $listaDadosPresencial = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
            $listaDados = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
            if($request->isPost())
            {         
               try{  
                $nome = $request->getPost("nome");
                $curso = $request->getPost("curso");
                $matricula = $request->getPost("matricula");
                $modalidade = $request->getPost("modalidade");
                $email = $request->getPost("email");
                $telefone = $request->getPost("telefone");
                $cpf = $request->getPost("cpf");

                $aluno = new \Administrador\Entity\AlunoPresencial();
                $aluno->setAdministradorIdadministrador("0");
                $aluno->setNome($nome);
                $aluno->setCurso($curso);
                $aluno->setMatricula($matricula);
                $aluno->setModalidade($modalidade);
                 $aluno->setCpf($cpf);
                $aluno->setEmail($email);
                $aluno->setTelefone($telefone);
               
                    $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                    $em->persist($aluno);
                    $em->flush(); 
                                   
                  
          }catch (Exception $e){
             
          }
          echo "<div><p  style='text-align: center ; color: red'>Aluno cadastrado com sucesso!</p>".
                  '<button type="button" class="close pager" data-dismiss="alert">x</button></div>';
         } 
        return new ViewModel(
                [
                    'listaDados'=>$listaDados,
                    'listaDadosPresencial'=> $listaDadosPresencial
                ]);
    }
    public function declaracaoPresencialAction(){
        $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $idAluno = $this->params()->fromRoute("id", 0);
        $idVaga = $this->params()->fromRoute("idVaga", 0);
        $aluno = $em->getRepository("Administrador\Entity\AlunoPresencial")->findByIdaluno($idAluno);
        $vaga = $em->getRepository("Vaga\Entity\VagaPresencial")->findByIdvaga($idVaga);
        $colaborador = $this->session()->comum;
      
        return new ViewModel([
            'aluno'=>$aluno,
            'vaga'=>$vaga,
            'colaborador'=>$colaborador
        ]);
    }
    
    public function cadastrarEmpresaAction(){
            $this->sairComumAction();
            $request = $this->getRequest();
            $idaluno = $this->params()->fromRoute("id", 0);
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
          if ($request->isPost()){
              try {
              $nomeEmpresa = $request->getPost("empresa");
              $cnpj = $request->getPost("cnpj");
              $telefone = $request->getPost("telefone");
              $endereco = $request->getPost("endereco");
              $empresa = new Empresa();
              $empresa ->setEmpresa($nomeEmpresa);
              $empresa ->setCnpj($cnpj);
              $empresa ->setTelefone($telefone);
              $empresa ->setEndereco($endereco);
                  $em->persist($empresa);
                  $em->flush();
                  
              } catch (Exception $ex) {
                  echo $this->flashMessenger()->render();     
              }
              if($idaluno == 0){
                      return $this->redirect()->toRoute('cadastrarEmpresa/default', 
                  array('controller' => 'empresa', 'action' => 'cadastrarEmpresa','id'=>'0'));
                      
              }else
              {
                      return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'index', 'id'=>$idaluno));
              }
                      
              }
            
      
          return new ViewModel([
              'idaluno'=>$idaluno
          ]);
        }   
    
    public function cadastrarAgenteAction(){
          $this->sairComumAction();
          $request = $this->getRequest();
          $idaluno = $this->params()->fromRoute("id", 0);
          
          if ($request->isPost()){
              try {
              $nomeAgente = $request->getPost("agente");
              $cnpj = $request->getPost("cnpj");
              $telefone = $request->getPost("telefone");
              $endereco = $request->getPost("endereco");
              
              $agente = new \Administrador\Entity\Agente();
              $agente ->setAgente($nomeAgente);
              $agente ->setCnpj($cnpj);
              $agente ->setTelefone($telefone);
              $agente ->setEndereco($endereco);
              $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                  $em->persist($agente);
                  $em->flush();
                  
              } catch (Exception $ex) {
                  echo $this->flashMessenger()->render();     
              }
                    if($idaluno == 0){
                      return $this->redirect()->toRoute('cadastrarEmpresa/default', 
                  array('controller' => 'empresa', 'action' => 'cadastrarAgente','id'=>'0'));
                      
              }else
              {
                      return $this->redirect()->toRoute('vaga/default', 
                  array('controller' => 'index', 'action' => 'index', 'id'=>$idaluno));
              }
            }
      
          return new ViewModel([
              'idaluno'=>$idaluno
          ]);
        }
        public function buscarEmpresaAction(){
            $this->sairComumAction();
            $request = $this->getRequest();
            if($request->isPost()){
                $data = $this->params()->fromPost();
                $empresa = new Empresa(); 
                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");

                switch ($data['buscar']){
                    case 'buscarPorCnpj':
                            $cnpj = $request->getPost('porCnpj');
                            $empresa->setCnpj($cnpj);
                            $lista = $em->getRepository("Administrador\Entity\Empresa")->findByCnpj($empresa->getCnpj());
                            break;
                    case 'buscarPorNome':
                            $nome = $request->getPost('porNome');
                            $empresa->setEmpresa($nome);
                            $lista = $em->getRepository("Administrador\Entity\Empresa")->findByEmpresa($empresa->getEmpresa());
                            break;
                }
                return new ViewModel([
                'lista' => $lista,
                    ]);  
                }
                }
    
 
}