<html>
	<head>
	</head>
	
	<body>
<?php

//making connection
include "php/connectdb.php";

//starting session
session_start();
$userid = $_SESSION["uid"];

//storing the array variable in Bname
$Bname = $_POST["bname"];

//Breaking the array into linear variables
$Container=explode(":",$Bname[0]);


//catching the bandid from container;
$bid=$Container[0];


//calling procedure in database
$stmt= $mysqli -> prepare("CALL user_fan(?,?)");
$stmt -> bind_param("ss",$userid,$bid);
$stmt -> execute();

//redirecting to the page again
header( 'Location: userprofilebasic.php' ) ;




	 
?>
</body>
</html>