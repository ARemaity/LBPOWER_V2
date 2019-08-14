<!DOCTYPE html>
<?php
session_start();
include("../DBConnect.php");
$result;
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>View Users</title>

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

<body id="page-top"  onload="myFunction()">

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
        <a class="nav-link" href="SupplierDash.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="ViewUsers.php">
          <i class="fas fa-fw fa-table"></i>
          <span>View Users</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../map/user-map.php">
        <i class="fa fa-map-marker" aria-hidden="true"></i>
          <span> &nbsp;&nbsp; Map</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="adduser.php">
          <i class="fa fa-user-plus"></i>
          <span>Add User</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="SubmitComplaint.php">
          <i class="fa fa-thumbs-down"></i>
          <span>Submit Complaint</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">
          <i class="fas fa-user-circle fa-fw"></i>
          <span>Profile</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">
          <i class="fa fa-sign-out"></i>
          <span>Log Out</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="SupplierDash.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">ViewUsers</li>
        </ol>
        <div class="loading" >
  <div class="loading-bar"></div>
  <div class="loading-bar"></div>
  <div class="loading-bar"></div>
  <div class="loading-bar"></div>
</div>
<div class="container" id="main-content" style="display:none;">
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            My Clients</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>PID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>City</th>
                    <th>Street</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Payments</th>
                    <th>Device</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>PID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>City</th>
                    <th>Street</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Payments</th>
                    <th>Device</th>
                  </tr>
                </tfoot>

                <tbody>
                  <?php
                  if ($_SESSION['role'] == 1) {
                    $sql = "SELECT  client.id, client.PID, fname, lname, city, street, phone, email
								FROM person, client
								WHERE person.PID=client.PID
								AND client.fksupplier= " . $_SESSION['id'] . "
								AND person.role=0";
                    $result = mysqli_query($connect, $sql);
                  } else if ($_SESSION['role'] == 2) {
                    $sql = "SELECT client.id, client.PID, fname, lname, city, street, phone, email
								FROM person, client
								WHERE person.PID=client.PID
								AND person.role=0";
                    $result = mysqli_query($connect, $sql);
                  }
                  //for($i=0;$i<mysqli_num_rows($result);$i++){
                  //$row = mysqli_fetch_assoc($result);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                  }
				  if(mysqli_num_rows ( $result )>0){
                  foreach ($rows as $key => $row) {
                    //Check if user does NOT have a device
                    $devicecheck =  'SELECT client.id,PID
						 FROM client
						 WHERE NOT EXISTS(select fk_client
										  from device
										  where fk_client="'.$row['id'].'")';

                    $result2 = mysqli_query($connect, $devicecheck);
                    $row2 = mysqli_fetch_assoc($result2);

                    ?>

                    <tr>
                      <td><?php echo $row['PID']; ?></td>
                      <td><?php echo $row['fname']; ?></td>
                      <td><?php echo $row['lname']; ?></td>
                      <td><?php echo $row['city']; ?></td>
                      <td><?php echo $row['street']; ?></td>
                      <td><?php echo $row['phone']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <?php
                      $query = "editUser.php?PID=" . $row['PID'];
                      echo "<td width='90'> <a href=" . $query . ">Edit User</a></td>";
                      $query3 = "ViewUserPayments.php?ID=" . $row['id'];
                      echo "<td width='90'> <a href=" . $query3 . ">Payments</a></td>";
                      if ($row['id'] = $row2['id']) {
                        $query2 = "AddDevice.php?ID=" . $id = $rows[$key]['id'];
                        //$_SESSION['cPID']=$rows[$key]['PID'];
                        //TODO: comment here for better undertstanding
                        $_SESSION['ID'] = $id;
                        echo "<td width='100'> <a href=" . $query2 . ">Add Device</a></td>";
                      } else {
                        echo '<td>Exists</td>';
                      }

                      ?>
                    </tr>
                  <?php } }
                ?>
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