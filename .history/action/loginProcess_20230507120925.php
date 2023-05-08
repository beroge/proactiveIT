<?php
session_start();
ob_start();

include_once '../includes/connection.php';

if (isset($_POST["submit"])) {
    $username = mysqli_real_escape_string($connection, $_POST["username"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    $query = "SELECT * FROM users WHERE username = '$username'";

    $run_query = mysqli_query($connection, $query);

    if (mysqli_num_rows($run_query) > 0) {
        $row = mysqli_fetch_assoc($run_query);
        $stored_hash = $row["password"];
        if (password_verify($password, $stored_hash)) {
            $id = $row["id"];
            $username = $row["username"];
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;

            $_SESSION['msg'] = '<div class="alert text-center alert-success" role="alert">Login Successfully!</div>';
            header('Location: ../users/');
        } else {
            $_SESSION['msg'] = '<div class="alert text-center alert-danger" role="alert">Username or password you entered is incorrect.</div>';
            header('Location: ../login.php');
        }
    } else {
        $_SESSION['msg'] = '<div class="alert text-center alert-danger" role="alert">Username or password you entered is incorrect.</div>';
        header('Location: ../login.php');
    }
}

?>