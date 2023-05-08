<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/navbar.php'; ?>

<?php include_once 'includes/sidebar.php'; ?>
<?php include_once '../action/checker.php'; ?>

<?php 

include_once 'includes/connection.php';

$userId = $_GET['id'];

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id='$userId'";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_array($result);

if(isset($_POST['edit'])) {

	$userId = $_GET['id'];

	$username = $_POST["username"];
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

	$update = "UPDATE users SET username = '$username', fname = '$fname', email='$email', phone= '$phone', profile_pic='$checking_img' WHERE id='$userId'";
	$update_run = mysqli_query($connection, $update);


	if ($update_run) {

		if ($profile_pic == NULL) {
			
			$_SESSION['msg'] = '<div class="alert alert-success" role="alert"> Update Successfully!</div>';
			header('Location: manage-user.php');
			
		} else {

			$extension = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);

			if($extension=='jpg' || $extension=='jpeg' || $extension=='png'){

				move_uploaded_file($tmpname,"../storage/".$profile_pic);
				$_SESSION['msg'] = '<div class="alert alert-success" role="alert">Profile Picture Update Successfully!</div>';
				header('Location: manage-user.php');
				
			} else {

				$_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Error !!, Only jpeg, jpg and png image allowed. <br> It appears that you have selected something that is not valid as your profile picture. So your profile picture was deleted by the system</div>';
				header('Location: manage-user.php');

				$update2 = mysqli_query($connection, "UPDATE users set profile_pic = NULL WHERE id='$userId'");

			}


		}

	} else {

		$_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Something went wrong!</div>';
		header('Location: manage-user.php');

	}

}


if (isset($_POST['change_pass'])) {
	
	$new_password = md5($_POST['new_password']);
	$confirm_password = md5($_POST['confirm_password']);

	$password = md5($password);

	$userId = $_GET['id'];

	if ($new_password == $confirm_password)  {

		$update_pwd = mysqli_query($connection, "UPDATE `users` SET `password` = '$new_password' WHERE id = '$userId'");
		
		$_SESSION['msg'] = '<div class="alert alert-success" role="alert"> Update Successfully!</div>';
		header('Location: manage-user.php');
		exit();
		
	} else  {
		$_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Your new password and Retype Password is not match.!</div>';
		header('Location: manage-user.php');
		exit();
	}
 }
?>

<div id="layoutSidenav_content">
	<main>
	   <?php
		if (isset($_SESSION['msg'])) {
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
		<div class="container">
			<div class="container-fluid px-4">
				<h1 class="mt-4">Edit Users</h1>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Edit Users</li>
				</ol>

				<form action="" method="post" enctype="multipart/form-data">
					
					<div class="row">
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Username</label>
								<input type="text" id="username" autocomplete="off" name="username" value="<?php echo $row['username']; ?>" class="form-control">
								<span id="usernameAvailability"></span>
								<span id="usernameChecking"></span>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Full Name</label>
								<input type="text"  class="form-control" value="<?php echo $row['fname']; ?>" name="fname" required="">
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="email" class="form-control" value="<?php echo $row['email']; ?>" name="email" required="">
								<span id="emailAvailability"></span>
								<span id="emailChecking"></span>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Phone number</label>
								<input type="phone" class="form-control" value="<?php echo $row['phone']; ?>" name="phone" >
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Profile Picture: </label>
								<input type="file" class="form-control" value="<?php echo $row['profile_pic']; ?>" name="profile_pic">
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<div class="form-group">
								<img width="100" src="../storage/<?php echo $row['profile_pic']; ?>" alt="">
							</div>
						</div>

					</div>
					<div>
						<input type="submit" name="edit" class="btn mt-3 btn-primary" value="Edit User">
					</div>
				</form>


				<div class="container-fluid px-4">
					<h1 class="mt-4">Change Password</h1>
				</div>


				<form action="" method="post">
					<div class="row">
						<div class="col-md-6 mt-5 mb-3">
							<div class="form-group">
								<label>New Password</label>
								<input type="password" name="new_password" class="form-control" placeholder="New Password">
							</div>
						</div>
						<div class="col-md-6 mt-5 mb-3">
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="password"  class="form-control" name="confirm_password" required="" placeholder="Confirm Password">
							</div>
						</div>
					</div>
					<div>
						<input type="submit" name="change_pass" class="btn mt-3 btn-primary" value="Change Password">
					</div>
				</form>
			</div>
		</div>
	</main>

<?php include_once 'includes/footer.php'; ?>


