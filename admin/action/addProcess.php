<?php 

    session_start();
    ob_start();

	include_once '../includes/connection.php';

	if (isset($_POST["edit"])) {

    	$username = $_POST['username'];
		$fname = $_POST['fname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$password = md5($_POST['password']);

		$password = md5($password);

	    $profile_pic = $_FILES["profile_pic"]["name"];
	    $tmpname = $_FILES["profile_pic"]["tmp_name"];


		$check_username = "SELECT * FROM users WHERE (username = '$username')";
		$check_email = "SELECT * FROM users WHERE (email = '$email')";
		$username_result = mysqli_query($connection, $check_username);
		$email_result = mysqli_query($connection, $check_email);

		 if (mysqli_num_rows($username_result) > 0) {

		 	 $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Username is already exists!</div> ';
		     header('Location: ../add-user.php');

		 }else if(mysqli_num_rows($email_result) > 0){

		 	 $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Email address is already exists!</div> ';
		     header('Location: ../add-user.php');

		 } else {

		    $query = "INSERT INTO users (username, fname, email, password, phone, profile_pic) VALUES ('$username', '$fname', '$email', '$password', '$phone', '$profile_pic')";

			  $query_run = mysqli_query($connection, $query);

			    if ($query_run) {
			    	  move_uploaded_file($tmpname,"../../storage/".$profile_pic);
					  $_SESSION['msg'] =  '<div class="alert alert-success" role="alert"> This user has been added Successfully!</div> ';
			          header('Location: ../add-user.php');

				} else{

					 $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Something went wrong!</div> ';
				     header('Location: ../add-user.php');
				    
				}

		 }
	}
?>