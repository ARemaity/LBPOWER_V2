<!DOCTYPE html>
<?php
session_start();
///TODO: this is FOR THE SECUIRTY
if(!isset($_SERVER['HTTP_REFERER']))
{        
  header('Location:http://localhost/final/LBPOWER/login.php');

}else if(isset($_SESSION['admin'])){
  
  $id=''.$_SESSION['admin'].'';
}else{

////in case the user return to the main dashboard get id is null so must check if there a session(id) value
header('Location:http://localhost/final/LBPOWER/login.php');
}
include("../DBConnect.php");
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edit Profile</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="SupplierDash.php">LBPower</a>

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
          <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="AdminDash.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ViewUsers.php">
          <i class="fas fa-fw fa-table"></i>
          <span>View Users</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ViewSuppliers.php">
          <i class="fas fa-fw fa-table"></i>
          <span>View Suppliers</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="AddSupplier.php">
          <i class="fa fa-user-plus"></i>
          <span>Add Supplier</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ViewComplaints.php">
          <i class="fa fa-thumbs-down"></i>
          <span>View Complaints</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="profile.php">
          <i class="fas fa-user-circle fa-fw"></i>
          <span>View Profile</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="SupplierDash.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Edit Profile</li>
        </ol>

<?php
	
if(isset($_POST['submit'])){	//	page submitted

$sql="select password from pass where email = '".$_SESSION['email']."' ";
$result = mysqli_query($connect,$sql);
$row= mysqli_fetch_assoc($result);

if(password_verify($_POST["OldPass"], $row["password"])){
	if($_POST["password"] == $_POST["repassword"]){
		
    $user_password =$_POST['password'];
    $user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
	
	$sql2="update pass
		   set password = '".$user_encrypted_password."'
		   where email = '".$_SESSION['email']."' ";
	$result2 = mysqli_query($connect,$sql2);
	//	If the sql returns an error
	if(!$result || !$result2)
			die("Something went wrong");
	else
			echo "<script type='text/javascript'>alert('Password Updated, please login');</script>";
			header("refresh:1;url=../logout.php");
}
	else{
			echo "<script type='text/javascript'>alert('Passwords MUST match, please try again');</script>";
			header("refresh:1;url=changepass.php");
	}
}
	else{
			echo "<script type='text/javascript'>alert('Password is incorrect, Please try again');</script>";
			header("refresh:1;url=changepass.php");
	}
}
?>

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Change Password</div>
      <div class="card-body">
        <form style="background-color gray" method="POST">
		
          <div class="form-group">
            <div class="form-row">  
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="password" id="OldPass" name='OldPass' class="form-control" placeholder="OldPass" required="required" autofocus="autofocus">
                  <label for="OldPass">Old Password</label>
                </div>
              </div>
            </div>
          </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                        required="required">
                      <label for="password">New Password</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-label-group">
                      <input type="password" id="repassword" name="repassword" class="form-control"
                        placeholder="Confirm password" required="required">
                      <label for="repassword">Confirm password</label>
                    </div>
                  </div>
                </div>
              </div>

          <button class="btn btn-primary btn-block" type="submit" name="submit">Edit</button>
        <div class="text-center">
          <a class="d-block small mt-3" href="profile.php">Cancel</a>
        </div>
        </form>
      </div>
    </div>
  </div>
  <?php 
//	close the connection
	mysqli_close($connect);
?>

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
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
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
