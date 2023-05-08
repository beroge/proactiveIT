<?php include_once 'includes/header.php'; ?>
<?php include_once 'includes/navbar.php'; ?>

<?php include_once 'includes/sidebar.php'; ?>

<div id="layoutSidenav_content">
    <main>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        
        <div class="container-fluid px-4">
            <h1 class="mt-4">Manage Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Manage Users</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Profile Pic</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Register Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Profile Pic</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Register Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php 
                            $query = "SELECT * FROM users ORDER BY id DESC";
                            $result = mysqli_query($connection,$query);
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                
                                <tr>
                                    <td><img class="rounded-circle text-center" width="70" height="70" src="../storage/<?php if ($row['profile_pic'] == NULL) {echo 'avatar.png';} else { echo $row['profile_pic']; } ?>" alt=""></td>
                                    <td><?php echo $row['fname'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['registered'] ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-info text-white" href="edit-user.php?id=<?php echo $row['id'] ?>">Edit</a>
                                        <a class="btn btn-sm btn-danger" href="action/deleteProcess.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure want to delete this user?')">Delete</a>
                                    </td>
                                </tr>

                            <?php  } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?php include_once 'includes/footer.php'; ?>