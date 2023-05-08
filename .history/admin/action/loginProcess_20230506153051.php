<?php 
	session_start();
	ob_start();

	include_once '../includes/connection.php';

	if (isset($_POST["login"])) {
		
		$username = $_POST["username"];
		$password = $_POST["password"];
		$password = md5($password);

		$query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
		$run_query = mysqli_query($connection, $query);

		if (mysqli_num_rows($run_query) > 0) {
			 while($row = mysqli_fetch_assoc($run_query)) {
		        $id = $row["id"];
		        $_SESSION['id'] = $id;
		      }
			
			$_SESSION['msg'] = '<div class="alert text-center alert-success" role="alert">Login Successfully!</div>';
		 	header('Location: ../index.php');

		} else {

			$_SESSION['msg'] = '<div class="alert text-center alert-danger" role="alert">Username or password you entered is incorrect.</div>';
		 	header('Location: ../login.php');

     }
	}
?>
