<!DOCTYPE html>
<?php
session_start();
include("DBConnect.php");

if (!isset($_SERVER['HTTP_REFERER'])) {
  header('Location:http://localhost/final/LBPOWER/');
} else if (isset($_SESSION['id'])) { } else {

  ////in case the user return to the main dashboard get id is null so must check if there a session(id) value
  header('Location:http://localhost/final/LBPOWER/');
}
$id = $_SESSION['id'];

$query = "SELECT  `fname`, `lname`, `city`, `street`, `phone` FROM `person` INNER JOIN `client` on  client.PID = person.PID  WHERE id='" . $id . "'";

$result = mysqli_query($connect, $query);
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data = array();
  $data["fname"] = $row["fname"];
  $data["lname"] = $row["lname"];
  $data["city"] = $row["city"];
  $data["street"] = $row["street"];
  $data["phone"] = $row["phone"];
}

$costQ = "SELECT `cost_1kw` FROM `supplier`,`client` where client.fkSupplier = supplier.id and client.id ='" . $id . "'"  or die(mysqli_error($conn));
$results = mysqli_query($connect, $costQ);
$cost = mysqli_fetch_object($results);
$get1kw  = (int)$cost->cost_1kw;
$phone = "SELECT `fname`,`lname`,`phone` FROM `supplier`,`client`,`person` where client.fkSupplier = supplier.id and supplier.PID=person.PID and client.id ='" . $id . "'"  or die(mysqli_error($conn));
$result = mysqli_query($connect, $phone);
$data2 = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data2 = array();
  $data2["fname"] = $row["fname"];
  $data2["lname"] = $row["lname"];
  $data2["phone"] = $row["phone"];
}

