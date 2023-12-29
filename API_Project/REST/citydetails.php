<?php
$c=$_GET['q'];
$curl = curl_init();
curl_setopt_array($curl, [
CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/cities/$c",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 25,
CURLOPT_TIMEOUT => 40,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "GET",
CURLOPT_HTTPHEADER => [
"X-RapidAPI-Host: city-and-state-search-api.p.rapidapi.com",
"X-RapidAPI-Key: d4e54d8258mshb94bb95cea982b8p191424jsnadc6b4868892"
],
]);
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
echo "cURL Error #:" . $err;
} else {
$cityarr = json_decode($response, true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
<title>City Details</title>
</head>
<body>
<h1><center>City Information</center></h1>
<div>
<div class="row">
<div class="col-2">&nbsp;</div>
<div class="col-8">
<div class="clearfix">&nbsp;</div>
<table class="table table-striped">
<tr>
<th>City ID:</th>
<th><?php echo $cityarr['id']; ?> </th>
</tr>
<tr>
<th>City Name:</th>
<th><?php echo $cityarr['name']; ?> </th>
</tr>
<tr>
<th>State Name:</th>
<th>
<?php
if (isset($cityarr['state_name'])) {
echo $cityarr['state_name'];
} else {
echo 'No data to display';
}
?>
</th>
</tr>
<tr>
<th>Country Name:</th>
<th>
<?php
if (isset($cityarr['country_name'])) {
echo $cityarr['country_name'];
} else {
echo 'No data to display';
}
?>
</th>
</tr>
<tr>
<th>Country Flag:</th>
<th>
<?php
echo "<img src='https://flagcdn.com/w320/" . 
strtolower($cityarr['country_code']) . ".png' alt='" . $cityarr['country_name'] . " Flag' 
width='100' height='50'>";
?>
</th>
</tr>
<tr>
<th colspan="2">
<iframe
width="100%"
height="250"
frameborder="1" style="border:1"
referrerpolicy="no-referrer-when-downgrade"
src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCF-hvTaPiyTKrYaGErP3QI6CxQOBW7Edo&q=<?php echo urlencode($cityarr['name'] . ', ' . 
$cityarr['country_name']); ?>&zoom=15"
allowfullscreen>
</iframe>
</th>
</tr>
</table>
</div>
</div>
</div>
</body>
</html>