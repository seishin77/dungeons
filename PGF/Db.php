<?php

/*
 * Note : this derivating class breaks the multi-db functionality of PDO by some methods :
 *
 * static public function tableExists($name, $schema='public');
 * static public function curVal($seq);
 * static public function nextVal($seq);
 * static public function setVal($seq, $val, $called=true);
 * static public function futureVal($seq);
 */

namespace PGF;

use PDO;

if (!defined('DB_DSN') || !defined('DB_USER') || !defined('DB_PASSWORD'))
  die(ucfirst(_('missing database configuration...')));

class Db{
  static private $conn;
  static private $db = null;
  static private $stmt = array();
  static private $lastSQL = '';

  static public function init($conn=DB_DSN, $user=DB_USER, $pass=DB_PASSWORD){
    static::$conn = $conn;
    static::$db = new PDO($conn, $user, $pass, array(PDO::ATTR_PERSISTENT => true,));
    static::$db->setAttribute(PDO::ATTR_TIMEOUT, 10);
    static::$db->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_TO_STRING);
    static::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    static::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  static public function getConnString(){
    return static::$conn;
  }

  static public function getDb(){
    return static::$db;
  }

  static public function setDb($db){
    static::$db = $db;
  }

  static public function read($sql, $params=array(), $sqlname='SQLCurrent'){
    try{
      if(is_null(static::$db))
        static::init();

      static::$lastSQL = $sql;
      static::$stmt[$sqlname] = static::$db->prepare($sql);
      static::$stmt[$sqlname]->execute($params);

      if($r = static::$stmt[$sqlname]->fetch()){
        echo '<table>', PHP_EOL,
          '<tr><th>', implode('</th><th>', array_keys($r)), '</th></tr>', PHP_EOL;

        echo '<tr><td>', implode('</td><td>', $r), '</td></tr>', PHP_EOL;

        while($r = static::$stmt[$sqlname]->fetch())
          echo '<tr><td>', implode('</td><td>', $r), '</td></tr>', PHP_EOL;

        echo '</table><br/>';
      }
      else
        echo 'NO DATA FOR ', $sql, '<br/><br/>';
    }
    catch(\Exception $e){
      error_log('<pre>' . var_export($e, true) . '</pre>');
    }
  }

  static public function query($sql, $params=array(), $sqlname='SQLCurrent', $force=false){
    try{
      if(is_null(static::$db))
        static::init();

      static::$lastSQL = $sql;
      if(!isset(static::$stmt[$sqlname]) || $sqlname == 'SQLCurrent' || $force){
        static::$stmt[$sqlname] = static::$db->prepare($sql);
      }

      static::$stmt[$sqlname]->execute($params);
    }
    catch(\Exception $e){
      error_log('<pre>' . var_export($e, true) . '</pre>', 1, 'webmaster@a-n-k.fr');
    }
  }

  static public function fetch($sqlname='SQLCurrent'){
    if(!isset(static::$stmt[$sqlname]) || is_null(static::$stmt[$sqlname]))
      return FALSE;

    $r = static::$stmt[$sqlname]->fetch();
    if($r)
      return $r;

    return FALSE;
  }

  static public function fetchAll($sqlname='SQLCurrent'){
    if(!isset(static::$stmt[$sqlname]) || is_null(static::$stmt[$sqlname]))
      return array();

    $retour = array();
    while($r = static::$stmt[$sqlname]->fetch())
      $retour[] = $r;

    return $retour;
  }

  static public function beginTransaction(){
    try{
      if(is_null(static::$db))
        static::init();

      static::$db->beginTransaction();
    }
    catch(\Exception $e){
      error_log('<pre>' . var_export($e, true) . '</pre>');
    }
  }

  static public function commit(){
    try{
      if(is_null(static::$db))
        static::init();

      static::$db->commit();
    }
    catch(\Exception $e){
      error_log('<pre>' . var_export($e, true) . '</pre>');
    }
  }

  static public function rollback(){
    try{
      if(is_null(static::$db))
        static::init();

      static::$db->rollback();
    }
    catch(\Exception $e){
      error_log('<pre>' . var_export($e, true) . '</pre>');
    }
  }

  static public function lastInsertId($seq){
    try{
      if(is_null(static::$db))
        static::init();

      return static::$db->lastInsertId($seq);
    }
    catch(\Exception $e){
      error_log('<pre>' . var_export($e, true) . '</pre>');
    }
    return 0;
  }

  static public function tableExists($name, $schema='public'){
    $sql = 'SELECT count(*) as nb FROM information_schema.tables WHERE table_schema=? AND table_name ilike ?';

    static::query($sql, array($schema, $name));
    $r = static::fetch();

    return $r['nb'] > 0;
  }

  static public function curVal($seq){
    if(is_null(static::$db))
      static::init();

    static::query(sprintf('SELECT last_value, is_called FROM %s;', $seq));
    $r = static::fetch();

    if(!$r['is_called'])
      return $r['last_value'] - 1;
    return $r['last_value'];
  }

  static public function nextVal($seq){
    if(is_null(static::$db))
      static::init();
    static::query(sprintf('SELECT nextval(%s) as val;', "'" . $seq . "'"));
    $r = static::fetch();
    return $r['val'];
  }

  static public function setVal($seq, $val, $called=true){
    if(is_null(static::$db))
      static::init();
    static::query(sprintf('SELECT setval(%s, ?, ?) as val;', "'" . $seq . "'"), array($val, $called));
  }

  static public function futureVal($seq){
    if(is_null(static::$db))
      static::init();
    static::query(sprintf('SELECT last_value, is_called FROM %s;', $seq));
    $r = static::fetch();
    if(!$r['is_called'])
      return $r['last_value'];
    return $r['last_value'] + 1;
  }

  static public function primaryKeys($tbl){
    $driver = static::getAttribute(PDO::ATTR_DRIVER_NAME);
    switch($driver){
      case 'pgsql':
        $sql = 'SELECT at.attname as "column" FROM pg_constraint co JOIN pg_class cl ' .
                'ON cl.oid = co.conrelid AND co.contype = \'p\' JOIN pg_namespace ns ON ns.oid = co.connamespace ' .
                'JOIN pg_attribute at ON at.attrelid = co.conrelid AND at.attnum = ANY(co.conkey) WHERE cl.relname=\'%s\'';
        if(is_null(static::$db))
          static::init();
        static::query(sprintf($sql, $tbl));
        return array_map(function ($e){ return $e['column'];}, static::fetchAll());
        break;

      case 'mysql':
      case 'mysqli':
        $res = mysql_query(sprintf('DESCRIBE `%s`;', $tbl));
        $primary_keys = array();
        while($line = mysql_fetch_array($res)){
          if(isset($line['Key']) && $line['Key'] == 'PRI')
            $primary_keys[] = $line['Field'];
        }
        return $primary_keys;
        break;

      default:
        throw new PDOException(sprintf('Unable to get primary keys for driver "%s"', $driver));
        break;
    }
  }

  static public function getAttribute($attr){
    return static::$db->getAttribute($attr);
  }
}
