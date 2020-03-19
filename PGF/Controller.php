<?php

namespace PGF;

class Controller{
  public function pre(){
    return '';
  }

  public function post($m){
    return json_encode($m);
  }

  static public function send($m, $type='application/json'){
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: ' . $type . '; charset=UTF-8');
    echo $m;
  }

  static public function ok($m){
    return array_merge(array('code' => 200, 'message' => '', 'until' => strtotime('+1 min'), ), $m);
  }

  static public function error($code, $message){
    return array(
                'code' => $code,
                'message' => $message,
              );
  }
}
