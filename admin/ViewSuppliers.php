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

  <title>View Suppliers</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <style>

/*this for the loading bar */
.loading {
  position:fixed;
  top: 50%;
  left: 50%;
  height: 500px;

}
.loading-bar {
  display: inline-block;
  width: 4px;
  height: 18px;
  border-radius: 4px;
  animation: loading 1s ease-in-out infinite;
}
.loading-bar:nth-child(1) {
  background-color: #3498db;
  animation-delay: 0;
}
.loading-bar:nth-child(2) {
  background-color: #c0392b;
  animation-delay: 0.09s;
}
.loading-bar:nth-child(3) {
  background-color: #f1c40f;
  animation-delay: .18s;
}
.loading-bar:nth-child(4) {
  background-color: #27ae60;
  animation-delay: .27s;
}

@keyframes loading {
  0% {
    transform: scale(1);
  }
  20% {
    transform: scale(1, 2.2);
  }
  40% {
    transform: scale(1);
  }
}



</style>
</head>

<body id="page-top" onload="myFunction()">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="AdminDash.php">LBPower</a>

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
      <li class="nav-item active">
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
      <li class="nav-item">
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
            <a href="AdminDash.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">ViewSuppliers</li>
        </ol>

        <!-- DataTables Example -->
        <div class="loading" >
  <div class="loading-bar"></div>
  <div class="loading-bar"></div>
  <div class="loading-bar"></div>
  <div class="loading-bar"></div>
</div>
  <div class="container" id="main-content" style="display:none;">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Suppliers List</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
			<th>City</th>
		    <th>Street</th>
		    <th>Phone</th>
		    <th>Email</th>
		    <th>Company Name</th>
		    <th>Cost Per KW</th>
		    <th>User Capacity</th>
			<th></th>
        </tr>
		</thead>
		 <tfoot>
		<tr>
            <th>First Name</th>
            <th>Last Name</th>
			<th>City</th>
		    <th>Street</th>
		    <th>Phone</th>
		    <th>Email</th>
		    <th>Company Name</th>
		    <th>Cost Per KW</th>
		    <th>User Capacity</th>
			<th></th>
        </tr>
         </tfoot>
    <tbody>
	
    <?php
	//	Write and execute an SQL query
	$sql = "SELECT *
	        FROM person, supplier
			where person.PID=supplier.PID and role=1";
	$result = mysqli_query($connect,$sql);
	?>
	
    <?php 
		for($i=0;$i<mysqli_num_rows($result);$i++){
		$row = mysqli_fetch_assoc($result); 
		?>
		
        <tr>
            <td><?php echo $row['fname']; ?></td>
            <td><?php echo $row['lname']; ?></td>
			<td><?php echo $row['city']; ?></td>
			<td><?php echo $row['street']; ?></td>
			<td><?php echo $row['phone']; ?></td>
			<td><?php echo $row['email']; ?></td>
			<td><?php echo $row['comapany_name']; ?></td>
			<td><?php echo $row['cost_1kw']; ?></td>
			<td><?php echo $row['user_capacity']; ?></td>
			<?php $query="../admin/EditSupplier.php?PID=".$row['PID'];
			echo "<td width='50'> <a href=".$query.">Edit</a></td>"; 
			} mysqli_close($connect); ?>
        </tr>
    </tbody>
              </table>
            </div>
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
  <a class="scroll-to-top rounded" LBPOWER="#page-top">
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
  <script>
            var myVar;
            
            function myFunction() {
              myVar = setTimeout(showPage, 1000);
            }
            
            function showPage() {
              document.querySelector(".loading").style.display = "none";
              document.getElementById("main-content").style.display = "block";
            }

            </script>

</body>

</html>
