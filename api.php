<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once 'utils/autoload.php';
require_once 'conf/db.conf';

use PGF\Db as Db;
use PGF\Router as Router;

Db::init();
Router::init('/' . basename(__DIR__).'');

Router::paramsProcess();
Router::route();
