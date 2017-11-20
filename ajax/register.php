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

		// Make sure the user doesn't exist.
		$findUser = $con->prepare("SELECT user_id FROM users WHERE email = LOWER(:email) LIMIT 1"); // With PDO you can pull variable outside of SQL statement which means less SQL injection chance.
		$findUser->bindParam(':email', $email, PDO::PARAM_STR); // Bind parameter. $email must be a variable (PDO)
		$findUser->execute();


		// Check if user exists.
		if($findUser->rowCount() == 1 ) { 
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

