<?php 

///TODO: this is FOR THE SECUIRTY

session_start();
include_once('../src/PHPMailer.php');
include_once('../src/SMTP.php');
include_once('../src/Exception.php');
$servername = "localhost";
$username = "root";
$password ="";
$dbname="id8992783_isd";
$status=0;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}






//if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
 
$PID=$_POST["uid"];
  
 $fname=  $_POST["fname"];

  $lname= $_POST["lname"]; 
 
 $phone= $_POST["phone"];
  $city= $_POST["city"];
  $password= $_POST["password"];
 //$id=  $_POST["id"];
 //DONE:get uid and send it throgh ajax 
 //TODO:get PID From session and insert in to Client tbl

 //...  
//as example pid is 0 it should be taken from the session;
$fk_supplier=$_SESSION['id'];//TODO:THIS IS CORRET ONE 

//$fk_supplier=2;//TODO: for example we take it as 2 ;

 //TODO: I MALE UPDATE FOR THE SESSION AT LOGIN.PHP TO STORE THE ID FOR THE SUPPLIER ,,,YOUR METHOD GOES BY COMPANY NAME UPDATE THE INSERTING QUERY TO INSERT THE COMPANY NAME WE WILL DISCUSSS IT MONDAY

 $street=  $_POST["street"];
 $email=  $_POST["email"]; 
 // $password= $_POST["password"];
 
 


 $role=0;
 $insert = mysqli_query($conn, " INSERT INTO person (role,fname,lname,city,street,phone,email)  VALUES ('" . $role . "','" . $fname . "','" . $lname ."','" . $city ."','" . $street ."','" . $phone . "','" . $email ."')");
    $checkLastid = mysqli_query($conn, "SELECT PID FROM person ORDER BY PID DESC LIMIT 1 ");
    $value = mysqli_fetch_object($checkLastid);
     $last = (int)$value->PID;
 $insertClient = mysqli_query($conn, " INSERT INTO client (id,PID,fkSupplier,Supplier_Company)  VALUES ('" . $PID . "','" . $last . "','" . $fk_supplier ."', '" . $_SESSION['cname'] ."')");
if($insert&&$insertClient){

    $mail_body = "
   <p> Hi ".$_POST['fname']."</p>
   <p>The Supplier has added you . Your password is ".$password."<p>Best Regards,<br />LBPOWER</p>


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
    $mail->AddAddress($_POST['email']);
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
        
   echo "USER successfull inserted";

}else{
    echo "there is problem ,repeat the process if return ,contact support";
}
 
 
 ?>
 
 





