<?php 
session_start();
require "config/config.php";

if ($_POST) {
  $email = $_POST['email'];
  $password = $_POST['password'];

$stmt = $pdo -> prepare ("SELECT * FROM user WHERE email=:email");

$stmt -> bindValue(':email',$email);
 
$stmt-> execute();

$result = $stmt -> fetch(PDO::FETCH_ASSOC);

if ($result) {
  if ($result['password'] == $password) {
    $_SESSION['role'] = 0;
    $_SESSION['user_id'] = $result['id'];
    $_SESSION['user_name'] = $result['name'];
    $_SESSION['loggin_at'] = time();
  
    header("Location: index.php");
  }else {
    echo"<script> alert('Incorrect email or password') </script>";
  }

}else {
  echo"<script> alert('Incorrect email or password') </script>";
}

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.html"><b>Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign to start your session</p>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="container">
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            <a href="register.php" type="button" class="btn btn-default btn-block">Register</a>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

      
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
