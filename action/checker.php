<?php 

	include_once '../includes/connection.php';

	if (isset($_POST["username"])) {
		
		$username = $_POST["username"];

		$check = "SELECT * FROM users WHERE username = '$username'";

		$run_check = mysqli_query($connection, $check);

		if (mysqli_num_rows($run_check) > 0) {
			
			echo '<div class="text-left text-danger">'.$username.' is already taken!</div>';

		} else {

			echo '<div class="text-left text-success">'.$username.' is available</div>';
     }
	
	}
	

	if (isset($_POST["email"])) {
		
		$email = $_POST["email"];

		$check = "SELECT * FROM users WHERE email = '$email'";

		$run_check = mysqli_query($connection, $check);

		if (mysqli_num_rows($run_check) > 0) {
			
			echo '<div class="text-left text-danger">'.$email.' is already exists!</div>';

		} else {

			// echo '<div class="text-left text-success">'.$email.' is available</div>';
     }
	}
?>
