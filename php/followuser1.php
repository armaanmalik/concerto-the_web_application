<html>
	<head>
		<title>Concerto</title>
	</head>
	
	<body>
<?php

//making connection
include "connectdb.php";

//starting session
session_start();
$userid = $_SESSION["uid"];

//storing the array variable in uname
$uname = $_POST["gname1"];

//Breaking the array into linear variables
$Container=explode(":",$uname[0]);

//catching the genre from container;
$uid=$Container[0];
$uname=$Container[1];

//checking if already exists calling procedure in database
$stmt= $mysqli -> prepare("Select count(*) as count from follow where followingid=? and followerid=?");
$stmt -> bind_param("ss",$uid,$userid);
$stmt -> execute();
$x=0;
$stmt->bind_result($count);
while ($stmt -> fetch())
{ $x= $count;
echo $count;
}
if ($x >=1)
	{
		//Row exists show error
		echo "<p><h2>Already a follower click below to go back</h2></p><br>";
		
		echo"<a href='http://localhost/concerto/followuser.php'>Click here</a>";
		
	}	
	else{
		//calling procedure in database
		$stmt= $mysqli -> prepare("CALL user_follow(?,?)");
		$stmt -> bind_param("ss",$userid,$uid);
		$stmt -> execute();

		//redirecting to the page again
		header( 'Location: http://localhost/concerto/userprofilebasic.php' ) ;
		
		}
		
?>
</body>
</html>