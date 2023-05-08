<?php 

include_once '../includes/connection.php';

   session_start();

	$userId = $_GET['id'];

	$delete_query = "SELECT * FROM users WHERE id = '$userId'";
	$result = mysqli_query($connection,$delete_query);
	$row = mysqli_fetch_array($result);

	$query = mysqli_query($connection, "DELETE FROM users WHERE id = '$userId'");

	if ($query) {
		
		$path = $row['profile_pic'];

		unlink('../../storage/'.$path);

		$_SESSION['msg'] = '<div class="alert alert-success" role="alert">Delete Successfully!</div>';
		  header('Location: ../manage-user.php');

	} else {

		$_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Something went wrong!</div>';
		  header('Location: ../manage-user.php');
	}


 ?>