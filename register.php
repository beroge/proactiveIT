<?php 
	session_start();
	ob_start();

	include_once 'includes/connection.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RX UMS</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<div class="container">
	<div class="position-absolute top-50 start-50 translate-middle">
		<div class="form bg-white p-3">
		<form action="action/registerProcess.php" method="post">
			<h2 class="mb-3 mt-2">Register</h2>
			   <?php
                        if (isset($_SESSION['msg'])) {
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        }
                     ?>
		  <div class="mb-3">
		    <label class="form-label">Username</label>
		    <input type="text" name="username" autocomplete="off" id="username" class="form-control" placeholder="Username enter here." required="">
		    <span id="usernameAvailability"></span>
		    <span id="usernameChecking"></span>
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Email address</label>
		    <input type="email" id="email" name="email" autocomplete="off" class="form-control" placeholder="Email address enter here." required="">
		    <span id="emailAvailability"></span>
		    <span id="emailChecking"></span>
		    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <input type="password" name="password" id="password" autocomplete="off" class="form-control" placeholder="Password enter here!" required="">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Confirm Password</label>
		    <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" class="form-control"  placeholder="Confirm password enter here!" required="">
		  </div>

		  <button type="submit" id="submit" name="submit" class="btn btn-primary w-100">Register</button>
		</form>
		<a href="login.php" class="btn btn-primary mt-2 w-100">Login</a>
	</div>
	</div>
</div>


<?php include_once 'includes/footer.php'; ?>
