<?php 
require "config/config.php";
session_start();
if (!empty($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
}else {
  $pageno = 1;
}
$numOfrecs = 6;
$offset = ($pageno - 1)* $numOfrecs;

  
  
  $stmt = $pdo->prepare("SELECT * FROM post ORDER BY id DESC");
  $stmt -> execute();
  $rawResult = $stmt->fetchAll();
      
  $total_page = ceil(count($rawResult) / $numOfrecs);
  $stmt = $pdo->prepare("SELECT * FROM post ORDER BY id DESC LIMIT $offset , $numOfrecs");
  $stmt -> execute();
  $result = $stmt->fetchAll();

  

  

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
    <section class="content-header">
      <div class="container-fluid">
            <h1 style="text-align:center ">Widgets</h1>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="row">
     <?php 
       if ($result) {
         foreach ($result as  $value) {
         ?>
        
        <div class="col-md-4">
          <!-- Box Comment -->
          
          <div class="card card-widget">
            <div class="card-header">
             <div style="text-align:center; !important; float:none " class="card-title" >
              <h4><?php echo $value['title'] ;?></h4>
             </div>
              
            </div>
            <a href="blogdetail.php?id=<?php echo $value['id'] ?>" style="text-decoration:none;">
            <div class="card-body">
              <img class="img-fluid pad" src="admin/images/<?php echo $value['image']; ?>" style="height:200px !important" alt="Photo">
            </div>
          </div>
         </a>
          
        </div>
        
        
      

        <?php
         }
           }
           
           ?>
           </div>
    <br>
    <br>
      <nav aria-label="Page navigation example" style="float:right">
                       <ul class="pagination">
                          <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                          <li class="page-item <?php if($pageno <= 1){echo 'disabled';}?>">
                            <a class="page-link" href="<?php if($pageno <= 1){echo '#';}else { echo'?pageno='.($pageno-1);} ?>"> Previous </a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#"><?php echo $pageno; ?></a>
                          </li>
                          <li class="page-item <?php if($pageno >= $total_page){echo 'disabled';} ?>">
                            <a class="page-link" href="<?php if($pageno >= $total_page){echo '#';}else {echo'?pageno='.($pageno+1);} ?>">Next</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_page ?>">Last</a></li>
                        </ul>
                  </nav><br><br>
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
