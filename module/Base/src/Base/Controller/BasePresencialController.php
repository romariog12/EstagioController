<?php
/**
 * Zend Framework (http://framework.zend.com/)
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Model\Entity;
/**
 * @author Romário Macedo Portela <romariomacedo18@gmail.com>
 */
class BasePresencialController extends AbstractActionController
{
    public function dadosAction(){
            $em = $this->getServiceLocator()->get(Entity::em);
            $lista = $em->getRepository(Entity::dados)->findAll();
            $quantidadeCursos = count($lista);
            $request = $this->getRequest();
           
           if($request ->isPost()){  
                        $curso = [];
                        $quantidadePresencial = [];
                        $meta = [];
                        $selectCurso = [];
                        $orientador = [];
                        for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                            $curso[$count]= $request->getPost($count);
                            $quantidadePresencial[$count] = $request->getPost("GP-".$count);
                            $meta[$count] = $request->getPost(100 + $count);
                            $orientador [$count] =  $request->getPost("orientador".$count);
                            $selectCurso[$count] = $em ->find(Entity::dados, $count);     
                            $selectCurso[$count]->setCurso($curso[$count]);
                            $selectCurso[$count]->setQuantidadealunos($quantidadePresencial[$count]);
                            $selectCurso[$count]->setMeta($meta[$count]);
                            $selectCurso[$count]->setOrientador($orientador[$count]);
                            $em->persist($selectCurso[$count]);
                            $em->flush();     
                        }
            }
      return new ViewModel([
                'listaPresencial'=>$lista,
                'quantidadeCursos'=> $quantidadeCursos
            ]);
    }
    public function adcionarDadosAction(){
        $em = $this->getServiceLocator()->get(Entity::em);
        $lista = $em->getRepository(Entity::dados)->findAll();
        $idCurso = 'GP-'.(count($lista)+1);
        $idDados = $this->params()->fromRoute('idDados',0);
        $request = $this->getRequest();
          $curso = $request->getPost("curso");  
          $quantidade = $request->getPost("quantidade");
          $meta = $request->getPost("meta");
          $orientador = $request->getPost("orientador");
        $selecionar = $em->find(Entity::dados, $idDados);
        $selecionar
                ->setCurso($curso)
                ->setQuantidadealunos($quantidade)
                ->setMeta($meta)
                ->setOrientador($orientador)
                ->setIdcurso($idCurso);
                
                    $em->persist($selecionar);
                    $em->flush();
        
    }
    public function excluirDadosAction(){
         $id = $this->params()->fromRoute("idDeleteDados", 0);
            $em = $this->getServiceLocator()->get(Entity::em);
            $documento = $em->find(Entity::dados, $id);
            $em->remove($documento);
            $em->flush();
        
    }
}
