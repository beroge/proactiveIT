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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Total Admins</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <span class="small text-white"><?php  echo $admin_row['total']; ?> users</span>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Users</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <span class="small text-white"><?php  echo $user_row['total']; ?> users</span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
<?php include_once 'includes/footer.php'; ?>