<!DOCTYPE html>
<?php
session_start();
 ?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<?php
include("DBConnect.php");
if(isset($_POST['submit'])){
	
	$sql ="SELECT role, email
	       FROM person, pass
	       WHERE email = '".$_POST['email']."' AND password ='".$_POST['pass']."' ";

	$result = mysqli_query($connect,$sql);

	$res=mysqli_num_rows($result);
	if($res==0){
	echo ' <h2 style="color:red;">email or password are incorrect</h2>';}
             
	else{
           
			echo ' <h2 style="color:green;">Logging in please Wait!</h2>';
			$row = mysqli_fetch_assoc($result);
			if($row['role']==1){
				 $sql ="SELECT email, role, fname, supplier.PID, comapany_name
						FROM person, supplier, pass
						WHERE email= '".$_POST['email']."'
						AND Supplier.PID=Person.PID";
						
				$result = mysqli_query($connect,$sql);
                $row=mysqli_fetch_assoc($result);
				
				$_SESSION['role'] = $row['role'];
				$_SESSION['Name'] = $row['fname'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['PID'] = $row['PID'];
				$_SESSION['cname']=$row['comapany_name'];
				header("refresh:1;url=../LBPower/supplier/SupplierDash.php");
				}
				
			else if($row['role']==2){
				 $sql ="SELECT email, role, fname, admin.PID
						FROM person, admin, pass
						WHERE email='".$_POST['email']."'
						AND admin.PID=Person.PID";
						
				$result = mysqli_query($connect,$sql);
				$row=mysqli_fetch_assoc($result);
				
				$_SESSION['role']= $row['role'];
				$_SESSION['Name'] = $row['fname'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['PID'] = $row['PID'];
				header("refresh:1;url=../LBPower/admin/AdminDash.php");
				}
			}
		 

	mysqli_close($connect);
}
?>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form  method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="email">Email address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="password" name="pass" class="form-control" placeholder="Password" required="required">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="submit">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="admin/register.php">Register an Account</a>
          <a class="d-block small" href="#">Forgot Password?</a>
        </div>
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
