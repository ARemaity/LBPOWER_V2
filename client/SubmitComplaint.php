<!DOCTYPE html>
<?php
session_start();
include("DBConnect.php");
$message='';
if(!isset($_SERVER['HTTP_REFERER']))
{        
  header('Location:http://localhost/final/LBPOWER/');

}else if(isset($_SESSION['id'])){
  

}else{

////in case the user return to the main dashboard get id is null so must check if there a session(id) value
header('Location:http://localhost/final/LBPOWER/');


}
if(isset($_POST['submit'])){
$type=$_POST["ctype"];
$text=$_POST["subject"];

$insert = mysqli_query($connect, "INSERT INTO complaint(complaint_type,detials,sender_type,fk_sender)  VALUES ('" . $type . "','" . $text . "','1','" .  $_SESSION['id'] . "')") ;
if($insert){


  $message = '<label class="text-success">Success ,message will be resolved as soon as possible</label>';

}else{

  $message = '<label class="text-danger">there is problem try again later </label>';

}

}

?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Submit Complaint</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  <a class="navbar-brand mr-1" href="ClientDash.php">LBPOWER</a>
    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>


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
  <li class="nav-item   ">
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
  <li class="nav-item active">
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

<div id="content-wrapper">

  
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Submit Complaint</div>
      <div class="card-body" style="width:100%;">
        <form method="POST">
        <?php echo $message; ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
					<select name="ctype" id="ctype" style="width:600px" required="required">
					<option>Please choose you're complaint type.. If "Other" please specify</option>
					<option value="Software">Software</option>
					<option value="hardware">Hardware</option>
					<option value="Other">Other</option>
					</select>
                </div>
              </div>
            </div>
          </div>
		  
		   <div class="form-group">
		   	<div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
				  <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px; width:600px" required="required"></textarea>
                </div>
              </div>
			 </div>
		   </div>
          <button class="btn btn-primary btn-block" type="submit" name="submit">Submit</button>
        </form>
      </div>
    </div>

 
  <!-- /.container-fluid -->

  <!-- Sticky Footer -->
  <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright © LBPOWER 2019</span>
      </div>
    </div>
  </footer>

</div>
<!-- /.content-wrapper -->

</div>
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
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
  <script src="../js/auth.js"></script>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>
