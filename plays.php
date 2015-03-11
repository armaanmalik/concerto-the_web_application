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

//storing the array variable in Gname
$Gname = $_POST["gname1"];

//Breaking the array into linear variables
$Container=explode(":",$Gname[0]);


//catching the genre from container;
$genrename=$Container[0];
$genresubcategory=$Container[1];


//calling procedure in database
$stmt= $mysqli -> prepare("CALL band_plays(?,?,?)");
$stmt -> bind_param("sss",$userid,$genrename,$genresubcategory);
$stmt -> execute();

//redirecting to the page again
header( 'Location: bandprofilebasic.php' ) ;




	 
?>
</body>
</html>