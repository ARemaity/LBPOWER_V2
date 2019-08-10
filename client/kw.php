<?php
include("DBConnect.php");
session_start();
$getdata = mysqli_query($connect, "SELECT value FROM  cumulative Where fk_id='" . $_SESSION['id'] . "'") or die(mysqli_error($conn));
  if (mysqli_num_rows($getdata) == 0) {
    $kw =  0;
	echo $kw." kw";
  } else {
    $cum = mysqli_fetch_object($getdata);
    $getCumumlative  = (int)$cum->value;
    echo $getCumumlative." kw";
}

?>