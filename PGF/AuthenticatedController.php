<?php

namespace PGF;

class AuthenticatedController extends Controller{
  static private $_publicActions = array();

  public function pre(){
    if(!in_array(Router::getAction(), static::$_publicActions))
      Router::redirect();

    return '';
  }
}
