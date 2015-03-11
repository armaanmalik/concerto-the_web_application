<?php 
										
										// Start the session

											session_start();
											$uid=$_SESSION["uid"];
										 


	//connecting with database
	include("php/connectdb.php"); 
	
	
	//Preparing and executing the query in database
	$orderQuery = 	"Select gname,gsubcategory
					from genre";
	
	$orderStmt = $mysqli->prepare($orderQuery);
	
	if($orderStmt == false) 
	{
		trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}
	$orderStmt->execute();
	
	
	
	//Now trying to fetch the result of the query and displaying it on php page 
	$orderStmt->bind_result($gname,$gsubcategory);
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
	<link rel="shortcut icon" href="http://shapebootstrap.net/demo/html/evento/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://shapebootstrap.net/demo/html/evento/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://shapebootstrap.net/demo/html/evento/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://shapebootstrap.net/demo/html/evento/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://shapebootstrap.net/demo/html/evento/images/ico/apple-touch-icon-57-precomposed.png">
	<link rel="stylesheet/css" href="css/loginstyle.css">
	<style>
	
body
{
background-image: url("images/new/band3.jpg");}
	</style>
<script type="text/javascript" src="js/jquery.js"></script>
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
		                 <a class="navbar-brand" href="bandprofilebasic.php<?php echo "?Uid=$uid"?>" >
		                	CONCERTO
		                </a>                    
		            </div>
		            <div class="collapse navbar-collapse">
		                <ul class="nav navbar-nav navbar-right">                 
		                    <li class="scroll active"><a href="bandprofilebasic.php<?php echo "?Uid=$uid"?>">Home</a></li>
							<li class="scroll"><a href="editprofileband.php<?php echo "?Uid=$uid"?>">Edit Profile</a></li>                         
		                    <li class="scroll"><a href="postconcertband.php<?php echo "?Uid=$uid"?>">Post Concert</a></li>                         
		                    <li class="scroll"><a href="selectgenre.php<?php echo "?Uid=$uid"?>">Choose Genres</a></li>   
							<li class="scroll"><a href="logout.php<?php echo "?Uid=$uid"?>">Logout</a></li>	
							
		                </ul>
		            </div>
		        </div>
			</div>	
		</div>
		
	</header>
	
	<section >	
<div id="search3" >
			
				<?php
					
					echo "<table border='1' width=480px >";
					while ($orderStmt->fetch()) 
						{
						echo"<form name='form1' action = 'plays.php' method='post'>";
						echo "<tr>";
						echo "<td>$gname</td>";
						echo "<td>$gsubcategory</td>";
						echo "<td><input type=\"radio\" name=\"gname1[]\" value=\"$gname:$gsubcategory\"></input></td><td><input type='submit' value='Plays'></input></td>";
						echo "<br>";
						echo "</tr>";
						}
				
				echo "</table>";
				
				$orderStmt->close();
				echo "</div>";
	?>
	</section>
	
	<footer id="f1">
        <div class="container">
            <div class="text-center">
                <p> Copyright  &copy;2014 Concerto. All Rights Reserved. <br> Designed by Amanpreet Singh</p>              
            </div>
        </div>
	</footer>
    
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