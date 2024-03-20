<?php include 'user-profile-data.php'; ?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | User Profile</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte.min.css">
</head>
<body class="hold-transitionsidebar-mini">
<div class="wrapper">
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="login-v2.php" class="brand-link">
      <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Log-out</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="userprofile.php" class="d-block">Alexander Pierce</a>
        </div>
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <!-- Activities content here -->
                    <div class="active tab-pane" id="activity">
  <!-- User information display -->
  <div class="active tab-pane" id="activity">


  <!-- Profile Card with User Details -->
 <div class="card card-primary card-center">
    <div class="card-body box-profile">
      <div class="text-center">
        <img class="profile-user-img img-fluid img-circle" src="profilepic.jpg" alt="User profile picture">
      </div>
      <h3 class="profile-username text-center"><?php echo $full_name; ?></h3>
      <p class="text-muted text-center">Bio</p>
      <div class="text-center">
        <p><?php echo $bio; ?></p>
      </div>
      <!-- User Details -->
      <ul class="list-group list-group-unbordered mb-3">

        <li class="list-group-item">
          <b>Fullname</b> <span class="float-right"><?php echo $full_name; ?></span>
        </li>
        <li class="list-group-item">
          <b>Email</b> <span class="float-right"><?php echo $email; ?></span>
        </li>
        <li class="list-group-item">
          <b>Phone Number</b> <span class="float-right"><?php echo $phone_number; ?></span>
        </li>
        <li class="list-group-item">
          <b>Address</b> <span class="float-right"><?php echo $address; ?></span>
        </li>
        <li class="list-group-item">
          <b>Date of Birth</b> <span class="float-right"><?php echo$date_of_birth; ?></span>
        </li>
        <li class="list-group-item">
          <b>Gender</b> <span class="float-right"><?php echo $gender; ?></span>
        </li>
        <li class="list-group-item">
          <b>Bio</b> <span class="float-right"><?php echo $bio; ?></span>
        </li>
        <li class="list-group-item">
          <b>Social Media</b> <span class="float-right"><?php echo $social_media; ?></span>
        </li>
      </ul>
      <a href="profile.php" class="btn btn-primary btn-block"><b>Edit Profile Info</b></a>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <!-- Timeline content here -->
                  </div>
                  <!-- /.tab-pane -->

                 

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


<?php
require_once 'user-profile-data.php';
?>

</body>
</html>