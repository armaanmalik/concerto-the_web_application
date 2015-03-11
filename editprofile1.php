<?php
// Start the session

	session_start();
	
	
	//storing session 
	$userid = $_SESSION['uid'];
	
	
	//connecting with database
	include("php/connectdb.php"); 
	
	
	//checking when name is updated
	if (isset($_POST['updatename']))
	
	{
	
		$uname = $_POST['fullname'];

		
		$query = 	"update user
					set uname = ?
					where uid= ? ";
		
		$stmt= $mysqli -> prepare($query);
		$stmt -> bind_param("ss",$uname,$userid);
		$stmt -> execute();
		
		
		header( 'Location: http://localhost/concerto/editprofile.php' ) ;
	
	}
	
	//checking when birthyear is updated
	if (isset($_POST['updatebirthyear']))
	
	{
		
		$birthyear = $_POST['birthyear'];
	
		$query = 	"update user
					set birthyear = ?
					where uid= ? ";
		
		$stmt= $mysqli -> prepare($query);
		$stmt -> bind_param("is",$birthyear,$userid);
		$stmt -> execute();
	
		header( 'Location: http://localhost/concerto/editprofile.php' ) ;
	
	}
	
	
	//checking when email is updated
	if (isset($_POST['updateemail']))
	
	{
	
		$email = $_POST['email'];
		
		$query = 	"update user
					set email = ?
					where uid= ? ";
		
		$stmt= $mysqli -> prepare($query);
		$stmt -> bind_param("ss",$email,$userid);
		$stmt -> execute();
	
		header( 'Location: http://localhost/concerto/editprofile.php' ) ;
	}
	
	//checking when city is updated
	if (isset($_POST['updatecity']))
	
	{	
		$city = $_POST['ucity'];
	
		$query = 	"update user
					set ucity = ?
					where uid= ? ";
		
		$stmt= $mysqli -> prepare($query);
		$stmt -> bind_param("ss",$city,$userid);
		$stmt -> execute();
	
		header( 'Location: http://localhost/concerto/editprofile.php' ) ;
	}
	
	
	//checking when city is updated
	if (isset($_POST['updatepass']))
	
	{
	
		$pass = $_POST['pass'];

		$query = 	"update user
					set password = ?
					where uid= ? ";
		
		$stmt= $mysqli -> prepare($query);
		$stmt -> bind_param("ss",$pass,$userid);
		$stmt -> execute();
	
		header( 'Location: http://localhost/concerto/editprofile.php' ) ;
	
	}	
		
	if (isset($_POST['done']))
	{
		header( 'Location: http://localhost/concerto/userprofilebasic.php' ) ;
	
	}
	
	
	
	
	
	
	
	
	
	
?>
