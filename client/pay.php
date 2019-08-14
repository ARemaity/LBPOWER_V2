<?php


include("DBConnect.php");
// Create connection
//TODO: add late of islate=0 else no thing to do 
// Check connection
$get1kw;
$total;
$dudate;
$vat;
$consm;
$islate;
$id="";
$total="";
date_default_timezone_set("Asia/Beirut");
$dates = date('Y-m-d');
if(isset($_POST['submit'])){

  $insert= mysqli_query($connect,"UPDATE  payment Set `payment_st`= 1,`payment_date`= '". $dates . "' Where id='".$_GET['id']."'")or die(mysqli_error($conn));
  
if($insert){

  header("Location: thank.html");
  
}
}else
if (isset($_GET['id'])) {
$id=$_GET['id'];
$querypay = "SELECT  `id`,`fk_client`,`consumption` ,`costof1`,`Total`,`payment_st`, `issued_date`, `payment_date` FROM `payment` WHERE   id=" . $id;
$result = mysqli_query($connect, $querypay);
$row = mysqli_fetch_assoc($result);




//  if($dudate-date('Y-m-d')<0){

//   $islate=1;
//  } else{
//   $islate=0;
//TODO:calculate the late is true orfalse
//  }                   
//$data["consumption"] = $row["consumption"];
/// $data["costof1"] = $row["costof1"];
///$data["Total"] = $row["Total"];
/// $data["payment_st"] = $row["payment_st"];
/// $data["issued_date"] = $row["issued_date"];
$queryclient = "SELECT  `fname`, `lname`, `city`, `street`, `phone`, `email` FROM `person` INNER JOIN `client` on  client.PID = person.PID  WHERE id='" . $row['fk_client'] . "'";
$profile = mysqli_query($connect, $queryclient);
$clientrow = mysqli_fetch_assoc($profile);

$costQ = "SELECT `cost_1kw` FROM `supplier`,`client` where client.fkSupplier = supplier.id and client.id ='" . $row['fk_client'] . "'";
$costresult = mysqli_query($connect, $costQ);
$cost = mysqli_fetch_object($costresult);
$get1kw  = (int)$cost->cost_1kw;
$consm = $get1kw * $row['consumption'];

$total = $consm + ($consm * 11.0 / 100);


}




?>


<!DOCTYPE html>
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
      <div class='container'>
        <div class='row' style='padding-top:25px; padding-bottom:25px;'>
          <div class='col-md-12'>
            <div id='mainContentWrapper'>
              <div class="col-md-8 col-md-offset-2">
                <h2 style="text-align: center;">
                  Review Your Invoice<?php ?> & Complete Checkout
                </h2>
                <hr />
                <hr />
                <div class="shopping_cart">
                  <form class="form-horizontal" role="form" action="" method="post" id="payment-form">
                    <div class="panel-group" id="accordion">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Review
                              Your Order</a>
                          </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                          <div class="panel-body">
                            <div class="items">
                              <div class="col-md-9">

                              </div>
                              <div class="col-md-3">
                                <div style="text-align: center;">
                                  <h3>Invoice Total</h3>
                                  <h3><span style="color:green;"><?php echo $total; ?> lbp</span></h3>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <div style="text-align: center;"><a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class=" btn   btn-success" id="payInfo" style="width:100%;display: none;" onclick="$(this).fadeOut();  
                   document.getElementById('collapseThree').scrollIntoView()">Enter Payment Information »</a>
                          </div>
                        </h4>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <b>Payment Information</b>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                          <span class='payment-errors'></span>
                          <fieldset>
                            <legend>What method would you like to pay with today?</legend>
                            <form  method="post" id="pay_form">
                              <div class="form-group">
                             
                                <label class="col-sm-3 control-label" for="card-holder-name">Name on
                                  Card</label>
                                <div class="col-sm-9">
                                  <input required="required" name="cname"type="text" class="form-control" stripe-data="name" id="name-on-card" placeholder="Card Holder's Name">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label" for="card-number">Card
                                  Number</label>
                                <div class="col-sm-9">
                                  <input required="required" data-error="Valid number  is required." name="cnum" type="text" class="form-control" stripe-data="number" id="card-number" placeholder="Debit/Credit Card Number">
                                  <br />
                                  <div><img class="pull-right" src="https://s3.amazonaws.com/hiresnetwork/imgs/cc.png" style="max-width: 250px; padding-bottom: 20px;">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label" for="expiry-month">Expiration
                                    Date</label>
                                  <div class="col-xs-9">
                                    <div class="row">

                                      <div class="col-xs-6">
                                        <select name="month" class="form-control" required="required" data-error="Valid month  is required." data-stripe="exp-month" id="card-exp-month" style="margin-left:30px;">
                                          <option>Month</option>
                                          <option value="01">Jan (01)</option>
                                          <option value="02">Feb (02)</option>
                                          <option value="03">Mar (03)</option>
                                          <option value="04">Apr (04)</option>
                                          <option value="05">May (05)</option>
                                          <option value="06">June (06)</option>
                                          <option value="07">July (07)</option>
                                          <option value="08">Aug (08)</option>
                                          <option value="09">Sep (09)</option>
                                          <option value="10">Oct (10)</option>
                                          <option value="11">Nov (11)</option>
                                          <option value="12">Dec (12)</option>
                                        </select>
                                      </div>
                                      <div class="col-xs-3">
                                        <select name="year"class="form-control"   required="required" data-error="Valid Year is required." data-stripe="exp-year" id="card-exp-year" style="margin-left:40px;">

                                          <option value="2018">2018</option>
                                          <option value="2019">2019</option>
                                          <option value="2020">2020</option>
                                          <option value="2021">2021</option>
                                          <option value="2022">2022</option>
                                          <option value="2023">2023</option>
                                          <option value="2024">2024</option>
                                          <option value="2023">2025</option>
                                          <option value="2024">2026</option>
                                          <option value="2023">2027</option>
                                          <option value="2024">2028</option>
                                        </select>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-3 control-label" for="cvv">Card CVC</label>
                                  <div class="col-sm-3">
                                    <input type="text" name="cvc"class="form-control" stripe-data="cvc" id="card-cvc" placeholder="Security Code"
                                    required="required" data-error="Valid cvc is required.">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-sm-offset-3 col-sm-9">
                                  </div>
                                </div>
                          </fieldset>
                          <button name="submit" type="submit" class="btn btn-success btn-lg" style="width:100%;">Pay
                            Now
                          </button>
                          <br />
                          <div style="text-align: left;"><br />
                            By submiting this order you are agreeing to our universal
                            billing agreement, and terms of service.
                            If you have any questions about our products or services please contact us
                            before placing this order.
                          </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © LBPOWER 2019</span>
          </div>
        </div>
      </footer>
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
  <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
  <script src="../js/auth.js"></script>
  <script src="../js/graph.js"></script>
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