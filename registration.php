
<?php
//register.php
include_once('src/PHPMailer.php');
include_once('src/SMTP.php');
include_once('src/Exception.php');
include('DBConnect.php');


$message = '';

if(isset($_POST["register"]))
{


    $getdata = mysqli_query($connect , "SELECT * FROM pass Where email='" . $_POST['email'] . "'");

    if (mysqli_num_rows($getdata) > 0) 
 {

   
  $message = '<label class="text-danger">Email Already Exits</label>';
 }
 else
 {
  $user_password = rand(100000,999999);
  $user_encrypted_password = password_hash($user_password, PASSWORD_DEFAULT);
  $user_activation_code = md5(rand());
  $insert = mysqli_query($connect, "INSERT INTO pass(password,email,status,activation_code)  VALUES ('" . $user_encrypted_password . "','"  . $_POST['email'] . "','" . 0 . "','" . $user_activation_code . "')") ;
  if($insert)
  {
/////////////////////
$getsidQ = mysqli_query($connect, "SELECT SID FROM pass where  email ='".$_POST['email']."' ORDER BY SID DESC LIMIT 1 ");
$values = mysqli_fetch_object($getsidQ);
 $getsid = (int)$values->SID;
$insert = mysqli_query($connect, " INSERT INTO person (role,fname,lname,city,street,phone,email)  VALUES ('" . 1 . "','" . $_POST['fname'] . "','" . $_POST['lname'] ."','" . $_POST['city'] ."','". $_POST['street'] ."','". $_POST['phone'] ."','". $_POST['email']."')");  
    $checkLastid = mysqli_query($connect, "SELECT PID FROM person where fname='".$_POST['fname']."' ORDER BY PID DESC LIMIT 1 ");
    if( $checkLastid){

       $value = mysqli_fetch_object($checkLastid);
       
     $last = (int)$value->PID;
      $insert = mysqli_query($connect, " INSERT INTO supplier (PID,SID,comapany_name,cost_1kw,user_capacity)  VALUES ('" . $last . "','" .$getsid . "','" . $_POST['cname'] ."','" . 60 ."','"  . $_POST['capacity'] ."')");

    }else{

        $message = '<label class="text-danger">there is error check later</label>';
        
    }
   

    ///////////////////////
   $base_url = "http://localhost/final/LBPOWER/";
   $mail_body = "
   <p> Hi ".$_POST['fname']."</p>
   <p>Thanks for Registration. Your password is ".$user_password.", This password will work only after your email verification.</p>
   <p>Please Open this link to verified your email address - ".$base_url."emailver.php?activation_code=".$user_activation_code."
   <p>Best Regards,<br />LBPOWER</p>
   ";





   ///////////////////////////
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
   $mail->Subject = 'Email Verification';   //Sets the Subject of the message
   $mail->Body = $mail_body;       //An HTML or plain text message body
   if($mail->Send())        //Send an Email. Return true on success or false on error
   {
    $message = '<label class="text-success">Register Done, Please check your mail.</label>';
   }
  }else{


    echo '<script> window.alert("there is error try again");</script>';
  }
 }
}

?>


