<?php 

function ForceLogin() {
	if (isset($_SESSION['user_id'])) {



	} else {
		// Redirect if not logged in/session is not stored.
		header("Location: /login.php");
		exit;

	}
}

function ForceDashboard() {
	if (isset($_SESSION['user_id'])) {
		// Redirect if session exists.
		header("Location: /dashboard.php");
		exit;

	} else {


	}
}

 ?>