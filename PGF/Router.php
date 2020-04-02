<?php

namespace PGF;

class Router{
  static private $_baseDir    = '';
  static private $_params     = array();
  static private $_url        = '';
  static private $_defaultUrl = '';
  static private $_verb       = '';
  static private $_query      = '';
  static private $_controller = '';
  static private $_action     = '';

  static public function isInitiated(){
    return static::$_baseDir != '';
  }

  static public function init($bd, $defaultUrl='/auth/signup'){
    static::$_baseDir    = $bd;
    static::$_defaultUrl = $defaultUrl;
  }

  static public function paramsProcess(){
    // Priority to POST values over GET values
    static::$_params = array_merge_recursive($_GET, $_POST);
    static::$_url = str_replace(static::$_baseDir, '', $_SERVER['REQUEST_URI']);

    if(static::$_url == '')
      static::$_url = static::$_defaultUrl;

    static::$_verb = $_SERVER['REQUEST_METHOD'];
    static::$_query = $_SERVER['QUERY_STRING'];

    $tabs = explode('/', static::$_url);
    static::$_controller = "\\controllers\\" . $tabs[1] . 'Controller';
    static::$_action = strtolower(static::$_verb) . ucfirst($tabs[2]) . 'Action';
  }

  static public function getController(){
    return static::$_controller;
  }

  static public function getAction(){
    return static::$_action;
  }

  static public function redirect($url=''){
    if($url == '')
      $url = static::$_baseDir . static::$_defaultUrl;
    else
      if(strpos($url, static::$_baseDir) !== 0)
        $url = static::$_baseDir . static::$_defaultUrl;

    header('Location: ' . $url);
    exit;
  }

  static public function route(){
    if(!static::isInitiated())
      die(ucfirst(_('router isn\'t initialized...')));

    // error_log(sprintf('[%s::%s] ? %s %s %s %s %s',$ctrl, $action, static::$_verb, $tabs[1], $tabs[2], static::$_url, static::$_baseDir));
    $ctrl = static::getController();
    $action = static::getAction();

    if(class_exists($ctrl)){
      if(method_exists($ctrl, $action)){
        $class = new $ctrl();

        // chain of method call
        $class->send($class->post($class->$action($class->pre())));
      }
      else
        Controller::error(404, sprintf(_('UNKNOWN ACTION : %s::%s'), $ctrl, $action));
    }
    else
      Controller::error(404, sprintf(_('UNKNOWN CONTROLLER : %s'), $ctrl));
  }

  static public function param($k, $default=null){
    if(isset(static::$_params[$k]))
      return static::$_params[$k];

    return $default;
  }

  static public function params($defaults=array()){
    if(empty($defaults))
      return static::$_params;

    return array_merge_recursive($defaults, static::$_params);
  }
}
