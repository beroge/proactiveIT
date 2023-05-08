<?php
session_start();
error_reporting(1);
$errors = [];

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
  header('Location: login.php');
  exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $current_password = $_POST['current_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];



  if (!preg_match('/[0-9]/', $new_password)) {
    $errors[] = 'New password must contain at least one digit.';
  }

  if ($new_password !== $confirm_password) {
    $errors[] = 'Confirmed new password does not match new password.';
  }

  // If there are no errors, update the user's password
  if (empty($errors)) {
    $user_id = $_SESSION['loggedin'];

    // Retrieve the user's current password hash from the database
    $db = new PDO('mysql:host=localhost;dbname=phplogin', 'root', '');
    $stmt = $db->prepare('SELECT password FROM accounts WHERE id = ?');
    if ($stmt->execute([$user_id])) {
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $current_password_hash = $result['password'];

      // Verify the user's current password
      if (!password_verify($current_password, $current_password_hash)) {
        $errors[] = 'Current password is incorrect.';
      }

      // Generate a bcrypt hash of the new password
      $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);

      // Update the user's password in the database
      if (empty($errors)) {
        $stmt = $db->prepare('UPDATE accounts SET password = ? WHERE id = ?');
        if ($stmt->execute([$new_password_hash, $user_id])) {
          // Notify the user that their password has been changed
          $_SESSION['password'] = $new_password_hash;
          $success_message = 'Password changed successfully.';
          
        } else {
          $errors[] = 'Failed to update password.';
        }
      }
    } else {
      $errors[] = 'Failed to retrieve current password.';
    }
  }
  header('Location: login.php');
}
?>
