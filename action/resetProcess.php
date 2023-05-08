<?php 
	session_start();
	include_once '../includes/connection.php';

 
if (isset($_POST['update'])) {
	  $old_password = md5($_POST['old_password']);
	  $new_password = md5($_POST['new_password']);
	  $confirm_password = md5($_POST['confirm_password']);

      $password = md5($password);

      $userid = $_SESSION['id'];
      $pass_qry="SELECT * FROM users WHERE id='".$userid."'";

      $pass_result = mysqli_query($connection, $pass_qry);
      $pass_user = mysqli_fetch_array($pass_result);

      $password = $pass_user['password'];

      if ($password == $old_password) {
       
        if ($new_password == $confirm_password)  {

          $update_pwd = mysqli_query($connection, "UPDATE `users` SET `password` = '$new_password' WHERE `users`.`id` = '".$userid."'");
          
             $_SESSION['msg'] = '<div class="alert alert-success" role="alert"> Update Successfully!</div>';
	         header('Location: ../users/');
            
            exit();
          }
         
          else  {
            $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Your new password and Retype Password is not match.!</div>';
	         header('Location: ../users/');
            exit();
          }
        }
       
        else  {

             $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Your old password was entered incorrectly please enter it again.!</div>';
	         header('Location: ../users/');
            exit();
        }
      }
 
?>