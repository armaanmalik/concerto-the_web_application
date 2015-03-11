<?php
// Start the session

session_start();

	//connecting with database
	include("php/connectdb.php"); 
	
	
	//catching the variables
	$gname = $_POST["gname"];
	$vcity = $_POST["vcity"];
	$ctime1 = $_POST["ctime1"];
	$ctime2 = $_POST["ctime2"];
	
	$cx1=$ctime1;
	$cx2=$ctime2;

	
	if ($ctime1!= null && $ctime2 == null)
		{$cx2= $ctime1;
		$cx1= $ctime1;	}
		
	if ($ctime1= null && $ctime2 != null)
		{$cx2= $ctime2;
		 $cx1= $ctime2;		}
		
	if ($gname =="" && $vcity=="" && $ctime1=="")
		{	
			echo "1";
	//Preparing and executing the query in database
	$orderQuery = 	"Select cid,cname,bname,vname,vcity,ctime,tktprice,tktlink,avail
					from concert c,venue v,band b
					where c.bid=b.bid and c.vid=v.vid and (c.ctime > NOW())";
	
	$orderStmt = $mysqli->prepare($orderQuery);
				
		}	
	
	
	if ($gname !="" && $vcity=="" && $cx1=="")
		{	
				//Preparing and executing the query in database
				$orderQuery = 	"Select distinct cid, cname,bname,vname,vcity,ctime,tktprice,tktlink,avail
								from concert c,venue v,band b, plays p
								where c.bid=b.bid and c.vid=v.vid and p.bid=b.bid and(c.ctime > NOW())and p.gname like ?";
				
				$keyword="%".$gname."%";
				$orderStmt = $mysqli->prepare($orderQuery);
				$orderStmt->bind_param("s", $keyword);
				
	
		}	
	if ($gname =="" && $vcity!="" && $cx1=="")
		{	
			//Preparing and executing the query in database
				$orderQuery = 	"Select distinct cid,cname,bname,vname,vcity,ctime,tktprice,tktlink,avail
								from concert c,venue v,band b, plays p
								where c.bid=b.bid and c.vid=v.vid and p.bid=b.bid and(c.ctime > NOW())and v.vcity like ?";
				
				$keyword="%".$vcity."%";
				$orderStmt = $mysqli->prepare($orderQuery);
				$orderStmt->bind_param("s", $keyword);
				
		}	
	if ($gname =="" && $vcity=="" && $cx1 !="")
		{	
			//Preparing and executing the query in database
				$orderQuery = 	"Select distinct cid,cname,bname,vname,vcity,ctime,tktprice,tktlink,avail
								from concert c , band b, plays p, genre g, venue v 
								where c.bid=b.bid and b.bid = p.bid and p.gname = g.gname and c.vid=v.vid and ctime >= ? and ctime<= ? ";
				
				
				$orderStmt = $mysqli->prepare($orderQuery);
				$orderStmt->bind_param("ss", $cx1, $cx2);
				
		
		}	
	if ($gname !="" && $vcity!="" && $cx1=="")
		{	
			//Preparing and executing the query in database
				$orderQuery = 	"Select distinct cid,cname,bname,vname,vcity,ctime,tktprice,tktlink,avail
								from concert c,venue v,band b, plays p
								where c.bid=b.bid and c.vid=v.vid and p.bid=b.bid and(c.ctime > NOW())and p.gname like ? and v.vcity like ?";
				
				$keyword2="%".$vcity."%";
				$keyword1="%".$gname."%";
				$orderStmt = $mysqli->prepare($orderQuery);
				$orderStmt->bind_param("ss", $keyword1, $keyword2);
	
		}	
	if ($gname =="" && $vcity!="" && $cx1!="")
		{	
		//Preparing and executing the query in database
				$orderQuery = 	"Select distinct cid,cname,bname,vname,vcity,ctime,tktprice,tktlink,avail
								from concert c , band b, plays p, genre g, venue v 
								where c.bid=b.bid and b.bid = p.bid and p.gname = g.gname and c.vid=v.vid and v.vcity like ? and ctime >= ? and ctime<= ? ";
				
				$keyword2="%".$vcity."%";
				$orderStmt = $mysqli->prepare($orderQuery);
				$orderStmt->bind_param("sss", $keyword2,$cx1, $cx2);
	
		}	
	if ($gname !="" && $vcity=="" && $cx1!="")
		{	
		//Preparing and executing the query in database
				$orderQuery = 	"Select distinct cid,cname,bname,vname,vcity,ctime,tktprice,tktlink,avail
								from concert c , band b, plays p, genre g, venue v 
								where c.bid=b.bid and b.bid = p.bid and p.gname = g.gname and c.vid=v.vid and p.gname like ? and ctime >= ? and ctime<= ? ";
				
				$keyword2="%".$gname."%";
				$orderStmt = $mysqli->prepare($orderQuery);
				$orderStmt->bind_param("sss", $keyword2,$cx1, $cx2);
	
	
		}	
	
	if ($gname !="" && $vcity!="" && $cx1!="")
		{	
		//Preparing and executing the query in database
				$orderQuery = 	"Select distinct cid,cname,bname,vname,vcity,ctime,tktprice,tktlink,avail
								from concert c , band b, plays p, genre g, venue v 
								where c.bid=b.bid and b.bid = p.bid and p.gname = g.gname and c.vid=v.vid and p.gname like ? and v.vcity like ? and ctime >= ? and ctime<= ? ";
				$keyword1="%".$gname."%";
				$keyword2="%".$vcity."%";
				$orderStmt = $mysqli->prepare($orderQuery);
				$orderStmt->bind_param("ssss",$keyword1,$keyword2,$cx1, $cx2);
	
	
		}	
	

	// Checking for error and then Executing the statement
	if($orderStmt == false) 
	{
		trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
	}
	$orderStmt->execute();
	
	
	
	//Now trying to fetch the result of the query and displaying it on php page 
	$orderStmt->bind_result($cid,$cname,$bname,$vname,$vcity,$ctime,$tktprice,$tktlink,$avail);
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
	<div id="search" >
			
				<?php
					
					echo "<table border='10' width=600px >";
					while ($orderStmt->fetch()) 
						{
						echo"<form name='form1' action = 'handleconcert.php' method='post'>";
						echo "<tr>";
						echo "<td>$cname</td>";     
						echo "<td>$bname</td>";
						echo "<td>$vname</td>";
						echo "<td>$vcity</td>";
						echo "<td>$ctime</td>";
						echo "<td>$tktprice</td>";
						echo "<td>$tktlink</td>";
						echo "<td>$avail</td>";
						echo "<td><input type=\"radio\" name=\"array1[]\" value=\"$cid:$cname\"></input></td>
						<td><input type='submit' name = 'rsvp' value='RSVP'></input></td>
						<td><input type='submit' name = 'rate' value='RATE'></input></td>
						<td><input type='submit' name = 'recommend' value='RECOMMEND'></input></td>";
						echo "<br>";
						echo "</tr>";
						}
				
				echo "</table>";
				 echo"<h2><a href='http://localhost/concerto/findconcert.php'> Search Again</a></h2>";
				$orderStmt->close();
				echo "</div>";
	?>
			</form>
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