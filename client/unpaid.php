<?php
include("DBConnect.php");
session_start();
$query = "SELECT * FROM `payment` WHERE      payment_st=0 AND fk_client='". $_SESSION['id']."'";

$unpaidQ= mysqli_query($connect,$query);


if( mysqli_num_rows($unpaidQ)==0){

  $unpaid=0;
  echo $unpaid." Unpaid payment";

}else{
$unpaid= mysqli_num_rows($unpaidQ);
echo $unpaid." Unpaid payment";

}
?>