<?php
session_start();

define("WEB_ROOT", '/fleets');

//Database Configuration
$GLOBALS['config'] = array(
  'mysql' => array(
    'host' => '127.0.0.1',
    'username' => 'root',
    'password' => '',
    'db' => 'fleets'
  ),
  'session' => array(
    'session_name' => 'user',
    'token_name' => 'token'
  )
);

require_once 'functions/sanitize.php';

spl_autoload_register(function ($class) {
  require_once 'classes/'. $class . '.php';
});