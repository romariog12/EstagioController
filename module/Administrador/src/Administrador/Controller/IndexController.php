<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Administrador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;




class IndexController extends AbstractActionController
{
      public function indexAction()
      {
       {
          $request = $this->getRequest();
          $result = array();
          if($request->isPost())
          {
              $nome = $request->getPost("nome");
              $matricula = $request->getPost("matricula");
              $curso = $request->getPost("curso");
              
              $result["resp"] = $nome. ", enviado corretamente!";
          }
          
          return new ViewModel($result);
      }
      }
}
