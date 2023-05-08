<?php 
	session_start();
	ob_start();

	if (isset($_SESSION['id'])) {
		header('Location: users/');
	}
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

		<?php
			if (isset($_SESSION['msg'])) {
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
		 ?>

		 <div class="form bg-white p-3">

		<form action="action/loginProcess.php" method="post">

			<h2 class="mb-3 mt-2">Login</h2>

		  <div class="mb-3">
		    <label class="form-label">Username</label>
		    <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Username enter here." required="">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">Password</label>
		    <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Password enter here!" required="">
		  </div>

		  <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
		
		</form>
		  <a href="register.php" class="btn btn-primary mt-2 w-100">Register</a>
		</div>
	</div>
</div>


<?php include_once 'includes/footer.php'; ?>
