<html>
<head>
	
</head>
<body>
	helloooo
	
	<form method="post" action="search.php" enctype="multipart/form-data" >
      Search word <input type="text" name="search_idd" id="search_idd"/></br>
      <input type="submit" name="submit" value="search" />
	</form>
	
	
	<?php
	
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b6ddb7ebfbbe78";
    $pwd = "2fbf45c4";
    $db = "waterfanaticDB";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
     
    //get search word
  
    
    if(!empty($_POST)) {
    try {
    	$search_id = $_POST['search_id'];
    }
    catch(Exception $e) {
        die(var_dump($e));
    }
    
    
    // Retrieve data
    
    $sql_select = "SELECT * FROM registration_tbl WHERE 'name' LIKE '%search_id%'";
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
        echo "<h2>Search results:</h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Date</th>";
        echo "<th>company_name</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['date']."</td>";
            echo "<td>".$registrant['company_name']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>No result</h3>";
    }
   
?>
	
</body>
</html>