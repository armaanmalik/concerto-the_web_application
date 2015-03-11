<?php
// Start the session

session_start();
$uid=$_SESSION["uid"];
	//connecting with database
	include("php/connectdb.php"); 
	
	//for maintaining session state
	if (($_SESSION['timeout'] + (2 * 60)) < time()) 
	{
		header( 'Location: http://localhost/concerto/logout.php' ) ;
	}
	else
	{
		$_SESSION['timeout'] = time();
	}
	
	
	
	//Preparing and executing the query in database
	$orderQuery = 	"Select uid, uname, ucity, email
					from user where utype='normal'";
	
	$orderStmt = $mysqli->prepare($orderQuery);
	
	if($orderStmt == false) 
	{
		trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}
	$orderStmt->execute();
	
	
	
	//Now trying to fetch the result of the query and displaying it on php page 
	$orderStmt->bind_result($uid,$uname, $ucity, $email);
//	$result = $orderStmt->get_result();

?>








<?php
					
					echo "<table border='15' width=1080px >";
					echo "<tr id='x2'>";
						echo "<td>UserName</a></td>";
						echo "<td>City</td>";
						echo "<td>EmailAddress</td>";
						echo "<td>Select</td><td>Click Below</td>";
						echo "<br>";
						echo "</tr>";
					while ($orderStmt->fetch()) 
						{
						$ucity=htmlspecialchars($ucity);
						$email=htmlspecialchars($email);
						$uname=htmlspecialchars($uname);
						
						echo"<form name='form1' action = 'php/followuser1.php' method='post'>";
						echo "<tr id='x1'>";
						echo "<td><a href='userview.php?id=$uid'>$uname</a></td>";
						echo "<td>$ucity</td>";
						echo "<td>$email</td>";
						echo "<td><input type=\"radio\" name=\"gname1[]\" value=\"$uid:$uname\"></input></td><td><input type='submit' value='Follow'></input></td>";
						echo "<br>";
						echo "</tr>";
						}
				
				echo "</table>";
				
				$orderStmt->close();
				
	?>