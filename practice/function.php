<?php
define('DB_HOST','localhost');
define('DB_NAME','tennis_plus');
define('DB_USER','tennisuser');
define('DB_PASS','password');

// DBへ接続する
function db_connect(){
    $dsn = 'mysql:host'.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
    $db = new PDO($dsn,DB_USER,DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    return $db;

}