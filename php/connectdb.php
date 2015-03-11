<?php
$mysqli = new mysqli("localhost", "root", "", "band project");

//check for database connection
if (mysqli_connect_errno()) 
   {
    printf("Connect failed: %s\n", mysqli_connect_error());
   
   } 
   else
     {
	   // echo'Connection Successful ';
	 }
?>
