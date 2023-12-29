<?php
    $path="https://city-and-state-search-api.p.rapidapi.com/cities";
    
    //to read json file through php
    $data=json_decode(file_get_contents($path),true); //decode json file
    //var_dump($data[0]); //to see the data inside of $data
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>City Details</title>
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    
        <script>
            function showCities(str) { //response part
                var xhttp;
                if (str == "") {
                  document.getElementById("show").innerHTML = ""; //document objet model
                  return;
                }
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() { //check if there is any state changes --- call back funnctions
                  if (this.readyState == 4 && this.status == 200) { //4=request finished and response is ready---if the request is success it shows in status.
                  document.getElementById("show").innerHTML = this.responseText; //using responsetext poperty -- we add responsetext to show
                  }
                };
                xhttp.open("GET", "getcity.php?q="+str, true); //request part  --- true means asynchrronous method
                xhttp.send();
            }
        </script>
    </head>
<body>
<div id="main">
<div id="content">
<div class="container">
<div class="row">
<div class="col-md-1">&nbsp;</div>
<div class="col-md-10" >
<h5 class="text-md-start"><center>City 
Information<center></h5>
<div class="container">
<h5 class="text text-primary">
<div class="row">
<div class="col-md-4">Search Cities:</div>
<div class="col-md-8"> <input type="text"
id="search" class="form-control" onkeyup="showCities(this.value)" />
</div> </div>
</h5>
<hr />
<div id="show">Load Cities</div>
</div>
<div class="col-md-1">&nbsp;</div>
</div>
</div>
</div>
</body>
</html>