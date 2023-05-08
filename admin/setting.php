<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/navbar.php'; ?>
<?php include_once 'includes/sidebar.php'; ?>

<?php 

include_once 'includes/connection.php';

if(isset($_POST['edit'])) {

    $id = $_POST['id'];
    $username = $_POST["username"];

    $profile_pic = $_FILES["profile_pic"]["name"];
    $tmpname = $_FILES["profile_pic"]["tmp_name"];


    $check_img = "SELECT * FROM admin";
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

    $update = "UPDATE admin SET username = '$username', profile_pic='$checking_img'";
    $update_run = mysqli_query($connection, $update);


    if ($update_run) {

        if ($profile_pic == NULL) {

            $_SESSION['msg'] = '<div class="alert alert-success" role="alert"> Update Successfully!</div>';
            header('Location: setting.php');
            
        } else {

            $extension = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);

            if($extension=='jpg' || $extension=='jpeg' || $extension=='png'){

                move_uploaded_file($tmpname,"../storage/".$profile_pic);
                $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Profile Picture Update Successfully!</div>';
                header('Location: setting.php');
                
            } else {

                $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Error !!, Only jpeg, jpg and png image allowed. <br> It appears that you have selected something that is not valid as your profile picture. So your profile picture was deleted by the system</div>';
                header('Location: setting.php');

                $update2 = mysqli_query($connection, "UPDATE admin set profile_pic = NULL");

            }

        }

    } else {

        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert"> Something went wrong!</div>';
        header('Location: setting.php');

    }

}


if (isset($_POST['change_pass'])) {

    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $password = md5($password);

     $id = $_POST['id'];

    if ($new_password == $confirm_password)  {

        $update_pwd = mysqli_query($connection, "UPDATE `admin` SET `password` = '$new_password'");
        
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert"> Update Successfully!</div>';
        header('Location: setting.php');
        exit();
        
    } else  {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Your new password and Retype Password is not match.!</div>';
        header('Location: setting.php');
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

        <div class="container-fluid px-4">
            <h1 class="mt-4">Admin Profile</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Admin</li>
            </ol>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" autocomplete="off" name="username" value="<?php echo $adminRow['username']; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Profile Picture</label>
                            <input type="file"  class="form-control" name="profile_pic">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <img  width="150" src="../storage/<?php if ($adminRow['profile_pic'] == NULL) {echo 'avatar.png';} else { echo $adminRow['profile_pic']; } ?>" alt="" class="shadow">
                      </div>
                  </div>
              </div>
              <div>
                <input type="submit" name="edit" class="btn mt-3 btn-primary" value="Edit Admin">
            </div>
        </form>


        <div class="container-fluid px-4">
            <h1 class="mt-5">Change Password</h1>

            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6 mt-5 mb-3">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" autocomplete="off" name="new_password" placeholder="New Password" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 mt-5 mb-3">
                        <div class="form-group">
                            <label>Confirm new Password</label>
                            <input type="password"  class="form-control" placeholder="Confirm new Password" name="confirm_password">
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