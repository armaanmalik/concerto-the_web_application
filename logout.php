<html>
<title>
	Concerto
<title>
<body>
	<?php

session_start();
$uid=$_SESSION["uid"];
		//connecting with database
		include("php/connectdb.php"); 
		//Preparing and executing the query in database
											$orderQuery = 	"Update User 
															Set lastaccess= NOW()
															where uid=?";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("s", $uid);
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											$stmt=$mysqli->prepare("Call trustscore_generation(?)");
											$stmt -> bind_param("s", $uid) ;
											if($stmt == false) 
											{
												trigger_error('Wrong SQL stmt: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$stmt->execute();
											
session_unset();
session_destroy();
ob_start();
echo "<h2>Please click here<h2>";
header("location:index.html");
ob_end_flush(); 
include 'home.php';
//include 'home.php';
exit();
	
	?>

</body>
</html>