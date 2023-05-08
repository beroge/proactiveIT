<?php 

	include_once 'includes/connection.php';

	if (!isset($_SESSION['id'])) {
		header('Location: login.php');
	
	} else {
		header('users/');
	}

 ?>