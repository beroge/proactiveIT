<?php
	$servername = "localhost";  // Host name depends on server
	$username = "root"; // DataBase username
	$password = "mysql"; // DataBase password
	$database = "user_management"; // DataBase name

	$connection = new mysqli($servername, $username, $password, $database);

	if ($connection->connect_error) {
	  die("Connection failed: " . $connection->connect_error);
	}
	echo "";
?>
