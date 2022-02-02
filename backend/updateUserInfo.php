<?php

$servername = "localhost";
$username = "id16494475_test";
$password = "<zi_NppRs%[7q-[s";
$dbname = "id16494475_trackingapp";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected\n";

$EncodedData=file_get_contents("php://input");

$DecodedData=json_decode($EncodedData,true);

/*
$userid = $_POST["userid"];
$name = $_POST["name"];
$covidtest = $_POST["covidtest"];
$address = $_POST["address"];
$phone_number = $_POST["phone_number"];
*/

$userid = $DecodedData["userid"];
$name = $DecodedData["name"];
$covidtest = $DecodedData["covidtest"];
$address = $DecodedData["address"];
$phone_number = $DecodedData["phone_number"];


$sql_upload = "UPDATE USERS
SET name = '$name', covidtest='$covidtest', address='$address', phone_number='$phone_number'
WHERE id = '$userid'";
//print($sql_upload);
$sql_rowcount = "SELECT ROW_COUNT()";

$count1 = mysqli_query($conn, $sql_rowcount);
$table = mysqli_query($conn, $sql_upload);
$count2 = mysqli_query($conn, $sql_rowcount);

if(mysqli_query($conn, $sql_upload)){
    echo "Update succesfully\n";
    /*
    $sql = "SELECT * from LOCATIONS_VISITED_".$userid;
    $result = mysqli_query($conn, $sql) or die(mysqli_error());
    
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $colname => $colvalue){
            echo "$colname: $colvalue\t";
        }
        echo "\n";
    }    
    //$response[] = array("rollNo"=>$rollNo, "address"=>$address, "date"=>$date);
    echo json_encode($result);
    
    */
}
else{
    echo "Upload failed";
}

mysqli_close($conn);
?>