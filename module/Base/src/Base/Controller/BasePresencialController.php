<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Base\Entity\Pedagogico;
use Zend\Session\Container;
class BasePresencialController extends AbstractActionController
{
    public function dadosAction(){
             $this->sairComumAction();
            $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
            $lista = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
            $quantidadeCursos = count($lista);
            $request = $this->getRequest();
            if($request ->isPost()){
                        $curso = [];
                        $quantidadePresencial = [];
                        $meta = [];
                        $selectCurso = [];
                        for($count = 1 ;$count<=$quantidadeCursos ;$count++){
                            $curso[$count]= $request->getPost($count);
                            $quantidadePresencial[$count] = $request->getPost("GP-".$count);
                            $meta[$count] = $request->getPost(100 + $count);
                            $selectCurso[$count] = $em ->find("Base\Entity\DadosPresencial", $count);     
                            $selectCurso[$count]->setCurso($curso[$count]);
                            $selectCurso[$count]->setQuantidadealunos($quantidadePresencial[$count]);
                            $selectCurso[$count]->setMeta($meta[$count]);
                            $em->persist($selectCurso[$count]);
                            $em->flush();     
                        }
            }
      return new ViewModel([
                'listaPresencial'=>$lista,
                'quantidadeCursos'=> $quantidadeCursos
            ]);
    }
    
    public function orientacaoAction(){
        $this->sairComumAction();
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $lista = $em->getRepository("Base\Entity\DadosPresencial")->findAll();
         $request = $this->getRequest();
            if($request ->isPost()){
                $pedagogico = new Pedagogico();
                $idcurso = $request->getPost("curso");
                $orientador = $request->getPost("orientador");
                $semestre = $request->getPost("semestre");
                $orientacao = $request->getPost("orientacao");
                $email = $request->getPost("email");
                
                $pedagogico->setIdcurso($idcurso);
                $pedagogico->setOrientador($orientador);
                $pedagogico->setSemestre($semestre);
                $pedagogico->setOrientacao($orientacao);
                $pedagogico->setEmail($email);
                    $em->persist($pedagogico);
                    $em->flush();
            }
        
        return new ViewModel([
            'listaPresencial'=>$lista,
        ]);
    }

}
