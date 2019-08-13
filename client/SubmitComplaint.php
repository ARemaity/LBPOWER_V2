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

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
