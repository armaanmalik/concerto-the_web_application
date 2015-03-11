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




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Concerto</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">	
	<link href="css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="css/loginstyle.css" media="screen" type="text/css" />
	<link rel="stylesheet/css" href="css/loginstyle.css">
	<style>
	
body
{
  background-image: url("images/new/user2.jpg");
}
	</style>
</head>
<body>
	<header id="header" role="banner">		
		<div class="main-nav">
			<div class="container">
				<div class="header-top">
					<div class="pull-right social-icons">
						<a href="Google.com"><i class="fa fa-twitter"></i></a>
						<a href="index.html#"><i class="fa fa-facebook"></i></a>
						<a href="index.html#"><i class="fa fa-google-plus"></i></a>
						<a href="index.html#"><i class="fa fa-youtube"></i></a>
					</div>
				</div>
				<div class="row">	        		
		            <div class="navbar-header">
		                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		                    <span class="sr-only">Toggle navigation</span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                    <span class="icon-bar"></span>
		                </button>
 <a class="navbar-brand" href="userprofilebasic.php<?php echo "?Uid=$uid"?>" >
		                	CONCERTO
		                </a>                    
		            </div>
		            <div class="collapse navbar-collapse">
		                <ul class="nav navbar-nav navbar-right">                 
		                    <li class="scroll active"><a href="userprofilebasic.php<?php echo "?Uid=$uid"?>">Home</a></li>
							<li ><a href="editprofile.php<?php echo "?Uid=$uid"?>">Edit Profile</a></li>
		                    <li class="scroll"><a href="searchband.php<?php echo "?Uid=$uid"?>">Search Bands</a></li>                         
		                    <li class="scroll"><a href="choosegenre.php<?php echo "?Uid=$uid"?>">Choose Genres</a></li>   
							<li class="scroll"><a href="findconcert.php<?php echo "?Uid=$uid"?>">Find Concerts</a></li>
							<li class="scroll"><a href="followuser.php<?php echo "?Uid=$uid"?>">Browse Users</a></li>
							<li class="scroll"><a href="postconcertuser.php<?php echo "?Uid=$uid"?>">Post Concert</a></li>
							<li class="scroll"><a href="logout.php<?php echo "?Uid=$uid"?>">Logout</a></li>									                </ul>
		            </div>
		        </div>
			</div>	
		</div>
		
	</header>
	

	<div id="search4" >
			
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
			</form>
		
	</div>
	<footer id="f4" >
        
            <div class="text-center">
                <p> Copyright  &copy;2014 Concerto. All Rights Reserved. <br> Designed by Amanpreet Singh</p>                
            </div>
        
	</footer>

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../../maps.google.com/maps/api/js.JS"></script>
  	<script type="text/javascript" src="js/gmaps.js"></script>
	<script type="text/javascript" src="js/smoothscroll.js"></script>
    <script type="text/javascript" src="js/jquery.parallax.js"></script>
    <script type="text/javascript" src="js/coundown-timer.js"></script>
    <script type="text/javascript" src="js/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="js/jquery.nav.js"></script>
    <script type="text/javascript" src="js/main.js"></script> 
</body>	
</html>	