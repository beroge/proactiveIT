<?php 
	session_start();
	ob_start();

	include_once '../includes/connection.php';

	if (isset($_POST["login"])) {
		
		$username = mysqli_real_escape_string($connection, trim($_POST["username"]));
		$password = mysqli_real_escape_string($connection, trim($_POST["password"]));

		$query = "SELECT * FROM admin WHERE username = '$username'";
		$run_query = mysqli_query($connection, $query);

		if (mysqli_num_rows($run_query) > 0) {
			while($row = mysqli_fetch_assoc($run_query)) {
				$id = $row["id"];
				$hashed_password = $row["password"];
				if (password_verify($password, $hashed_password)) {
					$_SESSION['id'] = $id;
					$_SESSION['msg'] = '<div class="alert text-center alert-success" role="alert">Login Successfully!</div>';
					header('Location: ../data/index.php');
					exit();
				}
			}
		}

		$_SESSION['msg'] = '<div class="alert text-center alert-danger" role="alert">Username or password you entered is incorrect.</div>';
		header('Location: ../login.php');
		exit();
	}
?>


