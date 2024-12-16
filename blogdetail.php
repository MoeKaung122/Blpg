<?php 
session_start();
if (empty( $_SESSION['user_id'] ) && empty($_SESSION['loggin_at'])) {
  header('Location:login.php');
}
require "config/config.php";

$stmt = $pdo -> prepare("SELECT * FROM post WHERE id=".$_GET['id']);
$stmt -> execute();
$result = $stmt -> fetchAll();



$blogid = $_GET['id'];
$cmstmt = $pdo -> prepare("SELECT * FROM  comment WHERE post_id=$blogid" );
$cmstmt -> execute();
$cmresult = $cmstmt -> fetchAll();

$auresult=[];

if ($cmstmt) {
  foreach ($cmresult as $key => $value) {
    $authorid = $cmresult[$key]['author_id'];
    $austmt = $pdo -> prepare("SELECT * FROM user WHERE id=$authorid" );
    $austmt -> execute();
    $auresult[]= $austmt -> fetchAll();
  }
}

if ($_POST) {
  
  $comment = $_POST['comment'];
  $stmt= $pdo -> prepare("INSERT INTO comment (contend , author_id	 ,post_id) VALUES(:contend ,:author_id,:post_id) ");

  $result = $stmt-> execute(
       array(':contend' =>$comment ,':author_id'=> $_SESSION['user_id']  ,':post_id'=>$blogid)
  );
  if ($result) {
   header("Location: blogdetail.php?id=".$blogid);
  }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Widgets</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
 

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left:0px !important">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-md-12">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
              <div style="text-align:center  !important; float:none " class="card-title" >
              <h4><?php echo $result['0'] ['title']?></h4>
             </div>
                <!-- /.user-block -->
                
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <img class="img-fluid pad" src="admin/images/<?php echo $result['0']['image']; ?>" alt="Photo"><br><br>

                <p><?php echo $result['0']['content']; ?></p>
                 <h3>conment</h3>
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <div class="">
                                <a href="index.php"type="button" class="btn btn-warning" >back</a>
                              </div><br>
                   <?php 
                   if ($cmresult) {
                  ?>
                    <div class="comment-text"style="margin-left:0px   !important" >
                          <?php
                          foreach ($cmresult as $key => $value) {
                            ?>
                            <span class="username">
                            <?php print_r($auresult[$key] [0] ['name'])?>
                           <span class="text-muted float-right"><?php echo $value['created_at'] ?></span>
                          </span><!-- /.username -->
                          <?php echo $value['contend'] ?>
                          <?php
                          }
                          
                          ?>
                     </div>
                  <?php
                   }
                   
                   ?>
                         
                  <!-- /.comment-text -->
                      </div>
                <!-- /.card-comment -->
                  </div>
              <!-- /.card-footer -->
                     <div class="card-footer">
                         <form action="" method="post">
                              
                               <!-- .img-push is used to add margin to elements next to floating images -->
                             <div class="img-push">
                             <input type="text" class="form-control form-control-sm"  name="comment"placeholder="Press enter to post comment">
                             
                            </div>
                         </form>
                      </div>
              <!-- /.card-footer -->
                </div>
                 <!-- /.card -->
               </div>
               <!-- /.col -->
          </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left:0px !important">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
