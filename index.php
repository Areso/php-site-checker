 <?php
include("connection.php");


$hourly = EvPeriodic(0, 3600/10, NULL, function () 
{
  echo "once per hour\n";
  $site          = "http://uk-vodokanal.kz"
  $header_check  = get_headers($site);
  $response_code = $header_check[0]; 
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO watch (site, server_respond)
    VALUES ($site,$response_code')";
    // use exec() because no results are returned
    $conn->exec($sql);
    //echo "New record created successfully";
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;

};
?> 