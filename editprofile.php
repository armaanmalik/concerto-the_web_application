<?php
	//storing the session variable
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
							<li class="scroll"><a href="logout.php<?php echo "?Uid=$uid"?>">Logout</a></li>							
		                </ul>
		            </div>
		        </div>
			</div>	
		</div>
		
	</header>
	
	<section id>	
		
						<div id="signup" "padding:40;">
								<h1><b>Edit Your Profile</b></h1>
										<form action="editprofile1.php" method="post">
										<input type="text" name="fullname" placeholder="Edit your username here"><input type='submit' name = 'updatename' value='update'></input><br>
										</form>
										
										<form action="editprofile1.php" method="post">
										<input type="number" name="birthyear" placeholder="Edit your birthyear here" /><input type='submit' name = 'updatebirthyear' value='update'></input><br/>
										</form>
										
										<form action="editprofile1.php" method="post">
										<input type="email" name="email" placeholder="Edit your email address here" /><input type='submit' name = 'updateemail' value='update'></input><br/>
										</form>
										
										<form action="editprofile1.php" method="post">
										<input type="text" name="ucity" placeholder="Edit your city here" /><input type='submit' name = 'updatecity' value='update'></input><br/>
										</form>
										
										<form action="editprofile1.php" method="post">
										<input type="password" name="pass" placeholder="Edit your password here" /><input type='submit' name = 'updatepass' value='update'></input><br/>
										</form>
										
										<form action="userprofilebasic.php">
										<b><input type='submit' name = 'done' value='Done Editing'></input><br/></b>
										</form>
										<br>
									
										<br>
									</form>
						</div>
								
    </section>
	
	<footer id="f5">
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