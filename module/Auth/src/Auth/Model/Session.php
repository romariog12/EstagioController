<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Model;

use Zend\Session\Container;

/**
 * Description of Session
 *
 * @author romario
 */
class Session extends \Zend\Mvc\Controller\AbstractActionController{
    
    const login = 'http://127.0.0.1/Projem/public/login';
    private $session;
    
    public function session(){
          $this->session = new Container('timer');
          return $this->session;    
        }

        public function sairAdministradorAction(){   
             if(!isset($this->session()->administrador)){
                  $this->redirect()->toUrl(self::login);
            }
        }

        public function sairComumAction(){
             if(!isset($this->session()->comum)){
                 $this->redirect()->toUrl(self::login);
            }
        }
}
