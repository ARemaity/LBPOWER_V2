<?php
include_once('src/PHPMailer.php');
include_once('src/SMTP.php');
include_once('src/Exception.php');


if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "lbpowerinfo@gmail.com";
    $email_subject = "Contact us providers";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['fname']) ||
        !isset($_POST['lname']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $first_name = $_POST['fname']; // required
    $last_name = $_POST['lname']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['phone']; // not required
    $comments = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
 
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 




    $email_message.= "
<a HREF='mailto:".$email_from."'>Click Here To Email the Client</a>
";
/////////////////////////
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
    $mail->AddAddress('lbpowercontact@gmail.com');
   //Adds a "To" address   
    $mail->WordWrap = 50;       //Sets word wrapping on the body of the message to a given number of characters
    $mail->IsHTML(true);       //Sets message type to HTML    
    $mail->Subject = 'Lbpower contact ';   //Sets the Subject of the message
    $mail->Body = $email_message; 
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