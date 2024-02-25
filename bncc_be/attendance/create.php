<?php
include 'config.php';
session_start();
 
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit(); 
}

if(isset($_POST['submit'])){

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    
    // validate email
    $q = "SELECT * FROM user WHERE email='$email'";
    $r = mysqli_query($conn, $q);
    $n = mysqli_num_rows($r);

    if($n > 0){
      echo "<script>
      alert('Email sudah digunakan');
      window.location.href = 'create.php';
      </script>";
    }
    //
    else{

      // generate id and pass
      
      $id = uniqid("UD");
      $pass = strtolower($firstName) . "123";
      $pass = md5($pass);      

      mysqli_query($conn, "INSERT INTO user VALUES('$id','$firstName','$lastName','$email', '$pass', '$bio')");
      
      echo "<script>
      alert('User berhasil di tambah');
      window.location.href = 'dashboard.php';
      </script>";
      
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Attendance System</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

</head>

<body class="hold-transition layout-top-nav">   
<div class="wrapper layout-top-nav">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand   navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav ml-5">
      <!-- <li class="nav-item">
        
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li> -->
      <li class="nav-item d-none active d-sm-inline-block justify-content-start">
        <a href="dashboard.php" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block justify-content-start">
        <a href="logout.php" class="nav-link">Profile</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto mr-5">
      
      <li class="nav-item d-none d-sm-inline-block justify-content-end">
        <a href="logout.php" onclick="return confirm('Yakin ingin logout?');"; class="nav-link">Logout</a>
      </li>
    </ul>
  </nav>

  <!-- /.navbar -->



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper px-5">
    <div class="content-header">
      <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-12 ">
          <h1 class="mb-0 mt-2 mx-2 text-center">Tambah User</h1>
      </div><!-- /.col -->
      </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  </div> <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
      <div class="card">
        <div class="card-body  p-3">
        <form action="" method="post" enctype="multipart/form-data">                
                <div class="row mx-1 mt-2">            
                  <div class="form-group col-4">
                        <label for="firstName">First Name</label>
                        <input type="text" class="form-control" placeholder="First Name" name="firstName"  required autofocus>
                    </div>
                    <div class="form-group col-4">
                        <label for="lastName">Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" name="lastName" required>
                    </div>
                    <div class="form-group col-4">
                        <label for="lastName">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                  </div>
                  <div class="row mx-1 mb-1">
                    
                    <div class="form-group col-12">
                        <label for="lastName">Bio</label><br>
                        <textarea name="bio" class="form-control" id="bio" cols="100" rows="3"></textarea>
                    </div>
                    <div class="col-1 mt-3">
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    
            
                  </div>
            </form>

        </div>
      </div>
      <!-- /.card-body -->

    </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


  </div><!-- /.content-wrapper -->  
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- bs-custom-file-input -->
<script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>
</body>
</html>

    