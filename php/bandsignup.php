<html>
	<head>
	</head>
	
	<body>
<?php

//making connection
include "connectdb.php";

//starting session
session_start();
$_SESSION['uid']=$_POST['uid'];


$uid=$_POST['uid'];
$uname=$_POST['fullname'];
$birthyear=$_POST['birthyear'];
$email=$_POST['email'];
$bcity=$_POST['ucity'];
$bname=$_POST['bname'];
$bio=$_POST['bio'];
$blink=$_POST['blink'];
$pass=$_POST['pass'];

$x=0;
$countx=1;
$stmt= $mysqli -> prepare("Select count(*) from user where uid =?");
$stmt -> bind_param("s",$uid);
$stmt -> execute();
$stmt->bind_result($countx);
while ($stmt -> fetch())
{
 if ($countx ==1)
	{
		echo "<p><h1>The username has already been registered.</h1></p></div>";
		echo "<p><h2>Please click below to enter again...</h2></p>";
		echo"<p><h3><a href='http://localhost/concerto/bandsignup.html'>Click here</a></h3></p>";
	}

else{
		$x=1;
	}
	
}	if ($x==1)
	{
	$stmt= $mysqli -> prepare("CALL band_signup(?,?,?,?,?,?,?,?,?)");
		$stmt -> bind_param("ssissssss",$uid,$uname,$birthyear,$email,$bcity,$pass,$bname,$blink,$bio);
		$stmt -> execute();

		header( 'Location: http://localhost/concerto/bandprofilebasic.php' ) ;
	}
	 
?>
</body>
</html>