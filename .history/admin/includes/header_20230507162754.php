<?php 
session_start();    
ob_start();
include_once 'connection.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit(); // stop executing script
}

// $user_qry = "SELECT count(*) as total from users";
// $user_result = mysqli_query($connection, $user_qry);
// $user_row = mysqli_fetch_assoc($user_result);

// $admin_qry = "SELECT count(*) as total from admin";
// $admin_result = mysqli_query($connection, $admin_qry);
// $admin_row = mysqli_fetch_assoc($admin_result);

// $adminId = $_SESSION['id'];

// $admin_query = "SELECT * FROM admin WHERE id = '$adminId'";
// $admin_query_run = mysqli_query($connection, $admin_query);
// $adminRow = mysqli_fetch_assoc($admin_query_run);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>User Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
   
    </head>
    <body class="sb-nav-fixed">
