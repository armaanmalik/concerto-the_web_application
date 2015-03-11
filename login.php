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
		                <a class="navbar-brand" href="index.html" >
		                	CONCERTO
		                </a>                    
		            </div>
		            <div class="collapse navbar-collapse">
		                <ul class="nav navbar-nav navbar-right">                 
		                    <li class="scroll active"><a href="index.html#home">Home</a></li>
		                    <li class="scroll"><a href="index.html#explore">About US</a></li>                         
		                    <li class="scroll"><a href="index.html#home">Login</a></li>   
							<li class="scroll"><a href="index.html#contact">Gallery</a></li>
							<li class="scroll"><a href="index.html#contact">Contact</a></li>   
							
		                </ul>
		            </div>
		        </div>
			</div>	
		</div>
		
	</header>
	<section id="home">	
		<div id="main-slider" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#main-slider" data-slide-to="0" class="active"></li>
				<li data-target="#main-slider" data-slide-to="1"></li>
				<li data-target="#main-slider" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="item active">
					<img class="img-responsive" src="images/slider/Band/a1.jpg" alt="slider">						
					<div class="carousel-caption">
						<div id="loginbox">

						<?php

							//making connection
							include "php/connectdb.php";		

							//starting session	
							session_start();
								$userid = $_POST['uid'];
								$_SESSION['uid']=$userid;
								//storing the array variable in uname
								$pass = $_POST['pass'];
								$utype="adasd";
								$stmt= $mysqli -> prepare("Select utype from user where uid=? and password=?");
								$stmt -> bind_param("ss",$userid,$pass);
								$stmt -> execute();
								$stmt->bind_result($utype);
								echo "1";
								echo $utype;
								while ($stmt -> fetch())
								{
									echo "2";
								if ($utype == null)
									{
										echo "3";
										//Row exists show error
										echo "<p><h1>Not a valid login please click below to enter again..</h1></p><br>";
										
										echo"<h2><a href='http://localhost/concerto/index.html'>Click here to return to login page</a></h2>";
										
									}	
									else if ($utype== "normal")
										{
										//redirecting to the user page again
										//header( 'Location: http://localhost/concerto/userprofilebasic.html') ;
										}
									else	
										{//header( 'Location: http://localhost/concerto/bandprofilebasic.html') ;	
										}
									}									
									echo "4";
								?>
								
</div>
					</div>
				</div>
				
	
				</div>
				
			</div>
    	
    </section>
	
	<footer id="footer">
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