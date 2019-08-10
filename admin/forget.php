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
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<?php
include_once('../src/PHPMailer.php');
include_once('../src/SMTP.php');
include_once('../src/Exception.php');
$message = '';
include("../DBConnect.php");
if(isset($_POST['submit'])){




    $query = "SELECT  `email` FROM `pass`   WHERE status=1 AND email='". $_POST['email']."'";

    $statement = mysqli_query($connect,$query);

    if(mysqli_num_rows($statement) == 0){
    
        $message = "<script type='text/javascript'>alert('Sorry email not registered yet');</script>";
		echo $message;	
    }
        else{


////////////////////////////




$user_password = rand(100000,999999);
$user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
$user_activation_code = md5(rand());
$insert= mysqli_query($connect,"UPDATE pass Set `password`= '".$user_encrypted_password."' Where email='".$_POST['email']."'");

if($insert)
{

    $mail_body = "
    <p> Your password is ".$user_password."</p>
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
     $mail->SetFrom("lbpowerinfo@gmail.com","LBPOWER Password");  //Sets the From email address for the message
        //Sets the From name of the message
     $mail->AddAddress($_POST['email']);
    //Adds a "To" address   
     $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
     $mail->IsHTML(true);       //Sets message type to HTML    
     $mail->Subject = 'LBPOWER Forget password';   //Sets the Subject of the message
     $mail->Body = $mail_body; 
     if(!$mail->Send()) {
         echo "Mailer Error: " . $mail->ErrorInfo; $debug['API.email'] = 0;
      } else {
         echo "Message has been sent";  $debug['API.email'] = 1;
         header('Location: ../login.php');
      }


  }else{
echo "<script>console.log('there is error');</script>";
      $message = '<label class="text-danger">there is error check later</label>';
      
  }
 

  ///////////////////////




 ///////////////////////////
 


///////////////////////////////////



         


        }

















}
// if(isset($_SESSION['cname']) || isset($_SESSION['admin']))
// {
// 	if($_SESSION['role']==1){
//     $message = "<script type='text/javascript'>alert('Already Logged In');</script>";
// 	echo $message;
// 	header("refresh:1;url=supplier/supplierdash.php");}
// 	else if($_SESSION['role']==2){
//     $message = "<script type='text/javascript'>alert('Already Logged In');</script>";
// 	echo $message;
// 	header("refresh:1;url=admin/admindash.php");}
// }

// $message = '';
// include("DBConnect.php");

// if(isset($_POST['submit'])){
// 	 $sql ="select role, person.email, status, password
// 			from person, pass
// 			where person.email='".$_POST['email']."'
// 			and person.email=pass.email";
// 	$statement = mysqli_query($connect,$sql);
// 	$row=mysqli_fetch_assoc($statement);
// 	$_SESSION['role']= $row['role'];
// 	$count = mysqli_num_rows($statement);
// 	if($count > 0)
// 	{
// 			if($row['status'] == 1)
// 			{
// 				if(password_verify($_POST["pass"], $row["password"]))
// 				//if($row["user_password"] == $_POST["user_password"])
// 				{
// 						if($_SESSION['role']==1){

// 							$getid =mysqli_query($connect,"select supplier.id as ids from supplier,person where supplier.PID=person.PID AND person.email= '".$_POST['email']."'");
// 							$getobject=mysqli_fetch_object($getid);
// 							$id=(int)$getobject->ids;
// 							$_SESSION['id']=$id;
// 						$sql2 ="SELECT person.email, role, fname, supplier.PID, comapany_name
// 						FROM person, supplier, pass
// 						WHERE person.email= '".$_POST['email']."'
// 						AND person.email=pass.email
// 						AND Supplier.PID=Person.PID
// 						AND supplier.SID=pass.SID";
// 						$result = mysqli_query($connect,$sql2);
// 						$row2=mysqli_fetch_assoc($result);
// 						$_SESSION['PID'] = $row2['PID'];
// 						$_SESSION['name'] = $row2['fname'];
// 						$_SESSION['email'] = $row2['email'];
// 						$_SESSION['cname']=$row2['comapany_name'];
// 						header("refresh:1;url=supplier/supplierdash.php");
// 						}
								
// 						else if($_SESSION['role']==2){
// 						$sql2 ="SELECT person.email, role, fname, admin.PID
// 						FROM person, admin, pass
// 						WHERE person.email='".$_POST['email']."'
// 						AND person.email=pass.email
// 						AND admin.PID=Person.PID
// 						AND admin.SID=pass.SID";
// 						$result = mysqli_query($connect,$sql2);
// 						$row2=mysqli_fetch_assoc($result);
// 						$_SESSION['admin']=$row2['PID'];
// 						$_SESSION['PID'] = $row2['PID'];
// 						$_SESSION['name'] = $row2['fname'];
// 						$_SESSION['email'] = $row2['email'];
// 						header("refresh:1;url=admin/admindash.php");
// 						}
// 				}
// 				else
// 				{
// 					$message = "<script type='text/javascript'>alert('Incorrect Password, Please try again');</script>";
// 					echo $message;
// 				}
// 			}
// 			else
// 			{
// 				$message = "<script type='text/javascript'>alert('Please Verify You're email before logging in');</script>";
// 				echo $message;
// 			}
// 	}
// 	else
// 	{
// 		$message = "<script type='text/javascript'>alert('Email address doesnt exist, please try again');</script>";
// 		echo $message;
// 	}	 
	
// 	mysqli_close($connect);
// }
?>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Forget Password</div>
      <div class="card-body">
        <form  method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" name="email" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
              <label for="email">Email address</label>
            </div>
          </div>
      
          <button class="btn btn-primary btn-block" type="submit" name="submit">submit</button>
        </form>
        
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
