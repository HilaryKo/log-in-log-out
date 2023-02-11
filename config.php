<?php
// username
define('MYSQL_USER','root');
// password
define('MYSQL_PASSWORD','');

define('MYSQL_HOST','localhost');

define('MYSQL_DATABASE','fwd');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$pdoOptions = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
);

// connection code
$pdo = new PDO(
  'mysql:host=' .MYSQL_HOST.';dbname='.MYSQL_DATABASE,
  MYSQL_USER,MYSQL_PASSWORD,
  $pdoOptions
);

?>
