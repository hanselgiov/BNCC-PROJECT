<?php
  include 'config.php';
  session_start();
  
  if (isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    
  }
  
  if (isset($_POST['submit'])) {

    // check if remember checked
    if (isset($_POST['remember'])) {
      setcookie('remember_email', $_POST['email'], time() + (30 * 24 * 60 * 60)); // cookie berlaku selama 30 hari
    }
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = hash('md5', $_POST['password']); 

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {

        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        header("Location: dashboard.php");
        exit();

    } else {
        echo "<script>
        alert('Email atau password salah ');
        window.location.href = 'login.php';
        </script>";
        exit();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Attendance </b>System</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form action="" method="post">
        <div class="input-group my-3">
          <input type="email" class="form-control" name="email" placeholder="Email" <?= (isset($_COOKIE['remember_email'])) ? "value =" . $_COOKIE['remember_email'] . "": "" ?> <?= (isset($_COOKIE['remember_email'])) ? "required" : "required autofocus" ?> >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" 
              <?= (isset($_COOKIE['remember_email'])) ? "autofocus" : "";?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">Remember Me</label>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12 mt-3">
            <button name="submit" type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
