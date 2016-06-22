<?php  
session_start();

//Database information to be able to get access to db
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => 'root',
		'db' => 'register_system'
		),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
		),
	'session' => array(
		'session_name' => 'user'
		)
);

//autoloads all needed classes
spl_autoload_register(function($class){
	require_once 'classes/' . $class . '.php';
});

//loads the sanitize function
require_once 'functions/sanitize.php';