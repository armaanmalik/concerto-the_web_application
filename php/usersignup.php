<html>
	<head>
	</head>
	
	<body>
<?php

try{
//making connection
include "connectdb.php";

//starting session
session_start();
$_SESSION ["uid"]= $_POST["uid"];

$uid=$_POST['uid'];
$uname=$_POST['fullname'];
$birthyear=$_POST['birthyear'];
$email=$_POST['email'];
$ucity=$_POST['ucity'];
$pass=$_POST['pass'];

$x=0;

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
		echo"<p><h3><a href='http://localhost/concerto/usersignup.html'>Click here</a></h3></p>";
	}

else{ 
$x=1;
}

}

if ($x==1)
{
$stmt1= $mysqli -> prepare("CALL user_signup(?,?,?,?,?,?)");
$stmt1 -> bind_param("ssisss",$uid,$uname,$birthyear,$email,$ucity,$pass);
$stmt1 -> execute();
header( 'Location: http://localhost/concerto/userprofilebasic.php' ) ;
}
}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}	 






?>
</body>
</html>