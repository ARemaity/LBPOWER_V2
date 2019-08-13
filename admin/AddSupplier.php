<!DOCTYPE html>
<?php
include_once('../src/PHPMailer.php');
include_once('../src/SMTP.php');
include_once('../src/Exception.php');
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

  <title>Add Supplier</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top" >


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
      <li class="nav-item">
        <a class="nav-link" href="ViewSuppliers.php">
          <i class="fas fa-fw fa-table"></i>
          <span>View Suppliers</span></a>
      </li>
      <li class="nav-item active">
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

    <div id="content-wrapper"  class="bg-dark">
<!-- This is the main  wrapper -->
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="AdminDash.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Add Supplier</li>
        </ol>
<?php
	
if(isset($_GET['submit'])){	//	page submitted

    $getdata = mysqli_query($connect , "SELECT * FROM pass Where email='" . $_GET['email'] . "'");

    if (mysqli_num_rows($getdata) > 0) 
 {
  $message = "<script type='text/javascript'>alert('This email is in use by another account');</script>";
  echo $message;
 }
 else{
	
	if($_GET['password'] == $_GET['passwordr']){
		
    $user_password =$_GET['password'];
    $user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
	$sql3 = "INSERT INTO pass(SID, password, status, email)
			 VALUES(default, '".$user_encrypted_password."' ,1,'".$_GET["email"]."')";
	$result = mysqli_query($connect,$sql3);
			 
	$sql="INSERT INTO person(PID, role, fname, lname, city, street, phone, email)
		   VALUES(default, 1, '".$_GET["fname"]."', '".$_GET["lname"]."', '".$_GET["city"]."', '".$_GET["street"]."', '".$_GET["phone"]."', '".$_GET["email"]."')";
	$result = mysqli_query($connect,$sql);
	
	$checkLastid = mysqli_query($connect, "SELECT PID FROM person ORDER BY PID DESC LIMIT 1 ");
    $value = mysqli_fetch_object($checkLastid);
	$last = (int)$value->PID;
	
	$getsid = mysqli_query($connect,"SELECT SID FROM pass WHERE email = '".$_GET["email"]."'");
	$sid = mysqli_fetch_object($getsid);
	$sidval = $sid->SID;
	
	$sql2 =" INSERT INTO supplier(id, PID, SID, comapany_name, cost_1kw, user_capacity)
		    VALUES (default, '".$last."' ,'".$sidval."' ,'".$_GET["cname"]."', '".$_GET["cpkw"]."', '".$_GET["ucap"]."') ";
	$result2 = mysqli_query($connect,$sql2);
	}
	else{
		echo "<script type='text/javascript'>alert('Passwords MUST match');</script>";
			  mysqli_close($connect);
			  header("refresh:1;url=addsupplier.php");
	}
		//If the sql returns an error
	if(!$result || !$result2){
			die("Something went wrong");
	}
	else{
      echo "<script type='text/javascript'>alert('Supplier Added Successfully');</script>";
      /////////////////
      $mail_body = "
      <p> Hi ".$_GET['fname']."</p>
      <p>The Admin has added you . Your password is ".$_GET['password']."<p>Best Regards,<br />LBPOWER</p>
   
   
      <div id='signature-to-copy'><table cellpadding='0' cellspacing='0' border='0' style='background: none; border-width: 0px; border: 0px; margin: 0; padding: 0;'>
      <tbody><tr><td colspan='2' style='padding-bottom: 5px; color: #F7751F; font-size: 18px; font-family: Arial, Helvetica, sans-serif;'>LBPOWER Info</td></tr>
      <tr><td colspan='2' style='color: #333333; font-size: 14px; font-family: Arial, Helvetica, sans-serif;'><strong>lbpower .ltd</strong></td></tr>
      <tr><td width='20' valign='top' style='vertical-align: top; width: 20px; color: #F7751F; font-size: 14px; font-family: Arial, Helvetica, sans-serif;'>p:</td><td valign='top' style='vertical-align: top; color: #333333; font-size: 14px; font-family: Arial, Helvetica, sans-serif;'>+961434234&nbsp;&nbsp;<span style='color: #F7751F;'>m:&nbsp;</span>7002345</td></tr>
      <tr><td width='20' valign='top' style='vertical-align: top; width: 20px; color: #F7751F; font-size: 14px; font-family: Arial, Helvetica, sans-serif;'>a:</td><td valign='top' style='vertical-align: top; color: #333333; font-size: 14px; font-family: Arial, Helvetica, sans-serif;'>Tyre,LIU</td></tr>
      <tr><td width='20' valign='top' style='vertical-align: top; width: 20px; color: #F7751F; font-size: 14px; font-family: Arial, Helvetica, sans-serif;'>w:</td><td valign='top' style='vertical-align: top; color: #333333; font-size: 14px; font-family: Arial, Helvetica, sans-serif;'><a href='http://lbpower.com' style=' color: #1da1db; text-decoration: none; font-weight: normal; font-size: 14px;'>lbpower.com</a>&nbsp;&nbsp;<span style='color: #F7751F;'>e:&nbsp;</span><a href='mailto:lbpowerinfo@gmail.com' style='color: #1da1db; text-decoration: none; font-weight: normal; font-size: 14px;'>lbpowerinfo@gmail.com</a></td></tr>
      </tbody></table>
      </div>
        
   
      
      ";
       $mail = new PHPMailer\PHPMailer\PHPMailer();
       $mail->IsSMTP(); // enable SMTP
      //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
       //authentication SMTP enabled
       $mail->SMTPAuth = true; 
       $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
       $mail->Host = "smtp.gmail.com";
       //indico el puerto que usa Gmail 465 or 587
       $mail->Port = 465; 
       
       $mail->Username = "lbpowerinfo@gmail.com";
       $mail->Password = "kHthw4zd123";
       $mail->SetFrom("lbpowerinfo@gmail.com","LBPOWER Verfiy");  //Sets the From email address for the message
          //Sets the From name of the message
       $mail->AddAddress($_GET["email"]);
      //Adds a "To" address   
       $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
       $mail->IsHTML(true);       //Sets message type to HTML    
       $mail->Subject = 'LBPOWER Registration';   //Sets the Subject of the message
       $mail->Body = $mail_body; 
       if(!$mail->Send()) {
           echo "Mailer Error: " . $mail->ErrorInfo; $debug['API.email'] = 0;
        } else {
           echo "Message has been sent";  $debug['API.email'] = 1;
        }


//////////////
			header("refresh:1;url=ViewSuppliers.php");
			mysqli_close($connect);

	}
}
}
?>

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Add Supplier</div>
      <div class="card-body">
        <form style="background-color gray" method="GET">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="firstName" name='fname' class="form-control" placeholder="First Name" required="required" autofocus="autofocus">
                  <label for="firstName">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lastName" name="lname" class="form-control" placeholder="Last Name" required="required">
                  <label for="lastName">Last name</label>
                </div>
              </div>
            </div>
          </div>
		  
		   <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="City"  name="city" class="form-control" placeholder="City" required="required" autofocus="autofocus">
                  <label for="City">City</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="Street" name="street" class="form-control" placeholder="Street" required="required">
                  <label for="Street">Street</label>
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="tel" id="Phone"  name="phone" class="form-control" placeholder="Phone" required="required" autofocus="autofocus">
                  <label for="Phone">Phone</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="CompanyName" name="cname" class="form-control" placeholder="Company Name" required="required">
                  <label for="CompanyName">Company Name</label>
                </div>
              </div>
            </div>
          </div>
		  
		  <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="number" id="CostPerKW"  name="cpkw" class="form-control" placeholder="Cost Per KW" required="required" autofocus="autofocus">
                  <label for="CostPerKW">Cost Per KW</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="number" id="UserCap" name="ucap" class="form-control" placeholder="User Capacity" required="required">
                  <label for="UserCap">User Capacity</label>
                </div>
              </div>
            </div>
          </div>		  
		  
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="required">
              <label for="inputEmail">Email address</label>
            </div>
          </div>
		  
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="confirmPassword" name="passwordr" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="submit">Add</button>
        </form>
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
var myInput = document.getElementById("inputPassword");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");


// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) { 
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) { 
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) { 
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
  
}
</script>

<!-- <script>
            var myVar;
            
            function myFunction() {
              myVar = setTimeout(showPage, 2000);
            }
            
            function showPage() {
              document.querySelector(".loading").style.display = "none";
              document.getElementById("main-content").style.display = "block";
            }

            </script> -->
</body>

</html>
