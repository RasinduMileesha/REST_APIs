<?php
    $pathc="https://restcountries.com/v3.1/region/asia";
 

    //to read json file through php
    $datac=json_decode(file_get_contents($pathc),true); //decode json file
    //var_dump($datac); //to see the data inside of $data
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Countries Details</title>
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    </head>
    <body>
        <div class="container">
            <h2 class="text-md-start"><center>Asian Countries</center></h2>
            
<style>
.button {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 8px;
}
</style>
        
        <table border="1" class="table table-striped">
            <tr>
                <th>Flag</th>
                <th>Country Name</th>
                <th>Capital City</th>
                <th>Region</th>
                <th>Subregion</th>
                <th>Currencies</th>
                <th>Country Code</th>
                <th></th>
                
            </tr>
            
            <?php foreach($datac as $v){ ?>
            <tr>
                <td><img src="<?php echo $v['flags']['png'] ?>" width="50px"height="30px"></td>
                <td><?php echo $v['name']['common']; ?></td>
                <td><?php if(isset($v['capital'][0])){
                                echo$v['capital'][0];
                                    }
                          else{
                          echo 'Non Capitalized';}
                          ?> </td>
                <td><?php echo $v['region']; ?></td>
                <td><?php echo $v['subregion']; ?></td>
                <td><?php if(isset($v['currencies']) && !empty($v['currencies'])){
                    foreach ($v['currencies'] as $curr) {
                        echo $curr['name'] . '('.$curr['symbol'].')';
                }}
                 
                ?></td>
                <td><?php echo $v['cca2']; ?></td>
                <td><a href="countrydetails.php?q=<?php echo $v['cca2'];?>"<?php echo '<button type="button" class="btn btn-success">view</button>'; ?></a></td>
            </tr>   
                
            </tr>
                
           <?php }  ?>
            
        </table>
        
        </div>

        
    </body>
</html>




















