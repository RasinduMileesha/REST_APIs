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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css"/>
    <title>COVID19 Barchart in Europe</title>
</head>
<script type="text/javascript"
src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});
// IT used as a callback when google visualization API loaded. 
google.charts.setOnLoadCallback(drawChart);
// Callback that creates and populates a data table,
// instantiates the bar chart, passes in the data and
// draws it.
function drawChart() {
// Create the data table.
var data = new google.visualization.DataTable();
data.addColumn('string', 'countryes');
data.addColumn('number', 'cases');
// Add rows for each country in Europe
<?php
foreach ($countries as $con) {
// Check if the country is in Europe
if ($con['continent'] == 'Europe') {
// Get the country name and number of cases
$countryName = $con['country'];
$cases = $con['cases']['total'];
// Add the row to the data table
echo "data.addRow(['$countryName', $cases]);";
}
}
?>
// Set chart options
var options = {'title':'Cases vs Countries in Europe',
'width':1300,
'height':550,
'legend': { position: 'bottom' }};
// Instantiate and draw our chart, passing in some options.
var chart = new
google.visualization.BarChart(document.getElementById('chart_div'));
chart.draw(data, options);
}
</script>
<title></title>
</head>
<body>
<div class="container">
<h1><center>COVID19 Information in Europe - Bar Chart</center></h1>
<div id="chart_div"></div>
</div>
</body>
</html>