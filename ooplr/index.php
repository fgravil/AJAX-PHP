<?php  
require_once 'core/init.php';

$user = DB::getInstance()->get('users',array('username','=','fred'));
if(!$user->count()){
	echo 'No user ';
}else{
	echo 'OK!';
}