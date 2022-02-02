<?php
include 'confirmed_location.php';

$servername = "localhost";
$username = "id16494475_test";
$password = "<zi_NppRs%[7q-[s";
$dbname = "id16494475_trackingapp";

$EncodedData=file_get_contents("php://input");

$DecodedData=json_decode($EncodedData,true);



//$userid = $_POST["userid"];
$userid = $DecodedData["userid"];
//$userid = 1;

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql_temp5 = "TRUNCATE TABLE `TEMP_$userid`";
(mysqli_query($conn, $sql_temp5));


$table_user = "LOCATIONS_VISITED_$userid";
$sql_rowcount = "SELECT ROW_COUNT()";
$sql_temp2 = "CREATE TABLE TEMP_$userid (
  id INT(6),
  address VARCHAR(30),
  date DATE
  )";
  
mysqli_query($conn, $sql_temp2);

//echo "<br>";
for($x = 0; $x < count($cases_location); $x++){
    
    $value1 = strval($cases_location[$x]["id"]);
    $value2 = strval($cases_location[$x]["address"]);
    $value3 = strval($cases_location[$x]["date"]);
    
    $values = strval($cases_location[$x]["id"]).", ".strval($cases_location[$x]["address"]).", ".strval($cases_location[$x]["date"]);
    //print("$values\n");
    //echo "<br>";
    
    
    
    $sql_temp3 = "INSERT IGNORE INTO `TEMP_$userid` VALUES ('$value1', '$value2', '$value3')";

    //$sql_temp3 = "INSERT IGNORE INTO TEMP1 (id, address, date) VALUES (".$values.")";
    
    if (mysqli_query($conn, $sql_temp3)){
        //print("insert $sql_temp3 successful");
    }
    else{
        print(mysqli_error($conn));
        //print("insert $sql_temp3 failed");
    }
  
    
    
}

$sql_temp4 = "SELECT id, address, date FROM `$table_user` INTERSECT SELECT id, address, date FROM `TEMP_$userid`";
//print("$sql_temp4\n");
$intersect = array();
$result = mysqli_query($conn, $sql_temp4);

if ($result){
    //print("sql_temp4 success.");
}
else{
    print(mysqli_error($conn));
    //print("sql_temp4 fail.");
}
$locationIntersection = array(array());
$n=0;
while($row = mysqli_fetch_assoc($result)){
    foreach($row as $colname => $colvalue){
        //echo "$colname: $colvalue\t";
        //array_push($intersect, $colvalue);
        $locationIntersection[$n][$colname] = $colvalue;
    }
    $n++;
    //echo "<br>";
}
//print($locationIntersection[0]["id"]);
echo json_encode($locationIntersection);






mysqli_close($conn);




?>