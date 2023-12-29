<?php
$c=$_GET['q'];

/*$path="Datasets/country-capitals.json";
  $data=json_decode(file_get_contents($path),true);
  foreach ($data as $v){
  if($v['CountryName']==$c){
        $cCode= $v['CountryCode'];
        $cContinent= $v['ContinentName'];
        $cCapital= $v['CapitalName'];
        $cLat= $v['CapitalLatitude'];
        $cLon= $v['CapitalLongitude'];
        
    }
}
*/

    $pathc="https://restcountries.com/v3.1/alpha/$c";
    $datac=json_decode(file_get_contents($pathc),true);
    //var_dump($datac[0]);
    
    $flag=$datac[0]['flags']['png'];
    //echo $flag;

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>view</title>
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
<div>
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8">
            <div class="clearfix">&nbsp;</div>
            <table class="table table-stripped">
                <tr>
                    <td colspan="2" style="text-align: center">
                       
<h1><center><?php echo $datac[0]['name']['common']; ?></center></h1>
<div>
<div class="row">
<div class="col-2">&nbsp;</div>
<div class="col-8">
<div class="clearfix">&nbsp;</div>
<table class="table table-striped">
<tr>
<td colspan="2" style="text-align: center">
<img src="<?php echo $datac[0]['flags']['png']; ?>">
</td>
</tr>
<tr>
<th>Official Name </th>
<th><?php echo $datac[0]['name']['official']; ?> </th>
</tr>
<tr>
<th>Capital </th>
<th><?php echo $datac[0]['capital'][0]; ?>
</th>
</tr>
<tr>
<th>Code </th>
<th><?php echo $datac[0]['cca2']; ?></th>
</tr>
<tr>
<th>Currency </th>
<th>
<?php
if(isset($datac[0]['currencies'])) {
foreach ($datac[0]['currencies'] as $currency) {
echo $currency['name'] . '( '.$currency['symbol'].')';
}
} else {
echo 'No currency';
}
?>
</th>
</tr>
<tr>
<th>Subregion </th>
<th><?php echo $datac[0]['subregion'];?></th>
</tr>
<tr>
<th>Continent </th>
<th><?php echo $datac[0]['continents'][0]; ?> </th>
</tr>
<tr>
<th>Languages </th>
<th>
<?php
$arrl=$datac[0]['languages'];
echo join(", ",$arrl);
?>
</th>
</tr>
<tr>
<th>Borders </th>
<th>
<?php
if(isset($datac[0]['borders'])){
$arrb=$datac[0]['borders'];
echo join(", ",$arrb);
} 
else {
echo"No Borders";
} ?> </th>
</tr>
<tr>
<th>Population </th>
<th>
<?php
echo number_format($datac[0]['population']); 
?> </th>
</tr>
<tr>
<th>Area</th>
<th>
<?php
echo number_format($datac[0]['area']); 
?>
</th>
</tr>
</table>
<div>
</body>
</html>