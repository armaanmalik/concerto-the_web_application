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
		
		
		header( 'Location: http://localhost/concerto/editprofileband.php' ) ;
	
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
	
		header( 'Location: http://localhost/concerto/editprofileband.php' ) ;
	
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
	
		header( 'Location: http://localhost/concerto/editprofileband.php' ) ;
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
	
		header( 'Location: http://localhost/concerto/editprofileband.php' ) ;
	}
	
	
	//checking when Band name is updated
	if (isset($_POST['updatebname']))
	
	{
	
		$bname = $_POST['bname'];

		$query = 	"update band
					set bname = ?
					where bid= ? ";
		echo $bname;
		echo $userid;
		$stmt= $mysqli -> prepare($query);
		$stmt -> bind_param("ss",$bname,$userid);
		$stmt -> execute();
	
		header( 'Location: http://localhost/concerto/editprofileband.php' ) ;
	
	}	
	
	
	//checking when Hyperlink is updated
	if (isset($_POST['updatebhyperlink']))
	
	{
	
		$bhyperlink = $_POST['bhyperlink'];

		$query = 	"update band
					set bhyperlink = ?
					where bid= ? ";
		
		$stmt= $mysqli -> prepare($query);
		$stmt -> bind_param("ss",$bhyperlink,$userid);
		$stmt -> execute();
	
		header( 'Location: http://localhost/concerto/editprofileband.php' ) ;
	
	}	
	
	
	//checking when BIO is updated
	if (isset($_POST['updatebio']))
	
	{
	
		$bio = $_POST['bio'];

		$query = 	"update user
					set biodata = ?
					where bid= ? ";
		
		$stmt= $mysqli -> prepare($query);
		$stmt -> bind_param("ss",$bio,$userid);
		$stmt -> execute();
	
		header( 'Location: http://localhost/concerto/editprofileband.php' ) ;
	
	}	
	
	
	//checking when Password is updated
	if (isset($_POST['updatepass']))
	
	{
	
		$pass = $_POST['pass'];

		$query = 	"update user
					set password = ?
					where uid= ? ";
		
		$stmt= $mysqli -> prepare($query);
		$stmt -> bind_param("ss",$pass,$userid);
		$stmt -> execute();
	
		header( 'Location: http://localhost/concerto/editprofileband.php' ) ;
	
	}	
		
	if (isset($_POST['done']))
	{
		header( 'Location: http://localhost/concerto/bandprofilebasic.php' ) ;
	
	}
	
	
?>
