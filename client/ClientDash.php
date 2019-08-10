<!DOCTYPE html>
<?php
include("DBConnect.php");
$kw;
$get1kw  ;
$total;
$unpaid;
$id;
session_start();
///TODO: this is FOR THE SECUIRTY
if(!isset($_SERVER['HTTP_REFERER']))
{        
  header('Location:http://localhost/final/LBPOWER/');

}else if(isset($_GET['id'])){
  
  $id=''.$_GET['id'].'';
  $_SESSION['id']=$id;

   //////////////////////////////////////TODO: THIS QUERIES FOR 4 icon image make sure to check costraints 
  
//////////////////////////////////////////////////////////////////////

     }else if(isset($_SESSION['id'])){
  

}else{

////in case the user return to the main dashboard get id is null so must check if there a session(id) value
header('Location:http://localhost/final/LBPOWER/');


}

// $getdata = mysqli_query($connect, "SELECT value FROM  cumulative Where fk_id='" . $_SESSION['id'] . "'") or die(mysqli_error($conn));
//   if (mysqli_num_rows($getdata) == 0) {
//     $kw =  0;
//   } else {
//     $cum = mysqli_fetch_object($getdata);
//     $getCumumlative  = (int)$cum->value;
//     $kw =  $getCumumlative;
// }

// $costQ = "SELECT `cost_1kw` FROM `supplier`,`client` where client.fkSupplier = supplier.id and client.id ='" .  $_SESSION['id']. "'"  or die(mysqli_error($conn));
   
//     $result = mysqli_query($connect, $costQ);
//     if (mysqli_num_rows($result) == 0) {
    
//       $get1kw=0;
//       $total=0;
//     } else {
//       $cost = mysqli_fetch_object($result);
//       $get1kw  = (int)$cost->cost_1kw;
//       $total = $get1kw * $getCumumlative;
      
//     }

//     $query = "SELECT * FROM `payment` WHERE      payment_st=0 AND fk_client='". $_SESSION['id']."'";

//     $unpaidQ= mysqli_query($connect,$query);


//     if( mysqli_num_rows($unpaidQ)==0){

//       $unpaid=0;

//     }else{
//    $unpaid= mysqli_num_rows($unpaidQ);

//     }


	$sql="select * from client where '".$_SESSION['id']."' = id";
	$result = mysqli_query($connect,$sql);
	$row = mysqli_fetch_assoc($result);
	$_SESSION['PID']=$row['PID'];
	$_SESSION['fk_supplier'] = $row['fkSupplier'];
	mysqli_close($connect);
?>



<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script>
    $(document).ready(function(){
        setInterval(function(){
            $("#kw").load('kw.php')
        }, 2000);
    });
    $(document).ready(function(){
        setInterval(function(){
            $("#cost").load('cost.php')
        }, 2000);
    });
    $(document).ready(function(){
        setInterval(function(){
            $("#bill").load('bill.php')
        }, 2000);
    });
    $(document).ready(function(){
        setInterval(function(){
            $("#unpaid").load('unpaid.php')
        }, 2000);
    });
    </script>



<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-app.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<!-- Add additional services that you want to use -->
	<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-database.js"></script>

	<!-- Include Plotly.js -->
	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
	<!-- Include the moment.js library -->
	<script src="https://momentjs.com/downloads/moment.js"></script>
  <title>Client Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <style>
#alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}
</style>
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="ClientDash.php">LBPOWER</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
         
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" onclick="logout();" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>


  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="ClientDash.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">
        <i class="fas fa-user"></i>
          <span>Profile</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="SubmitComplaint.php">
          <i class="fa fa-thumbs-down"></i>
          <span>Submit Complaint</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ViewUserPayments.php">
        <i class="fas fa-money-bill-wave"></i>
          <span>View Payments</span></a>
      </li>
    </ul>

    <div class="container-fluid">

<!-- Breadcrumbs-->
<ol class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="#">Dashboard</a>
  </li>
  <li class="breadcrumb-item active">Overview</li>
</ol>

<!-- Icon Cards-->
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
        <i class="fas fa-plug"></i>
        </div>
        <div id="kw" class="mr-5"> kw/h </div>
        <?php //echo $kw;?>
      </div>
      <!-- <a class="card-footer text-white clearfix small z-1" href="#">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a> -->
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
        <i class="fas fa-money-bill-wave"></i>
        </div>
        <div id="cost"class="mr-5"></div>
      </div>
      <!-- <a class="card-footer text-white clearfix small z-1" href="#">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a> -->
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
        <i class="fas fa-file-invoice-dollar"></i>
        </div>
        <div id="bill" class="mr-5"></div>
      </div>
      <!-- <a class="card-footer text-white clearfix small z-1" href="#">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a> -->
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
        <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div id="unpaid"class="mr-5"></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="#">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
</div>

<!-- Area Chart Example-->
<div class="card mb-3">
  <div class="card-header">
    <i class="fas fa-chart-area"></i>
    Area Chart Example</div>
  <div class="card-body">
  <div id="myPlot" style="width: 100%; max-height:75vh"></div>
  <div id="alert">
  there is problem try again later 
</div>
  </div>
  <div class="card-footer small text-muted">Live update</div>
</div>

</div>
<!-- /.container-fluid -->

<!-- Sticky Footer -->
<footer class="sticky-footer">
<div class="container my-auto">
  <div class="copyright text-center my-auto">
    <span>Copyright © LBBPOWER 2019</span>
  </div>
</div>
</footer>

</div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" onclick="logout()" >Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->  





   <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
  <script src="../js/auth.js"></script>
	<script src="../js/graph.js"></script>
  <script src="../js/sb-admin.min.js"></script>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->


  <!-- Demo scripts for this page-->

</body>

</html>
