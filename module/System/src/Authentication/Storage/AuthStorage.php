<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 03/05/2017
 * Time: 19:01
 */

namespace System\Authentication\Storage;


use Zend\Authentication\Storage\Session;
use Zend\Session\SessionManager;

class AuthStorage extends Session
{

    public function __construct($namespace = null, $member = null, SessionManager $manager = null){

        parent::__construct($namespace,$member,$manager);
    }

    public function setRememberMe($rememberMe = 0, $time = 1209600)
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