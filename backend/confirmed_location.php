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

/*
$userid = $_POST["userid"];
$values = $_POST["valuesToBeUploaded"];

//$values = "'123', 'Mall Nowhere', '2021-3-30'";
//$values format: location_id, address, date 
*/
/*
$sql1 = "SELECT id FROM USERS WHERE covidtest=1";
$result2 = mysqli_query($conn, $sql1);
if ($result2) {
    while ($row = mysqli_fetch_assoc($result2)){
        foreach ($row as $colname => $colvalue){
            $sql2 = "INSERT INTO CONFIRMED_CASES VALUES ('$colvalue' WHERE '$colvalue' NOT IN SELECT id FROM CONFIRMED_CASES)";
            if (mysqli_query($conn, $sql2)){
                
            }
            else{
                print(mysqli_error($conn));
            }
        }
    }
}
else {
    print(mysqli_error($conn));
}

*/

$sql2 = "INSERT INTO CONFIRMED_CASES (id) SELECT id FROM USERS WHERE covidtest=1 AND USERS.id NOT IN (SELECT id FROM CONFIRMED_CASES)";
if (mysqli_query($conn, $sql2)){
    
}
else{
    print(mysqli_error($conn));
}

$sql_download = "SELECT id FROM CONFIRMED_CASES";
$result = mysqli_query($conn, $sql_download) or die(mysqli_error());
$a = array();
    while($row = mysqli_fetch_assoc($result)){
        //echo $row;
        //array_push($a,$row);
        
        foreach($row as $colname => $colvalue){
            array_push($a,$colvalue);
            //echo "$colname: $colvalue\t";
        }
        
        //echo "\n";
    }    
    //$response[] = array("rollNo"=>$rollNo, "address"=>$address, "date"=>$date);
    foreach($a as $value){
        //print("$value ") ;
    }

    

$cases_location = array(array());
$n = 0;
$rowNo = 0;
foreach($a as $case){
    $sql = "SELECT * FROM LOCATIONS_VISITED_".$case;
    //print("$sql\n");
    $result = mysqli_query($conn, $sql);
    if (!$result){
        continue;
    }
    while($row = mysqli_fetch_assoc($result)){
        foreach($row as $colname => $colvalue){
            //echo "$colname: $colvalue\t";
            $cases_location[$n][$colname] = $colvalue;
        }
        $n++;
    }
}

//print_r($cases_location);
//echo json_encode($cases_location);
    
mysqli_close($conn);
?>