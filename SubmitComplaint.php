<!DOCTYPE html>
<?php
session_start();
include("DBConnect.php");
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
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

		<?php
			if($_SESSION['role']==1){
			echo '<a class="navbar-brand mr-1" href="supplier/SupplierDash.php">LBPower</a>';
			}
		
			else if($_SESSION['role']=0){
			echo '<a class="navbar-brand mr-1" href="client/ClientDash.php">LBPower</a>';
		}
		?>

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
          <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
		<?php
			if($_SESSION['role']==1){
			echo '<a class="nav-link" href="supplier/SupplierDash.php">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span>
				  </a>';
			}
		
			else if($_SESSION['role']==2){
			echo '<a class="nav-link" href="admin/AdminDash.php">
						<i class="fas fa-fw fa-tachometer-alt"></i>
						<span>Dashboard</span>
				  </a>';
		}
		?>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Supplier/ViewUsers.php">
          <i class="fas fa-fw fa-table"></i>
          <span>View Users</span></a>
      </li>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Supplier/newuser.html">
          <i class="fa fa-user-plus"></i>
          <span>Add User</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="SubmitComplaint.php">
          <i class="fa fa-thumbs-down"></i>
          <span>Submit Complaint</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fa fa-sign-out"></i>
          <span>Log Out</span></a>
      </li>
    </ul>

    <div id="content-wrapper" class="bg-dark">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="supplier/SupplierDash.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Submit Complaint</li>
        </ol>

<?php
if(isset($_POST['submit'])){
$role=$_SESSION['role'];
$type=$_POST["ctype"];
$text=$_POST["subject"];
$sql="INSERT INTO complaint(complaint_type,detials,sender_type,fk_sender) VALUES ('$type','$text','$role','".$_SESSION['PID']."')";
$result = mysqli_query($connect,$sql);
echo ' <h2 style="color:green;">Complaint is sent and will be reviewed by admins shortly</h2>';
header("refresh:1;url=Supplier/SupplierDash.php");
mysqli_close($connect);
}
 ?>

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Submit Complaint</div>
      <div class="card-body">
        <form method="POST">
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
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
