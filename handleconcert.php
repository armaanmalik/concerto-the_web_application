
<?php

//making connection
include "php/connectdb.php";

//starting session
session_start();
$userid = $_SESSION["uid"];

//storing the array variable in array1
$ARRAY1 = $_POST["array1"];

//Breaking the array into linear variables
$Container=explode(":",$ARRAY1[0]);


//catching the bandid from container;
$concertid=$Container[0];
$_SESSION["concertid"] = $concertid;

//checking if button rsvp is clicked
if(isset($_POST['rsvp']))
{
  

//calling procedure in database
$stmt= $mysqli -> prepare("CALL RSVP(?,?)");
$stmt -> bind_param("is",$concertid,$userid);
$stmt -> execute();
header( 'Location: http://localhost/concerto/userprofilebasic.php' ) ;


}



//checking if recommend button is clicked
if(isset($_POST['recommend']))
{
		//calling the "recommend" stored procedure in database.
		$stmt= $mysqli -> prepare("CALL user_recommend(?,?)");
		$stmt -> bind_param("si",$userid,$concertid);
		$stmt -> execute();
header( 'Location: http://localhost/concerto/userprofilebasic.php' ) ;
}


if(isset($_POST['rate']))
{

header( 'Location: http://localhost/concerto/rateconcert.php' ) ;
}



//redirecting to the page again
//header( 'Location: userprofilebasic.html' ) ;

if(isset($_POST['done']))
{		
		$user_id = $_SESSION["uid"];
		$concert_id = $_SESSION["concertid"] ;

		$review = $_POST["review"];
		$rating = $_POST["rating"];
		
		
		echo $user_id;
		echo $concert_id;
		echo $review;
		echo $rating;
		
		
		
		
		//calling the "give_rating" stored procedure in database.
		$stmt= $mysqli -> prepare("CALL give_rating(?,?,?,?)");
		$stmt -> bind_param("isis",$concert_id,$user_id,$rating,$review);
		$stmt -> execute();
//header( 'Location: http://localhost/concerto/userprofilebasic.php' ) ;




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
  background-image: url("images/slider/Band/a3.jpg");
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
 <a class="navbar-brand" href="userprofilebasic.php" >
		                	CONCERTO
		                </a>                    
		            </div>
		            <div class="collapse navbar-collapse">
		                <ul class="nav navbar-nav navbar-right">                 
		                    <li class="scroll active"><a href="userprofilebasic.php">Home</a></li>
							<li ><a href="editprofile.php">Edit Profile</a></li>
		                    <li class="scroll"><a href="searchband.php">Search Bands</a></li>                         
		                    <li class="scroll"><a href="choosegenre.php">Choose Genres</a></li>   
							<li class="scroll"><a href="findconcert.php">Find Concerts</a></li>
							<li class="scroll"><a href="followuser.php">Browse Users</a></li>
							<li class="scroll"><a href="postconcertuser.php">Post Concert</a></li>
							<li class="scroll"><a href="logout.php">Logout</a></li>														
		                </ul>
		            </div>
		        </div>
			</div>	
		</div>
		
	</header>
	
	
	<section id="home">	
	<div id="signup" "padding:40;">
								<h1><b>Give Rating Here</b></h1>
										<form action = "handleconcert.php" method = "post">
										<input type="label" name ="rating" placeholder="Rate on 0 to 5 scale" />
										<select name="cars">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										</select>
										<textarea name="review" placeholder="Please give some review about the concert" cols="54" rows="10" ></textarea>
										<b><input type="submit" value="Rate" /></b>
										
										<br>
									</form>
						</div>
								
    </section>
			
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
		</section>
	
	
	<section id="home">	
		
						<div id="signup" "padding:40;">
								<h1><b>Find Concerts Here</b></h1>
									<form action = "findconcert1.php" method="post">
										<input type="text" name="gname" placeholder="Find Concert by Genre" />
										<input type="text" name="vcity" placeholder="Find Concert by City" />
										<input type='Label'  value="From: " />
										<input type='date' name="ctime1" placeholder="Find Concert by Time" />
										<br>
										<input type='Label2'  value="To: " />
										<input type='date' name="ctime2" placeholder="Find Concert by Time" />
										<br><b><input type="submit" name = "search" value="Search" /></b>
										
										<br>
									</form>
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