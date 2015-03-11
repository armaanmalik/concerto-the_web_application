<?php

//making connection
include "php/connectdb.php";

//starting session
session_start();
$userid = $_SESSION["uid"];

$concertid = $_SESSION["concertid"];


if(isset($_POST['done']))
{		
		
		$review = $_POST["review"];
		$rating = $_POST["rating"];
		
		
		//calling the "give_rating" stored procedure in database.
		$stmt= $mysqli -> prepare("CALL give_rating(?,?,?,?)");
		$stmt -> bind_param("isis",$concertid,$userid,$rating,$review);
		$stmt -> execute();
	
	header( 'Location: http://localhost/concerto/userprofilebasic.php' ) ;




}


	 
?>
