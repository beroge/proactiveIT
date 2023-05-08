<?php 

session_start();

	include_once '../includes/connection.php';

	$userId = $_SESSION['id'];

	$id = $_GET['id'];
	$query = "SELECT * FROM users WHERE id='$userId'";
	$result = mysqli_query($connection,$query);
	$row = mysqli_fetch_array($result);

	if(isset($_POST['edit'])) {

	$userId = $_SESSION['id'];

	$fname = $_POST["fname"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];

	$profile_pic = $_FILES["profile_pic"]["name"];
	$tmpname = $_FILES["profile_pic"]["tmp_name"];


	$check_img = "SELECT * FROM users WHERE id = '$userId'";
	$checkImg_res = mysqli_query($connection, $check_img);

	foreach ($checkImg_res as $checkImg_row) {
	   
	   if ($profile_pic == NULL) {
	     
	     $checking_img = $checkImg_row['profile_pic'];
	   
	   } else {

	    if ($imgPath = "../storage/" .$checkImg_row['profile_pic']) {
	        
	        unlink($imgPath);
	        $checking_img = $profile_pic;

	    }
   
	   }
	}

	  $update = "UPDATE users set fname = '$fname' , email='$email', phone= '$phone', profile_pic='$checking_img' WHERE id='$userId'";
	  $update_run = mysqli_query($connection, $update);


	  if ($update_run) {

	    if ($profile_pic == NULL) {
	        
	         $_SESSION['msg'] = '<div class="alert alert-success" role="alert"> Update Successfully!</div>';
	         header('Location: ../users/');
	   
	    } else {

	    	$extension = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);

	    	if($extension=='jpg' || $extension=='jpeg' || $extension=='png'){

	         move_uploaded_file($tmpname,"../storage/".$profile_pic);
	         $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Profile Picture Update Successfully!</div>';
	         header('Location: ../users/');
	   
	    	} else {

		     $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Error !!, Only jpeg, jpg and png image allowed. <br> It appears that you have selected something that is not valid as your profile picture. So your profile picture was deleted by the system</div>';
		     header('Location: ../users/');

		      $update2 = mysqli_query($connection, "UPDATE users set profile_pic = NULL WHERE id='$userId'");

	    	}


	    }

	  } else {

	     $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Something went wrong!</div>';
	     header('Location: ../users/');

	  }

	}
?>