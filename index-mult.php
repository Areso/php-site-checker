//<connection>
//$sites       = array("http:/one.com","http:/two.com/123");

<?php
  include("connection.php");

  
  
  try {
    $conn = new PDO("mysql: host=$servername;port=$port;dbname=$dbname", 
      $username, $password);
      //// set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $arrlength = count($sites);
    
    $sql = "INSERT INTO watch (site, trying_from, server_respond)";
    for($x = 0; $x < $arrlength; $x++) {
      
      $header_check  = get_headers($sites[$x]);
      $response_code = $header_check[0]; 
      if ($response_code <> "HTTP/1.1 200 OK")
      {
  
      $sql = $sql . "VALUES ('$sites[$x]', '$trying_from', '$response_code')";
      if ($x = $arrlength-1) {
        $sql = $sql . ';';
      } else {
        $sql = $sql . ',';
      }
      }
    }
    
    
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

?> 


