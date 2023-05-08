<?php 
	session_start();
	include_once '../includes/connection.php';

	if (isset($_POST["submit"])) {
		
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = md5($_POST["password"]);
		$confirm_password = md5($_POST["confirm_password"]);


		$check_username = "SELECT * FROM users WHERE (username = '$username')";
		$check_email = "SELECT * FROM users WHERE (email = '$email')";
		$username_result = mysqli_query($connection, $check_username);
		$email_result = mysqli_query($connection, $check_email);

		 if (mysqli_num_rows($username_result) > 0) {

		 	 $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Username is already exists!</div> ';
		    header('Location: ../register.php');

		 }else if(mysqli_num_rows($email_result) > 0){

		 	 $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Email address is already exists!</div> ';
		    header('Location: ../register.php');

		 } else {

		if ($password === $confirm_password) {

		$query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
		$query_run = mysqli_query($connection, $query);

		if ($query) {
		 	
		 	$_SESSION['msg'] = '<div class="alert text-center alert-success" role="alert">Registration Successfully</div>';
		 	header('Location: ../login.php');

		 } else {

		 	$_SESSION['msg'] = '<div class="alert text-center alert-danger" role="alert">Something went wrong!</div>';
		 	header('Location: ../register.php');

		 } 
			
	  } else {

	     	$_SESSION['msg'] = '<div class="alert text-center alert-danger" role="alert">Password and confirm password not same.</div>';
		 	header('Location: ../register.php');
	  }
     }
	}
?>
