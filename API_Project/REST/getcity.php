<?php
$c=$_GET['q'];
$curl = curl_init();
curl_setopt_array($curl, [
CURLOPT_URL => "https://city-and-state-search-api.p.rapidapi.com/search?q=$c",
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
<html>
<head>
<meta charset="UTF-8">
<title>City Details</title>
<link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
<title>Details of City</title>
</head>
<body>
<div class="container">
<h1>City Details</h1>
<table class="table">
<thead>
<tr>
<th>ID</th>
<th>City Name</th>
<th>State Name</th>
<th>Country Name</th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach ($cityarr as $city) { ?>
<tr>
<td><?php echo $city['id']; ?></td>
<td><?php echo $city['name']; ?></td>
<td>
<?php
if (isset($city['state_name'])) {
echo $city['state_name'];
}
else {
echo 'void';
}
?>
</td>
<td>
<?php
if (isset($city['country_name'])) {
echo$city['country_name'];
}
else {
echo 'void';
}
?>
</td>
<td><a href="citydetails.php?q=<?php echo $city['id'];?>"><?php echo
'<button type="button" class="btn btn-success">City Details</button>'; ?></a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</body>
</html>
   