<!DOCTYPE html>
        <!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
        <!--[if gt IE 8]>
        <!-->
        <html class="no-js" lang="en">
        <!--<![endif]-->
        
        <head>
        
            <!-- Basic Page Needs
            ================================================== -->
            <meta charset="utf-8">
            <title>LBPOWER</title>
            
        
            <!-- Mobile Specific Metas
            ================================================== -->
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            <meta name="theme-color" content="#212121" />
            <meta name="msapplication-navbutton-color" content="#212121" />
            <meta name="apple-mobile-web-app-status-bar-style" content="#212121" />
            <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900"
                rel="stylesheet" />
            <link
                href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet" />
            <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,400i,600,600i,700,700i" rel="stylesheet" />
            <link rel="stylesheet" href="css/bootstrap.min.css" />
            <link rel="stylesheet" href="css/font-awesome.min.css" />
            <link rel="stylesheet" href="css/owl.carousel.css" />
            <link rel="stylesheet" href="css/owl.transitions.css" />
            <link rel="stylesheet" href="css/style.css" />
            <link rel="stylesheet" href="css/colors/color.css" />
            <link rel="icon" type="image/png" href="favicon.png">
        
        
        </head>
        
        <body>
        
            <div class="loader">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;"
                    xml:space="preserve">
                    <rect x="0" y="0" width="4" height="10" fill="#333">
                        <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0"
                            begin="0" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                    <rect x="10" y="0" width="4" height="10" fill="#333">
                        <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0"
                            begin="0.2s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                    <rect x="20" y="0" width="4" height="10" fill="#333">
                        <animateTransform attributeType="xml" attributeName="transform" type="translate" values="0 0; 0 20; 0 0"
                            begin="0.4s" dur="0.6s" repeatCount="indefinite" />
                    </rect>
                </svg>
            </div>
        
        
        
            <!-- Nav and Logo
            ================================================== -->
        
            <div id="menu-wrap" class="menu-back cbp-af-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav class="navbar navbar-expand-lg navbar-light bg-light mx-lg-0">
                                <a class="navbar-brand" href="index.html"><img src="img/small.png" alt=""></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon">
                                        <span class="menu-icon__line menu-icon__line-left"></span>
                                        <span class="menu-icon__line"></span>
                                        <span class="menu-icon__line menu-icon__line-right"></span>
                                    </span>
                                </button>
        
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link" href="index.html">Home</a>
                                        </li>
        
        
                                        <li class="nav-item">
                                            <a class="nav-link" href="registration.html">Register</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="#roadmap">Roadmap</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="#team">Team</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#faq">FAQ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#contact">Contact us</a>
                                        </li>
        
                                        <li class="nav-item mt-2">
                                            <a class="btn btn-primary js-tilt" href="login.html" role="button"
                                                data-tilt-perspective="300" data-tilt-speed="700"
                                                style="background-color:azure;"
                                                data-tilt-max="24"><span>login</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section full-height height-auto-lg hide-over background-light-blue">
                <div class="hero-center-wrap relative-on-lg" style="margin-top:20px;">
                        <form method="post" id="register_form">
                        <?php echo $message; ?>
                    <div class="container" >
                      
                            <div class="row">
                                    <div class="col-sm-6 form-group">
                                            <label>First Name</label>
                                
                                            <input name="fname"type="text" placeholder="Enter First Name Here.." class="form-control" required="required">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                
                                        <div class="col-sm-6 form-group">
                                            <label>Last Name</label>
                                
                                            <input name="lname" type="text" placeholder="Enter Last Name Here.." class="form-control"required="required">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                
                                </div>
                        </div> <div class="container">
                                <div class="row">
                                        <div class="col-sm-6 form-group">
                                                <label>City</label>
                                    
                                                <input name="city" type="text" placeholder="Enter your city " class="form-control" required="required">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                    
                                            <div class="col-sm-6 form-group">
                                                <label>Street</label>
                                    
                                                <input name="street"type="text" placeholder="Enter you street" class="form-control" required="required">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                    </div>
                        
                              </div>
                              <div class="container">
                                    <div class="row">
                                            <div class="col-sm-6 form-group">
                                                    <label>Comapny Name</label>
                                    
                                                    <input name="cname" type="text" placeholder="Enter your Comapny name " class="form-control" required="required">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                    
                                                <div class="col-sm-6 form-group">
                                                    <label>Enter user capacity</label>

                                                    <input  type="number" name="capacity"type="text" placeholder="Enter user capacity" class="form-control"  required="required" >
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                        </div>
                                </div>
                                  <div class="container">
                                        <div class="row">
                                        <div class="col-sm-6 form-group">
                                                <label> Email</label>
                                                <input id="email" type="email" name="email" class="form-control"
                                                    placeholder="Enter your email *" required="required" data-error="Valid email is required.">
                                                <!-- <div class="help-block with-errors"></div> -->
                                    
                                            </div>
                                            <div class="col-sm-6 form-group">
                                                <label>Phone</label>
                                              
                                                <input id="phone" type="tel"  name="phone" class="form-control" required="required" data-error="Valid phone is required."
                                                    placeholder="Enter your phone">
                                                
                                            </div>
                                      </div>
                              </div>
                           
                              <div class="col-md-12 text-center" style="margin-top:50px;">
                                    <input type="submit" name="register" class="btn btn-primary btn-send text-center" value="Register">
                                </div>  
                                
                                
                                </form>
                        </div>
        
                    </div>
        
        
              
        
          

        
            <div class="section padding-top-big">
                    <div class="background-parallax" style="background-image: url('img/parallax-5.jpg')" data-enllax-ratio=".5" data-enllax-type="background" data-enllax-direction="vertical"></div>
                    <div class="container padding-bottom-big">
                        <div class="row justify-content-between">
                            <div class="col-lg-4">
                                <h6 class="text-white mb-4">Stay tunned:</h6>
                                <div class="suscribe">
                                    <input class="form-control text-left" placeholder="Enter your email" type="text" name="name" />
                                    <button type="submit" class="btn btn-primary m-0 js-tilt" data-tilt-perspective="300" data-tilt-speed="700" data-tilt-max="24"><span>subscribe</span></button>
                                </div>
                                <p class="text-left text-white mb-0"><small>* we promise that we won´t spam you, never.</small></p>
                            </div>
                            <div class="col-lg-5 mt-4">
                                <ul class="footer-list">
                                    <li class="text-left"><a href="#">concept</a></li>
                                    <li class="text-left"><a href="#">team</a></li>
                                    <li class="text-left"><a href="#">FAQ</a></li>
                                    <li class="text-left"><a href="#">download app</a></li>
                                    <li class="text-left"><a href="#">contact</a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="section py-4 background-dark-blue">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 footer text-center text-lg-left">
                                    <p>Copyright © 2019,  <a href="www.facebook.com/LBPOWER">LBPOWER</a></p>
                                </div>
                                <div class="col-lg-6 footer mt-4 mr-auto mt-lg-0 mr-lg-0 text-center text-lg-right">
                                    <a class="app-btn mx-2 mr-lg-3" href="#"><i class="fa fa-twitter"></i></a>
                                    <a class="app-btn mx-2 mr-lg-3" href="#"><i class="fa fa-facebook"></i></a>
                                    <a class="app-btn mx-2 mr-lg-3" href="#"><i class="fa fa-git"></i></a>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
                
                <div class="scroll-to-top">to top</div>
                <div id="particles-js" class="min-height"></div>
            
            <!-- JAVASCRIPT
            ================================================== -->
            <script src="https://www.gstatic.com/firebasejs/4.8.1/firebase.js"></script>
          <script src="js/authlogin.js"></script>
          <script src="js/ulogin.js"></script>
            <script src="js/jquery-3.2.1.min.js"></script>
            <script src="js/popper.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/plugins.js"></script>
            <script src="js/chart-custom.js"></script>
            <script src="js/particles.js"></script>
            <script src="js/custom.js"></script>
        </body>
        
        </html>


