

    <?php
include("DBConnect.php");
session_start();
$getdata = mysqli_query($connect, "SELECT value FROM  cumulative Where fk_id='" . $_SESSION['id'] . "'") or die(mysqli_error($connect));
  if (mysqli_num_rows($getdata) == 0) {
    $kw =  0;
  } else {
    $cum = mysqli_fetch_object($getdata);
    $getCumumlative  = (int)$cum->value;
    $kw =  $getCumumlative;
}

$costQ = "SELECT `cost_1kw` FROM `supplier`,`client` where client.fkSupplier = supplier.id and client.id ='" .  $_SESSION['id']. "'"  or die(mysqli_error($connect));
   
    $result = mysqli_query($connect, $costQ);
    if (mysqli_num_rows($result) == 0) {
    
      $get1kw=0;
      $total=0;
      echo "payment till today ".$total;
    } else {
      $cost = mysqli_fetch_object($result);
      $get1kw  = (int)$cost->cost_1kw;
      $total = $get1kw * $kw;
      echo "payment till today ".$total;
      
    }

?>