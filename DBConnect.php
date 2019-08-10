<?php


$servername = "localhost";
$username = "root";
$password = "";
$db = "id8992783_isd";


$connect=mysqli_connect($servername,$username,$password,$db);
if(mysqli_connect_error()){
die("cannot connect to database".mysql_connect_error())	;	
}
?>
