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

//for maintaining session state
$_SESSION['timeout'] = time();

$userid = $_POST['uid'];
$_SESSION['uid']=$userid;
//storing the array variable in uname
$pass = $_POST['pass'];
//echo $userid;
//echo $pass;
$stmt= $mysqli -> prepare("Select utype from user where uid=? and password=?");
$stmt -> bind_param("ss",$userid,$pass);
$stmt -> execute();
$stmt->bind_result($utype);
//echo "1";
$x=0;
	echo "<p><h1>Not a valid login please click below to enter again..</h1></p><br>";
		
		echo"<h2><a href='http://localhost/concerto/index.html'>Click here to return to login page</a></h2>";

while ($stmt -> fetch())
{echo $utype;
echo "3";
if ($stmt == null)
	{echo "2";
		$x=1;
		//Row exists show error
		
	}	
	else if ($utype== "normal")
		{
		echo $utype;
		header( 'Location:http://localhost/concerto/userprofilebasic.php?userid='.$userid) ;
		}
	else
{	
		header( 'Location:http://localhost/concerto/bandprofilebasic.php?userid='.$userid) ;	 }
	}

if ($x==1)
{
	echo "<p><h1>Not a valid login please click below to enter again..</h1></p><br>";
		
		echo"<h2><a href='http://localhost/concerto/index.html'>Click here to return to login page</a></h2>";
	

}	
?>
</body>
</html>