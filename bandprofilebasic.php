<?php 
										
										// Start the session

											session_start();
											$uid=$_SESSION["uid"];
											
											//connecting with database
											include("php/connectdb.php"); 

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
  background-image: url("images/new/band3.jpg");
}
	</style>
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<header id="header" role="banner">		
		<div class="main-nav">
			<div class="container">
				<div class="header-top">
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
		
						<div id="music" >
								<h1><b>Music Played:</b></h1>
								<?php 
										//MUSIC BLOCK
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select gname,gsubcategory from plays where bid= ? ";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("s", $uid);
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($gname,$gsubcategory);
										//	$result = $orderStmt->get_result();
									
											echo "<table border='5' width=380px align='center'>";
											echo "<tr id ='x1'>";
												echo "<td>Genre </td>";
												echo "<td>SubGenre </td>";
												
												echo "</tr>";
											while ($orderStmt->fetch()) 
												{
												$gname=htmlspecialchars($gname);
												$gsubcategory=htmlspecialchars($gsubcategory);
												echo"<form name='form1' action = 'like.php' method='post'>";
												echo "<tr id ='x1'>";
												echo "<td>$gname</td>";
												echo "<td>$gsubcategory</td>";
												echo "<br>";
												echo "</tr>";
												}
										
										echo "</table>";
								?>

									
						</div>
						<div id= "band">
							<h1><b>Playing At Concerts</b></h1>
						<?php 
										//Concert BLOCK
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select c.cid,c.cname,b.bid,b.bname,v.vname,v.vcity,c.ctime,c.tktprice,c.tktlink,c.avail
															from concert c,venue v,band b 
															where c.bid=b.bid and c.vid=v.vid and (c.ctime > NOW()) and c.bid=?";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("s", $uid);
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($cid,$cname,$bid,$bname,$vname,$vcity,$ctime,$tktprice,$tktlink,$avail);
										//	$result = $orderStmt->get_result();
									
											echo "<table border='5' width=380px align=center>";
											echo "<tr id='x1'>";
												echo "<td>Concert</td>";
												echo "<td>Venue</td>";
												echo "<td>Concert Time</td>";
												echo "<td>Ticket Price</td>";
												echo "<td>Ticket Link</td>";
												echo "<td>Ticket Left</td>";
												
												echo "<br>";
												echo "</tr>";
											while ($orderStmt->fetch()) 
												{
												echo"<form name='form1' action = 'concert.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td>$cname</td>";
												echo "<td>$vcity</td>";
												echo "<td>$ctime</td>";
												echo "<td>$tktprice</td>";
												echo "<td>$tktlink</td>";
												echo "<td>$avail</td>";
												
												
												echo "</tr>";
												echo"</form>";
												}
																
												echo "</table>";
								?>
						</div>	
												
						<div id="concert">
						<h1><b>Fans:</b></h1>
								<?php 
										//Following Users
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select uid, uname from user where uid in(Select uid from fan where bid= ?) ";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("s", $uid);
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($followerid,$followername);
										//	$result = $orderStmt->get_result();
									
											echo "<table border='5' width=380px align=center>";
											echo "<tr id='x1'>";
												echo "<td>Fan Name</td>";
												echo "<br>";
												echo "</tr>";
											while ($orderStmt->fetch()) 
												{
												echo"<form name='form1' action = 'user.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td><a id='x1' href='userview.php?id=$followerid'>$followername</td>";
												echo "</tr>";
												echo "</form>";
												}
										
										echo "</table>";
								?>

						
						</div>
						<div id="recommend_music">
								<h1><b>New Concerts Posted by Other Bands:</b></h1>
								<?php 
										//Following User's Concert
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select c.cid,c.cname,b.bname,v.vname,v.vcity,c.ctime,c.tktprice,c.tktlink,c.avail
															from concert c,venue v,band b , user u
															where c.bid=b.bid and c.vid=v.vid and (c.ctime > NOW())and c.cposttime> u.lastaccess and u.uid=?  ";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt-> bind_param("s",$uid);
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($cid,$cname,$bname,$vname,$vcity,$ctime,$tktprice,$tktlink,$avail);
										//	$result = $orderStmt->get_result();
									
											echo "<table border='5' width=380px align=center>";
											echo "<tr id='x1'>";
												echo "<td>Concert</td>";
												echo "<td>Band</td>";
												echo "<td>Venue</td>";
												echo "<td>Concert Time</td>";
												echo "<td>Ticket Price</td>";
												echo "<td>Ticket Link</td>";
												echo "<td>Ticket Left</td>";
												
												echo "<br>";
												echo "</tr>";
											while ($orderStmt->fetch()) 
												{
												echo"<form name='form1' action = 'concert.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td>$cname</td>";
												echo "<td>$bname</td>";
												echo "<td>$vcity</td>";
												echo "<td>$ctime</td>";
												echo "<td>$tktprice</td>";
												echo "<td>$tktlink</td>";
												echo "<td>$avail</td>";
												echo "<br>";
												echo "</tr>";}
																
												echo "</table>";
								?>


						</div>
	</section>
	
	<footer id="f3">
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