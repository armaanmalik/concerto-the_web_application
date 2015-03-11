<?php
	//making connection
	include "php/connectdb.php";

	//starting session
	session_start();
	$uid=$_SESSION["uid"];
	//for maintaining session state
	if (($_SESSION['timeout'] + (10 * 60)) < time()) 
	{
		header( 'Location: http://localhost/concerto/logout.php' ) ;
	}
	else
	{
		$_SESSION['timeout'] = time();
	}
	
	

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
		                </button><a class="navbar-brand" href="userprofilebasic.php<?php echo "?Uid=$uid"?>" >
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
							<li class="scroll"><a href="logout.php<?php echo "?Uid=$uid"?>">Logout</a></li>							
		                </ul>
		            </div>
		        </div>
			</div>	
		</div>
		
	</header>
	
	<section >	
		
						<div id="signup" >
								<h1><b>Post Concert Here</b></h1>
										<form action = "postconcertuserhandle.php" method = "post">
										<input type="text" name ="cname" placeholder="Enter Concert Name" required="required"/>
						
										<?php
										
										
										//executing the statements to fetch bname,bid,vname,vid into drop down list
										$stmt= $mysqli -> prepare("Select bid,bname from band");
										$stmt -> execute();
										$stmt->bind_result($bid,$bname);
										echo "<br>";
										echo "<label for='bid1'>Select Band Name</label>";
										echo "<select name = 'bid' id='bid1'required='required'>";
										while($stmt -> fetch())
										{
											echo "<option value = '$bid'> $bname </option>";
										
										}
										echo "</select>";
										?>
										
										<input type="datetime-local" name ="ctime" placeholder="Enter Concert Time"  required="required"/>
										
										<?php
											
										//executing the statements to fetch vid,vname into drop down list
										$stmt2= $mysqli -> prepare("Select vid,vname from venue");
										$stmt2 -> execute();
										$stmt2->bind_result($vid,$vname);
										
										echo "<br>";
										echo "<label for='vid1'>Select Venue</label>";
										echo "<select name = 'vid' id='vid1'required='required' >";
										while($stmt2 -> fetch())
										{
											echo "<option value = '$vid'> $vname </option>";
										
										}
										echo "</select>";
										?>
										
										<input type="text" name ="tktprice" placeholder="Enter Ticket Price in Dollars $" required="required"/>
										<input type="text" name ="tktlink" placeholder="Enter Ticket Link" required="required"/>
										<b><input type="submit" value="POST" /></b>
										
										<br>
									</form>
						</div>
								
    </section>
	
	<footer id="f3">
        <div class="container">
            <div class="text-center">
                <p> Copyright  &copy;2014 Concerto. All Rights Reserved. <br> Designed by Amanpreet Singh</p>              
            </div>
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