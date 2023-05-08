<?php

	session_start();
	ob_start();
	include_once '../includes/connection.php';
 
	if (!isset($_SESSION['id'])) {
		header('Location: ../login.php');
	}

	$userId = $_SESSION['id'];


	$query = "SELECT * FROM users WHERE id = '$userId'";
	$query_run = mysqli_query($connection, $query);
	$row = mysqli_fetch_assoc($query_run);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php if ($row['fname'] == !'') {echo $row['fname']; } else { echo $row['username']; } ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" href="../storage/<?php if ($row['profile_pic'] == NULL) {echo 'avatar.png';} else { echo $row['profile_pic']; } ?>" type="image/x-icon"/>
    <link rel="icon" href="../storage/<?php if ($row['profile_pic'] == NULL) {echo 'avatar.png';} else { echo $row['profile_pic']; } ?>" type="image/x-icon"/>

</head>
<body>
	<section class="py-5 my-5">
		<div class="container">
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
							<img src="../storage/<?php if ($row['profile_pic'] == NULL) {echo 'avatar.png';} else { echo $row['profile_pic']; } ?>" alt="" class="shadow">
						</div>
						<h4 class="text-center"><?php if ($row['fname'] == !'') {echo $row['fname']; } else { echo $row['username']; } ?></h4>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="home-tab" data-toggle="pill" href="#home" role="tab" aria-controls="home" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Home
						</a>

						<a class="nav-link" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-gear text-center mr-1"></i> 
							Account Setting
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Password
						</a>

						<a class="nav-link" href="logout.php" >
							<i class="fa fa-sign-out text-center mr-1"></i> 
							Logout
						</a>
					
					</div>
				</div>
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">

					<?php
						if (isset($_SESSION['msg'])) {
							echo $_SESSION['msg'];
							unset($_SESSION['msg']);
						}
					 ?>
					
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="jumbotron bg-white">
						  <h1 class="display-4">Hello, <?php echo $row['username'] ?>!</h1>
							<p>
							<?php
								date_default_timezone_set('Asia/Colombo');
								$time=date('Hi'); 

								if (($time >= "0600") && ($time <= "1200")) {
								  echo "Good Morning";
								} 

								elseif (($time >= "1201") && ($time <= "1600")) {
								  echo "Good Afternoon";
								}

								elseif (($time >= "1601") && ($time <= "2100")) {
								  echo "Good Evening";
								}

								elseif (($time >= "2101") && ($time <= "2400")) {
								  echo "Good Night";
								}
								else{
								  echo "Why aren't you asleep?  Are you programming?<br>";
								}
							?>
							</p>
							<p>Registered date: <?php echo $row['registered']; ?></p>

						</div>
					</div>

					<div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
						<h3 class="mb-4">Account Settings</h3>

						<form action="../action/updateProcess.php" method="post" enctype="multipart/form-data">
							
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Username</label>
								  	<input type="text" disabled="" name="username" class="form-control" value="<?php echo $row['username'] ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Full Name</label>
								  	<input type="text" class="form-control" name="fname" value="<?php echo $row['fname'] ?>" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Email</label>
								  	<input type="text" class="form-control" name="email" value="<?php echo $row['email'] ?>" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Phone number</label>
								  	<input type="text" class="form-control" name="phone" value="<?php echo $row['phone'] ?>" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Profile Picture: </label>
								  	<input type="file" class="form-control" name="profile_pic">
								</div>
							</div>

						</div>
						<div>
							<input type="submit" name="edit" class="btn btn-primary" value="Update">
						</div>
						</form>
						
					</div>

					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<h3 class="mb-4">Password Settings</h3>

						<form action="../action/resetProcess.php" method="post">					
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									  	<label>Username</label>
									  	<input type="text" value="<?php echo $row['username'] ?>" disabled class="form-control">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									  	<label>Old password</label>
									  	<input name="old_password" type="password" placeholder="Your Old password" class="form-control" required="">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									  	<label>New password</label>
									  	<input name="new_password" type="password" placeholder="Your new password" class="form-control" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
									  	<label>Confirm new password</label>
									  	<input name="confirm_password" type="password" placeholder="Confirm new password" class="form-control" r>
									</div>
								</div>
							</div>
							<div>
								<input type="submit" name="update" class="btn btn-primary" value="Update">
							</div>
						</form>
						

					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>