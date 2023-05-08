<?php
	$servername = "localhost";  // Host name depends on server
	$username = "root"; // DataBase username
	$password = ""; // DataBase password
	$database = "database"; // DataBase name

	$connection = new mysqli($servername, $username, $password, $database);

	if ($connection->connect_error) {
	  die("Connection failed: " . $connection->connect_error);
	}
	echo "";
?>
