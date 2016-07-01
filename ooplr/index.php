<?php  
require_once 'core/init.php';

if(Session::exists('home')){
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()){
?>
	<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->name); ?>"><?php echo escape($user->data()->name); ?></a></p>

	<ul>
		<li><a href="logout.php">Log out</a></li>
		<li><a href="update.php">Update details</a></li>
		<li><a href="changepassword.php">Update password</a></li>

	</ul>
<?php
}else{
	echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register</a>';
}

if($user->hasPermission('admin')){
	echo '<p>You are an administrator!</p>';
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

