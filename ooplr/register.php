<?php  
require_once 'core/init.php';

if(Input::exists('post')){
	$validate = new Validate();
	$validation = $validate->check($_POST,array(
		'username' => array(
			'required' => true,
			'min' => 2,
			'max' => 20,
			'unique' => 'users'
			),
		'password' => array(
			'required' => true,
			'min' => 6
			),
		'password_again' => array(
			'required' => true,
			'matches' => 'password'
			),
		'name' => array(
			'required' =>true,
			'min' => 2,
			'max' => 50
			)
	));

	if($validate->passed()){
		echo 'Passed';
	}else{
		foreach($validate->errors() as $error){
			echo $error . '<br>';
		}
	}

}
?>
<form action="" method="post">
	<div class="field">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
	</div>
	
	<div class="field">
		<label for="password">Choose a password</label>
		<input type="password" name="password" id="password">
	</div>

	<div class="field">
		<label for="password_again">Enter password again</label>
		<input type="password" name="password_again" id="password_again">
	</div>

	<div class="field">
		<label for="name">Enter name</label>
		<input type="name" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">
	</div>

	<input type="submit" name="submit" value="Register">
</form>