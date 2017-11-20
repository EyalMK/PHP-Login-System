<?php

// If there is no constant defined called __CONFIG__, do not load this file 
if(!defined('__CONFIG__')) {
	exit('You do not have a config file');

}


class Page {

	static function ForceLogin() {
		if (isset($_SESSION['user_id'])) {

		} else {
			// Redirect if not logged in/session is not stored.
			header("Location: /login.php");
			exit;

		}
	}

	static function ForceDashboard() {
		if (isset($_SESSION['user_id'])) {
			// Redirect if session exists.
			header("Location: /dashboard.php");
			exit;

		} else {


		}
	}
}

?>
