<!DOCTYPE html>
<?php
session_start();
include("DBConnect.php");

$output = '';

$id = $_SESSION['id'];
/*if(!isset($_SERVER['HTTP_REFERER']))
{        
  header('Location:http://localhost/final/LBPOWER/');

}else if(isset($_SESSION['id'])){
  

}else{

////in case the user return to the main dashboard get id is null so must check if there a session(id) value
header('Location:http://localhost/final/LBPOWER/');


}*/
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>View Payments</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>

<body id="page-top">

  <div id="df">
    
  </div>
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
      <li class="nav-item active">
        <a class="nav-link" href="ViewUserPayments.php">
          <i class="fas fa-money-bill-wave"></i>
          <span>View Payments</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="AdminDash.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">ViewPayments</li>
        </ol>

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
                    <th>Ammount</th>
                    <th>Issued Date</th>
                    <th>due date </th>
                    <th>Payment State</th>
                    <th>Date Paid</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Amount</th>
                    <th>Issued Date</th>
                    <th>Due Date</th>
                    <th>Payment State</th>
                    <th>Date Paid</th>
                  </tr>
                </tfoot>

                <tbody>
                  <?php
                  // $id = $_SESSION['id'];


                  // echo 'the id is '.$id;
                  $sql = "SELECT *
      FROM payment
      WHERE fk_client='" . $id . "' ";

                  $result = mysqli_query($connect, $sql);

                  while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                      <td><?php echo $row['Total']; ?></td>
                      <td><?php echo $row['issued_date']; ?></td>
                      <td><?php $dueString = $row['issued_date'];

                          echo date('Y-m-d', strtotime($dueString . ' + 3 days'));
                          ?></td>
                      <?php
                      if ($row['payment_st'] == 0) {
                        echo '<td>Unpaid</td>';
                        echo '<td>No Date</td>';
                      } else {
                        echo '<td>Paid</td> ';
                        echo '<td>' . $row["payment_date"] . '</td>';
                      }
                      echo "<td><button  type='button' class='btn btn-dark' id='pays'   data-toggle='modal' data-target='#paymodal' onclick='pay(this.value)'   value='" . $row['id'] . "'>View</button></td></tr>";
                    }
                    ?>




                  </tr>

                </tbody>
              </table>
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

  <!-- /#wrapper -->

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