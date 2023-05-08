<?php 
	session_start();
	ob_start();

	include_once '../includes/connection.php';

	if (isset($_POST["submit"])) {
		
		$username = $_POST["username"];
		$password = $_POST["password"];
		$password = md5($password);


		$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

		$run_query = mysqli_query($connection, $query);

		if (mysqli_num_rows($run_query) > 0) {
			 while($row = mysqli_fetch_assoc($run_query)) {
		        $id = $row["id"];
		        $username = $row["username"];
		        $_SESSION['id'] = $id;
		        $_SESSION['username'] = $username;
		      }
			
			$_SESSION['msg'] = '<div class="alert text-center alert-success" role="alert">Login Successfully!</div>';
		 	header('Location: ../users/');

		} else {

			$_SESSION['msg'] = '<div class="alert text-center alert-danger" role="alert">Username or password you entered is incorrect.</div>';
		 	header('Location: ../login.php');

     }
	}
?>
