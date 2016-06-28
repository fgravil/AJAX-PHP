<?php
require_once 'core/init.php';
//Updates needed
if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST,array(
			'username' => array('required' => true),
			'password' => array('required' => true)
			));
		if($validate->passed()){
			$user = new User();
			$login = $user->login(Input::get('username'),Input::get('password'));
			if($login){
				echo 'Success';
			}else{
				echo 'Sorry, Log in failed.';
			}

		}else{
			foreach($validate->errors() as $error){
				echo $error, '<br>';
			}
		}
	}
}
?>

<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" autocomplete="off">
	</div>
	<div class="field">
		<label for="password">Username</label>
		<input type="password" name="password" id="password" autocomplete="off">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" name="">
</form>
