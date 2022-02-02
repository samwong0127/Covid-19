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

//$userid = $_POST["userid"];
//$values = $_POST["valuesToBeUploaded"];

$userid = $DecodedData["userid"];
//$values = $DecodedData["valuesToBeUploaded"];
$id = $DecodedData["locationID"];
$address = $DecodedData["address"];
$date = $DecodedData["date"];

// date = YYYY-MM-DD


//$sql_upload = "INSERT IGNORE INTO LOCATIONS_VISITED_$userid (id, address, date) VALUES ('$values')";
$sql_upload = "INSERT IGNORE INTO LOCATIONS_VISITED_$userid (id, address, date) VALUES ('$id', '$address', '$date')";
$sql_rowcount = "SELECT ROW_COUNT()";

$count1 = mysqli_query($conn, $sql_rowcount);
$table = mysqli_query($conn, $sql_upload);
$count2 = mysqli_query($conn, $sql_rowcount);

if(mysqli_query($conn, $sql_upload)){
    echo json_encode(1);
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
    print(mysqli_error($conn));
    echo json_encode(0);
}

mysqli_close($conn);
?>