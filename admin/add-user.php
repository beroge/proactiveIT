<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/navbar.php'; ?>

<?php include_once 'includes/sidebar.php'; ?>
<?php include_once '../action/checker.php'; ?>

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
				<h1 class="mt-4">Add Users</h1>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Add Users</li>
				</ol>

				<form action="action/addProcess.php" method="post" enctype="multipart/form-data">

					<div class="row">
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Username</label>
								<input type="text" id="username" name="username" class="form-control" autocomplete="off" placeholder="Username">
								<span id="usernameAvailability"></span>
								<span id="usernameChecking"></span>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Full Name</label>
								<input type="text"  class="form-control" name="fname" required="" placeholder="Full Name">
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="email" class="form-control" name="email" required="" placeholder="Emaill Address">
								<span id="emailAvailability"></span>
								<span id="emailChecking"></span>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Phone number</label>
								<input type="phone" class="form-control" name="phone" placeholder="Phone Number">
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Profile Picture: </label>
								<input type="file" class="form-control" name="profile_pic">
							</div>
						</div>

						<div class="col-md-6 mb-3">
							<div class="form-group">
								<label>Password: </label>
								<input type="password" class="form-control" name="password" required="" placeholder="Password">
							</div>
						</div>

					</div>
					<div>
						<input type="submit" name="edit" class="btn mt-3 btn-primary" value="Add User">
					</div>
				</form>

			</div>
		</div>
	</main>

	<?php include_once 'includes/footer.php'; ?>


