<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">


<form action="change_password.php" method="post">
  <label for="current_password">Current Password:</label>
  <input type="password" id="current_password" name="current_password"><br>

  <label for="new_password">New Password:</label>
  <input type="password" id="new_password" name="new_password"><br>

  <label for="confirm_password">Confirm New Password:</label>
  <input type="password" id="confirm_password" name="confirm_password"><br>

  <input type="submit" value="Change Password">
</form>
