<?php  
require_once 'core/init.php';

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()){
?>
	<p>Hello <a href="#"><?php echo escape($user->data()->username); ?></a></p>

	<ul>
		<li><a href="logout.php">Log out</a></li>
	</ul>
<?php
}else{
	echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a>';
}
/*$user = DB::getInstance()->get('users',array('username','=','fred'));
if(!$user->count()){
	echo 'No user ';
}else{
	echo $user->first()->username;
} */

/*$userInsert = DB::getInstance()->insert('users',array(
		'username' => 'Dale',
		'password' => 'password',
		'salt' => 'salt'
	));*/

/*$userUpdate = DB::getInstance()->update('users', 2 ,array(
		'username' => 'John',
		'password' => 'newpassword',
		'salt' => 'salt'
	));*/

