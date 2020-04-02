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

  // token of 20 characters <=> 704 423 425 546 998 000 000 000 000 000 000 000 possiblities
  static public function token($length=20){
    $chars = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
    $max_idx = count($chars) - 1;
    $retour = '';

    while($length > 0){
      $retour .= $chars[mt_rand(0, $max_idx)];
      $length--;
    }

    return $retour;
  }
}
