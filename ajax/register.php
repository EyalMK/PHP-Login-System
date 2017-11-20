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

		$user_found = User::Find($email);

		// Check if user exists.
		if($user_found) { 
			$return['error'] = "Account already exists.";
		} else {

			// User doesn't exist. Add them.

			$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security.


			$addUser = $con->prepare("INSERT INTO users(email, password) VALUES(LOWER(:email), :password)");
			$addUser->bindParam(':email', $email, PDO::PARAM_STR);
			$addUser->bindParam(':password', $password, PDO::PARAM_STR);
			$addUser->execute();

			$user_id = $con->lastInsertId();

			$_SESSION['user_id'] = (int) $user_id;

			// Return the appropriate information back to JavaScript to redirect us.
			$return['redirect'] = '/dashboard.php?message=welcome';

		}




		// JSON_PRETTY_PRINT is a way to display the content in a readable way.
		echo json_encode($return, JSON_PRETTY_PRINT);
		exit;


	} else {
		exit('Invalid URL');
	}



?>

