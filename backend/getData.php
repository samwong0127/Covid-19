<?php

function get_data_from_api() {
// Reference: 
// https://stackoverflow.com/questions/56570985/how-to-get-data-from-api-and-show-it-on-php-page
// Run the function that will make a POST request and return the token

//$exoclick_token = get_token_from_api();

//$new_token = $exoclick_token->token;

$auth_array = array(
        "Authorization:",
        "Bearer"
);

//$new_token = implode(" ", $auth_array);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.data.gov.hk/v2/filter?q=%7B%22resource%22%3A%22http%3A%2F%2Fwww.chp.gov.hk%2Ffiles%2Fmisc%2Flatest_situation_of_reported_cases_covid_19_eng.csv%22%2C%22section%22%3A1%2C%22format%22%3A%22json%22%7D",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
     "Content-Type: application/json",
     "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

$data = json_decode($response, true);

// do something with the data

/*
print_r($data[0]['Number of confirmed cases']);
print("\n");
print(count($data));
print("\n");
$sum = 0;
for ($i = 0; $i < count($data); $i++){
    $sum += $data[$i]['Number of confirmed cases'];
}

print($sum);
*/

$totalCases = $data[count($data)-1]['Number of confirmed cases'];
$dailyCases = $data[count($data)-1]['Number of confirmed cases'] - $data[count($data)-2]['Number of confirmed cases'];
$totalDeath = $data[count($data)-1]['Number of death cases'];
$dailyDeath = $data[count($data)-1]['Number of death cases'] - $data[count($data)-2]['Number of death cases'];
$totalRecovered = $data[count($data)-1]['Number of discharge cases'];
$dailyRecovered = $data[count($data)-1]['Number of discharge cases'] - $data[count($data)-2]['Number of discharge cases'];

$result[] = array("totalCases"=>$totalCases, "dailyCases"=>$dailyCases, "totalDeath"=>$totalDeath, "dailyDeath"=>$dailyDeath, "totalRecovered"=>$totalRecovered, "dailyRecovered"=>$dailyRecovered);

return ($result);


}

$EncodedData=file_get_contents("php://input");

$DecodedData=json_decode($EncodedData,true);

$request = $DecodedData["updating"];

$result = get_data_from_api();

echo json_encode($result);



?>