?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
    body {
      background: -webkit-linear-gradient(left, #3931af, #00c6ff);
    }

    .emp-profile {
      padding: 3%;
      margin-top: 3%;
      margin-bottom: 3%;
      border-radius: 0.5rem;
      background: #fff;
    }

    .profile-img {
      text-align: center;
    }

    .profile-img img {
      width: 70%;
      height: 100%;
    }

    .profile-img .file {
      position: relative;
      overflow: hidden;
      margin-top: -20%;
      width: 70%;
      border: none;
      border-radius: 0;
      font-size: 15px;
      background: #212529b8;
    }

    .profile-img .file input {
      position: absolute;
      opacity: 0;
      right: 0;
      top: 0;
    }

    .profile-head h5 {
      color: #333;
    }

    .profile-head h6 {
      color: #0062cc;
    }

    .profile-edit-btn {
      border: none;
      border-radius: 1.5rem;
      width: 70%;
      padding: 2%;
      font-weight: 600;
      color: #6c757d;
      cursor: pointer;
    }

    .proile-rating {
      font-size: 12px;
      color: #818182;
      margin-top: 5%;
    }

    .proile-rating span {
      color: #495057;
      font-size: 15px;
      font-weight: 600;
    }

    .profile-head .nav-tabs {
      margin-bottom: 5%;
    }

    .profile-head .nav-tabs .nav-link {
      font-weight: 600;
      border: none;
    }

    .profile-head .nav-tabs .nav-link.active {
      border: none;
      border-bottom: 2px solid #0062cc;
    }

    .profile-work {
      padding: 14%;
      margin-top: -15%;
    }

    .profile-work p {
      font-size: 12px;
      color: #818182;
      font-weight: 600;
      margin-top: 10%;
    }

    .profile-work a {
      text-decoration: none;
      color: #495057;
      font-weight: 600;
      font-size: 14px;
    }

    .profile-work ul {
      list-style: none;
    }

    .profile-tab label {
      font-weight: 600;
    }

    .profile-tab p {
      font-weight: 600;
      color: #0062cc;
    }
  </style>
  <title>View Payments</title>

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
      <li class="nav-item active">
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

    <div id="content-wrapper">
      <div class="container emp-profile">
        <div class="row">
          <div class="col-md-2">
            <input type="submit" class="profile-edit-btn" name="btnAddMore" data-toggle="modal" data-target="#editModal" value="Edit Email" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="profile-img">
              <img src="http://s3.amazonaws.com/37assets/svn/765-default-avatar.png" alt="" />
            </div>
          </div>
          <!-- <div class="col-md-6">
                        
                    </div> -->

          <!--             
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>WORK LINK</p>
                            <a href="">Website Link</a><br/>
                            <a href="">Bootsnipp Profile</a><br/>
                            <a href="">Bootply Profile</a>
                            <p>SKILLS</p>
                            <a href="">Web Designer</a><br/>
                            <a href="">Web Developer</a><br/>
                            <a href="">WordPress</a><br/>
                            <a href="">WooCommerce</a><br/>
                            <a href="">PHP, .Net</a><br/>
                        </div>
                    </div> -->
          <div class="col-md-8">
            <div class="profile-head">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">My profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Account Details</a>
                </li>
              </ul>
            </div>
            <div class="tab-content profile-tab" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class="row">
                  <div class="col-md-6">
                    <label>Name</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo  $data["fname"] . " " . $data["lname"]; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>City</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo  $data["city"]; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Street</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo  $data["street"]; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>phone</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo  $data["phone"]; ?></p>
                  </div>
                </div>
                <!-- <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>

                                                //TODO: LATER ON CZ must get it from    firebase.auth.currentUser.email (pass variable from js to php )
                                            </div>
                                            <div class="col-md-6">
                                                <p>Kshiti123</p>
                                            </div>
                                        </div> -->
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                  <div class="col-md-6">
                    <label>Supplier name</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo  $data2["fname"] . " " . $data2["lname"]; ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Supplier Phone</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo  $data2["phone"] ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label>Cost of 1 kw/h</label>
                  </div>
                  <div class="col-md-6">
                    <p><?php echo $get1kw ?></p>
                  </div>
                </div>

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
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
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
        <div class="modal-body">
          <div class="container">
            <div class="card">
              <div class="card-header">
                Invoice
                <strong>01/01/01/2018</strong>
                <span class="float-right"> <strong>Status:</strong> Pending</span>

              </div>
              <div class="card-body">
                <div class="row mb-4">
                  <div class="col-sm-6">
                    <h6 class="mb-3">From:</h6>
                    <div>
                      <strong>Webz Poland</strong>
                    </div>
                    <div>Madalinskiego 8</div>
                    <div>71-101 Szczecin, Poland</div>
                    <div>Email: info@webz.com.pl</div>
                    <div>Phone: +48 444 666 3333</div>
                  </div>

                  <div class="col-sm-6">
                    <h6 class="mb-3">To:</h6>
                    <div>
                      <strong>Bob Mart</strong>
                    </div>
                    <div>Attn: Daniel Marek</div>
                    <div>43-190 Mikolow, Poland</div>
                    <div>Email: marek@daniel.com</div>
                    <div>Phone: +48 123 456 789</div>
                  </div>



                </div>

                <div class="table-responsive-sm">
                  <table class="table table-striped">
                    <thead>
                      <tr>

                        <th>name</th>


                        <th class="right">Unit Cost</th>
                        <th class="center">Qty</th>
                        <th class="right">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>

                        <td class="left strong">Origin License</td>


                        <td class="right">$999,00</td>
                        <td class="center">1</td>
                        <td class="right">$999,00</td>
                      </tr>

                    </tbody>
                  </table>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-sm-5">

                  </div>

                  <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                      <tbody>
                        <tr>
                          <td class="left">
                            <strong>Subtotal</strong>
                          </td>
                          <td class="right">$8.497,00</td>
                        </tr>
                        <tr>
                          <td class="left">
                            <strong>Discount (20%)</strong>
                          </td>
                          <td class="right">$1,699,40</td>
                        </tr>
                        <tr>
                          <td class="left">
                            <strong>VAT (10%)</strong>
                          </td>
                          <td class="right">$679,76</td>
                        </tr>
                        <tr>
                          <td class="left">
                            <strong>Total</strong>
                          </td>
                          <td class="right">
                            <strong>$7.477,36</strong>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                  </div>

                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- update email modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <label> Email</label>
              <input id="email" type="email" name="email" class="form-control" placeholder="Enter your email *" required="required" data-error="Valid email is required.">
              <!-- <div class="help-block with-errors"></div> -->

            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" onclick="update()">Update</a>
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