<?php
// creating variables to connect with the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "covid2023";
$conn = new mysqli($servername, $username, $password, $dbname);// Create connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);// Check connection
}
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://covid-193.p.rapidapi.com/statistics",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 25,
    CURLOPT_TIMEOUT => 40,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: covid-193.p.rapidapi.com",
        "X-RapidAPI-Key: d4e54d8258mshb94bb95cea982b8p191424jsnadc6b4868892"
    ],
    
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $responseArray = json_decode($response, true);
    $countries = $responseArray['response'];
}

foreach ($countries as $con) {
$countryName = $con['country'];
$population = $con['population'];
$totalcases = $con['cases']['total'];
$deaths = $con['deaths']['total'];
$tests = $con['tests']['total'];
$continent = $con['continent'];
$date = $con['day'];
// Insert data to the table covidcases
$sql = "INSERT INTO covidcases (countryName, population, totalcases, deaths, tests, 
continent, date)
VALUES ('$countryName', '$population', '$totalcases', '$deaths', '$tests', 
'$continent', '$date')";

if ($conn->query($sql) === TRUE) {
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
}
echo "Data have been successfully Inserted";
// Close the connection
$conn->close();
?>