<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://covid-193.p.rapidapi.com/statistics");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
curl_setopt($curl, CURLOPT_MAXREDIRS, 25);
curl_setopt($curl, CURLOPT_TIMEOUT, 40);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
$headers = array(
    "X-RapidAPI-Host: covid-193.p.rapidapi.com",
    "X-RapidAPI-Key: d4e54d8258mshb94bb95cea982b8p191424jsnadc6b4868892"
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $responseArray = json_decode($response, true);
    $countries = $responseArray['response'];

    // Create an array to hold Europe's COVID-19 information
    $europeData = [];

    // Filter and store Europe's data
    foreach ($countries as $con) {
        if ($con['continent'] === "Europe") {
            $europeData[] = $con;
        }
    }

    // Output Europe's data
    //print_r($europeData);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css"/>
    <title>COVID19 Information in Europe</title>
</head>
<body>
    <div class="container">
        <h1><center>COVID19 Information in Europe</center></h1>
        <table class="table">
            <tr>
                <th>Country</th>
                <th>Population</th>
                <th>Total Covid Cases</th>
                <th>Total Deaths</th>
                <th>Tests</th>
                <th>Continent</th>
            </tr>
            <?php foreach ($europeData as $con) { ?>
                <tr>
                    <td><?php echo $con['country']; ?></td>
                    <td><?php echo $con['population'] ?? '0'; ?></td>
                    <td><?php echo $con['cases']['total'] ?? '0'; ?></td>
                    <td><?php echo $con['deaths']['total'] ?? '0'; ?></td>
                    <td><?php echo $con['tests']['total'] ?? '0'; ?></td>
                    <td><?php echo $con['continent']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
