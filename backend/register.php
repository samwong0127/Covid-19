<?php

$servername = "localhost";
$username = "id16494475_test";
$password = "<zi_NppRs%[7q-[s";
$dbname = "id16494475_trackingapp";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/*
$userid = $_POST["userid"];
$password = $_POST["password"];
$name = $_POST["name"];
$covidtest = $_POST["covidtest"];
$address = $_POST["address"];
$phoneNumber = $_POST["phoneNumber"];
*/


$EncodedData=file_get_contents("php://input");

$DecodedData=json_decode($EncodedData,true);


$userid = $DecodedData["userid"];
$password = $DecodedData["password"];
$name = $DecodedData["name"];
$covidtest = $DecodedData["covidtest"];
$address = $DecodedData["address"];
$phoneNumber = $DecodedData["phoneNumber"];


$sql1 = "SELECT * FROM `USERS` WHERE id='$userid'";
$sql2 = "SELECT * FROM `USERS` WHERE name='$name'";
$sql3 = "SELECT * FROM `USERS` WHERE password='$password'";
$sql4 = "SELECT * FROM `USERS` WHERE phone_number='$phoneNumber'";


$result1 = $conn -> query($sql1) or die($conn->error);
$result2 = $conn -> query($sql2) or die($conn->error);
$result3 = $conn -> query($sql3) or die($conn->error);
$result4 = $conn -> query($sql4) or die($conn->error);




if ($row1 = $result1->fetch_assoc() || $row2 = $result2->fetch_assoc() || $row3 = $result3->fetch_assoc() || $row4 = $result4->fetch_assoc()){
    $v = 0;
    echo json_encode($v); 
}
else{
    
    $sql5 = "INSERT IGNORE INTO `USERS` VALUES ('$userid', '$name', '$covidtest', '$address', '$password', '$phoneNumber') ";
    //print($sql5);
    if (mysqli_query($conn, $sql5)){
        $v = 1;
        echo json_encode($v); 
    }
    else{
        $v = 0;
        echo json_encode($v); 
    }

}

    
    //print(json_encode($output, JSON_UNESCAPED_UNICODE));
$conn -> close();




