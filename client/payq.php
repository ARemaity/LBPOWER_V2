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
}

?>