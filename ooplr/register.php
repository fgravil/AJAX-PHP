<?php  
require_once 'core/init.php';

//Checks if the required input fields have been submitted and properly validated.
//If the submitted input is passes the validation requirements, the new User can be
//created via the user class.
if(Input::exists('post')){

	if(Token::check(Input::get('token'))){
		$validate = new Validate();

		//Requirements for some of the fields
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
			$user = new User();

			//generates a random salt of siize 32
		   $salt = Hash::salt(32);
		   //creates the user by providing all the required input fiields to be passed into the DB
		   //Once the User is created the page redirects to the home page
			try{
				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'),$salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
					'group' => 1
					));

				Session::flash('home','You have been registered and can now log in!');
				Redirect::to('index.php');
			}catch(Exception $e){
				die($e->getMessage());
			}
		}else{
			foreach($validate->errors() as $error){
				echo $error . '<br>';
			}
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

	<input type="hidden" name="token" value="<?php echo Token::generate() ?>">
	<input type="submit" name="submit" value="Register">
</form>