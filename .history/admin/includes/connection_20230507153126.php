<?php
	$servername = "localhost";  // Host name depends on server
	$username = "root"; // DataBase username
	$password = ""; // DataBase password
	$database = "database"; // DataBase name

	 = new mysqli($servername, $username, $password, $database);

	if ($connection->connect_error) {
	  die("Connection failed: " . ->connect_error);
	}
	echo "";
?>
