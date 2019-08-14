<?php
include("DBConnect.php");
session_start();
$costQ = "SELECT `cost_1kw` FROM `supplier`,`client` where client.fkSupplier = supplier.id and client.id ='" .  $_SESSION['id']. "'"  or die(mysqli_error($conn));
   
    $result = mysqli_query($connect, $costQ);
    if (mysqli_num_rows($result) == 0) {
    
      $get1kw=0;
      echo  "1kw cost ".$get1kw;
    } else {
      $cost = mysqli_fetch_object($result);
      $get1kw  = (int)$cost->cost_1kw;
      echo  "1kw cost ".$get1kw;
      
    }

?>