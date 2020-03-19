<?php

namespace controllers;

use PGF\Db as Db;
use PGF\Router as Router;

class objectsController extends \PGF\Controller{

  public function getListAction($pre){
    Db::query('SELECT * FROM object;');

    $objects = array();
    while($row = Db::fetch()){
      if(isset($row['data']))
        $row['data'] = json_decode($row['data'], true);
      $objects[] = $row;
    }

    return $this->ok(array('title' => 'List of objects', 'list' => $objects));
  }
}
