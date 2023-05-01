<?php
session_start(); 
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('APP_LANG','en');

include("lib/db.php");
include("lib/utils.php");
include("lang/".APP_LANG.".php");

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'challenge3';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);
if(mysqli_connect_errno()){
    
    exit('Failed to connect to MYSQL: '.mysqli_connect_error());
}
$vars=get_input_vars();

?>