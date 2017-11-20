<?php 

	// Allow the config
	define('__CONFIG__', true);
	// Require the config
	require_once "../inc/config.php"; 


	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		// Always Return JSON Format.
		// header('Content-Type: application/json');

		$return = [];


		$email = Filter::String( $_POST['email'] );
		$password = $_POST['password'];

		$user_found = User::Find($email, true);

		// Check if user exists.
		if($user_found) { 

			$user_id = (int) $user_found['user_id'];
			$hash = (string) $user_found['password'];


			if(password_verify($password, $hash)) { 
				// User is signed in.
				$return['redirect'] = '/dashboard.php';

				$_SESSION['user_id'] = $user_id;

			} else {
				// Invalid email/password.
				$return['error'] = "Invalid E-Mail address or password.";

			}


		} else {
			// Create a new account.
			$return['error'] = "You do not have an account. <a href='/register.php'>Create one now?</a>";
		}




		// JSON_PRETTY_PRINT is a way to display the content in a readable way.
		echo json_encode($return, JSON_PRETTY_PRINT);
		exit;


	} else {
		exit('Invalid URL');
	}



?>

