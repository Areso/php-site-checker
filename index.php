 <?php
  include("connection.php");
  $site          = "http://uk-vodokanal.kz/asdsdsd";
  $header_check  = get_headers($site);
  $response_code = $header_check[0]; 
  
  if ($response_code <> "HTTP/1.1 200 OK")
  {
  try {
    $conn = new PDO("mysql: host=$servername;port=$port;dbname=$dbname", 
      $username, $password);
      //// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO watch (site, trying_from, server_respond)
    VALUES ($site, $trying_from, $response_code)";
      ////use exec() because no results are returned
    $conn->exec($sql);
    
    unset($username);
    unset($password);
    
    echo "New record created successfully";
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
  
  $conn = null;
  
  } else {
    echo "site is up";
  }
?> 
