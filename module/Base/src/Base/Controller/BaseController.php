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
class BaseController extends AbstractActionController
{
      public function indexAction(){   
      }
      public function logoutAction(){
       unset($this->session()->item);
       return $this->redirect()->toUrl('http://127.0.0.1/Projem/public/login');
   }
}
