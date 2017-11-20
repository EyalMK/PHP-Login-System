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

		// Make sure the user doesn't exist.
		$findUser = $con->prepare("SELECT user_id, password FROM users WHERE email = LOWER(:email) LIMIT 1"); // With PDO you can pull variable outside of SQL statement which means less SQL injection chance.
		$findUser->bindParam(':email', $email, PDO::PARAM_STR); // Bind parameter. $email must be a variable (PDO)
		$findUser->execute();


		// Check if user exists. If user exists, sign them in.
		if($findUser->rowCount() == 1 ) { 
			$User = $findUser->fetch(PDO::FETCH_ASSOC);

			$user_id = (int) $User['user_id'];
			$hash = (string) $User['password'];


			if(password_verify($password, $hash)) { 
				// User is signed in.
				$return['redirect'] = '/dashboard.php';

				$_SESSION['user_id'] = $user_id;

			} else {
				// Invalid email/password.
				$return['error'] = "Invalid E-Mail address or password.";

			}


			$return['error'] = "Account already exists.";
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

