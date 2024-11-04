<?php
//define the core paths
//Define them as absolute peths to make sure that require_once works as expected
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('APP_ROOT') ? null : define ('APP_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'user');
defined('INCLUDE_PATH') ? null : define ('INCLUDE_PATH',APP_ROOT.DS.'includes');
ob_start();
session_start();
// load config file first 
require_once("connection.php");
require_once("functions.php");
require_once("session.php");

?>