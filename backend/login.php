<?php

$servername = "localhost";
$username = "id16494475_test";
$password = "<zi_NppRs%[7q-[s";
$dbname = "id16494475_trackingapp";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


//$userid = $_POST["userid"];
//$password = $_POST["password"];

$EncodedData=file_get_contents("php://input");

$DecodedData=json_decode($EncodedData,true);

$userid = $DecodedData["userid"];
$password = $DecodedData["password"];


$sql = "SELECT * FROM `USERS` WHERE id='$userid' AND password='$password'";
$result = $conn -> query($sql) or die($conn->error);

if ($row = $result->fetch_assoc())
{
    $v = 1;
    echo json_encode($v); 
}
else{
    $v = 0;
    echo json_encode($v);
}

    
    //print(json_encode($output, JSON_UNESCAPED_UNICODE));
$conn -> close();




