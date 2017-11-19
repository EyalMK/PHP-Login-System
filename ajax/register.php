<?php 

	// Allow the config
	define('__CONFIG__', true);
	// Require the config
	require_once "../inc/config.php"; 


	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		// Always Return JSON Format.
		header('Content-Type: application/json');

		$return = [];

		// Make sure the user doesn't exist.


		// Make sure the user can be added and is added.


		// Return the appropriate information back to JavaScript to redirect us.
		$return['redirect'] = '/dashboard.php';




		// JSON_PRETTY_PRINT is a way to display the content in a readable way.
		echo json_encode($return, JSON_PRETTY_PRINT);
		exit;


	} else {
		exit('test');
	}



?>

