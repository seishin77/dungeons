<?php

namespace controllers;

use PGF\Db as Db;
use PGF\Router as Router;

class authController extends \PGF\Controller{

  public function postLoginAction($pre){
    Db::query(
      'SELECT * FROM "player" WHERE ("id"=? OR "name"=?) AND "password"=SHA1(?);',
      array(Router::param('login'), Router::param('login'), Router::param('password'), )
    );

    $p = Db::fetchAll();
    if(empty($p))
      return static::error(403, 'bad credentials or unknown id');

    $token = static::token();
    $until = strtotime('+20 min');
    Db::query(
      'UPDATE "player" SET "token"=?, "until"=? WHERE id=?;',
      array($token, $until, $p[0]['id'])
    );

    return static::ok(array('token' => $token, 'until' => $until));
  }

  // Formulaire "Se connecter"
  // Inutile
  /*
  public function getSigninAction($pre){
    return static::ok(array('action' => 'signin', ));
  }
  /**/

  // Formulaire "S'inscrire"
  // Inutile
  /*
  public function getSignupAction($pre){
    return static::ok(array('action' => 'signup', ));
  }
  /**/
}
