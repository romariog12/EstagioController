<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Model;

use Zend\Authentication\Storage;
/**
 * Description of AuthStorage
 *
 * @author romario
 */
class AuthStorage extends Storage\Session {
    public function setRememberMe($rememberMe = 0, $time = 2)
    {
         if ($rememberMe == 1) {
             $this->session->getManager()->rememberMe($time);
         }
    }
     
    public function forgetMe()
    {
        $this->session->getManager()->forgetMe();
    } 
}
