<?php
	$servername = "localhost";  // Host name depends on server
	$username = "root"; // DataBase username
	$password = ""; // DataBase password
	$database = "database"; // DataBase name

	$conn = new mysqli($servername, $username, $password, $database);

	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	echo "";
?>
