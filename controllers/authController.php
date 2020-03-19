<?php

namespace controllers;

use PGF\Db as Db;
use PGF\Router as Router;

class authController extends \PGF\Controller{

  public function getLoginAction($pre){

  }

  public function getSigninAction($pre){
    return static::ok(array('action' => 'signin', ));
  }

  public function getSignupAction($pre){
    return static::ok(array('action' => 'signup', ));
  }
}
