<?php
require("db.php");
session_start();
$_SESSION['id'];
// Gets data from URL parameters.
if(isset($_GET['add_location'])) {
    add_location();
}

function add_location(){
$servername = "localhost";
$username = "root";
$password = "";
$db = "id8992783_isd";


$connect=mysqli_connect($servername,$username,$password,$db);
if(mysqli_connect_error()){
die("cannot connect to database".mysql_connect_error())	;	
}
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $description =$_GET['description'];
    // Inserts new row with place data.
    $query = sprintf("INSERT INTO locations " .
        " (GID, fkSupplier,lat, lng, description) " .
        " VALUES (NULL,".$_SESSION['id']." ,'%s', '%s', '%s');",
        
        mysqli_real_escape_string($connect,$lat),
        mysqli_real_escape_string($connect,$lng),
        mysqli_real_escape_string($connect,$description));

    $result = mysqli_query($connect,$query);
    echo"Inserted Successfully";

    

    if (!$result) {
        die('Invalid query: ' . mysqli_error($connect));
    }
}
// function confirm_location(){
//     $con=mysqli_connect ("localhost", 'root', '','demo');
//     if (!$con) {
//         die('Not connected : ' . mysqli_connect_error());
//     }
//     $id =$_GET['id'];
//     $confirmed =$_GET['confirmed'];
//     // update location with confirm if admin confirm.
//     $query = "update locations set location_status = $confirmed WHERE id = $id ";
//     $result = mysqli_query($con,$query);
//     echo "Inserted Successfully";
//     if (!$result) {
//         die('Invalid query: ' . mysqli_error($con));
//     }
// }
// function get_confirmed_locations(){
//     $con=mysqli_connect ("localhost", 'root', '','demo');
//     if (!$con) {
//         die('Not connected : ' . mysqli_connect_error());
//     }
//     // update location with location_status if admin location_status.
//     $sqldata = mysqli_query($con,"
// select id ,lat,lng,description,location_status as isconfirmed
// from locations WHERE  location_status = 1
//   ");

//     $rows = array();

//     while($r = mysqli_fetch_assoc($sqldata)) {
//         $rows[] = $r;

//     }

//     $indexed = array_map('array_values', $rows);
//     //  $array = array_filter($indexed);

//     echo json_encode($indexed);
//     if (!$rows) {
//         return null;
//     }
// }
function get_all_locations(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "id8992783_isd";
    
    
    $connect=mysqli_connect($servername,$username,$password,$db);
    if(mysqli_connect_error()){
    die("cannot connect to database".mysql_connect_error())	;	
    }
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($connect,"
select GID ,lat,lng,description from locations where fkSupplier='".$_SESSION['id']."'");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
  $indexed = array_map('array_values', $rows);
  //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}
function array_flatten($array) {
    if (!is_array($array)) {
        return FALSE;
    }
    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        }
        else {
            $result[$key] = $value;
        }
    }
    return $result;
}

?>