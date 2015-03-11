<?php 
										
										// Start the session

											session_start();
											$uid=$_SESSION["uid"];
											
											//connecting with database
											include("php/connectdb.php"); 
											
											//for maintaining session state
											/*if (($_SESSION['timeout'] + (10 * 60)) < time()) 
											{
												header( 'Location: http://localhost/concerto/logout.php' ) ;
											}
											else
											{
												$_SESSION['timeout'] = time();
											}
											*/
											
											
											
											
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
<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<header id="header" role="banner" >		
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
	
	<section >	
		
						<div id="music" >
								<h1><b>Music You Liked:</b></h1>
								<?php 
										//MUSIC BLOCK
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select gname,gsubcategory from likes where uid= ? ";
											
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
						<div id = "band">
								<h1><b> Bands You Follow</b></h1>		
										
								<?php 	
											//Preparing and executing the query in database
											$orderQuery = 	"Select b.bid,b.bname, p.gname from fan f, band b, plays p  where f.bid=b.bid and b.bid=p.bid and uid= ? ";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("s", $uid );
											
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();		
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($bid,$bname,$gname);
										//	$result = $orderStmt->get_result();
									
									echo "<table  border='5' width=380px align='center'>";
									echo "<tr id='x1'>";
										echo "<td>Band </td>";
										echo "<td>Genre Played</td>";
										echo"<br>";
										echo "</tr>";
									while ($orderStmt->fetch()) 
										{
										$bid=htmlspecialchars($bid);
										$bname=htmlspecialchars($bname);
										$gname=htmlspecialchars($gname);
										echo"<form name='form1' action = 'follow.php' method='post'>";
										echo "<tr id='x1'>";
										echo "<td><a id ='x1' href='bandview.php?id=$bid'>$bname</a></td>";
										echo "<td>$gname</td>";
										
										
										echo "</tr>";
										}
								
								echo "</table>";
								
								$orderStmt->close();
					?>
							</form>
						</div>	
						<div id= "concert">
							<h1><b>Going to Concerts:</b></h1>
						<?php 
										//Concert BLOCK
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select c.cid,c.cname,b.bname,v.vname,v.vcity,c.ctime,c.tktprice,c.tktlink,c.avail
															from concert c,venue v,band b, attend a 
															where c.bid=b.bid and c.vid=v.vid and a.cid=c.cid and (c.ctime > NOW()) and a.uid=?";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("s", $uid);
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($cid,$cname,$bname,$vname,$vcity,$ctime,$tktprice,$tktlink,$avail);
										//	$result = $orderStmt->get_result();
									
											echo "<table border='5' align='center' width=380px>";
											echo "<tr id='x1'>";
												echo "<td>Concert Name</td>";
												echo "<td> Band</td>";
												echo "<td> Venue</td>";
												echo "<td>Select</td>
												<td>Rate</td>
												<td>Recommend</td>";
												echo"<br>";
												echo "</tr>";
		
											while ($orderStmt->fetch()) 
												{
												$cname=htmlspecialchars($cname);
												$bname=htmlspecialchars($bname);
												$vcity=htmlspecialchars($vcity);
												echo"<form name='form1' action = 'handleconcert.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td>$cname</td>";
												echo "<td> $bname</td>";
												echo "<td> $vcity</td>";
												echo "<td><input type=\"radio\" name=\"array1[]\" value=\"$cid:$cname\"></input></td>
												<td><input type='submit' name = 'rate' value='RATE'></input></td>
												<td><input type='submit' name = 'recommend' value='RECOMMEND'></input></td>";
												
												echo "</tr>";}
																
												echo "</table>";
								?>
						</div>	
						
						<div id="following">
						<h1><b>People You Follow</b></h1>
						
						
								<?php 
										//Following Users
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select uid,uname from user where uid in (Select followingid from follow where followerid= ?) ";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("s", $uid);
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($followingid,$uname);
										//	$result = $orderStmt->get_result();
									
											echo "<table border='5'align='center' width=380px>";
											echo "<br>";
											while ($orderStmt->fetch()) 
												{$followingid=htmlspecialchars($followingid);
												$uname=htmlspecialchars($uname);
												echo"<form name='form1' action = 'user.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td><a id='x1' href='userview.php?id=$followingid'>$uname</a></td>";
												
												
												echo "</tr>";
												}
										
										echo "</table>";
								?>

						</form>
						</div>
						
						<div id="follower">
						<h1><b>Your Followers</b></h1>
								<?php 
										//Following Users
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select uid, uname from user where uid in( Select followerid from follow where followingid= ? )";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("s", $uid);
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($followerid, $uname);
										//	$result = $orderStmt->get_result();
									
											echo "<table border='5' align='center' width=380px>";
											
											echo "<br>";
											while ($orderStmt->fetch()) 
												{
												$followerid=htmlspecialchars($followerid);
												$uname=htmlspecialchars($uname);
												echo"<form name='form1' action = 'user.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td><a id='x1' href='userview.php?id=$followerid'>$uname</a></td>";
												
												echo "</tr>";
												}
										
										echo "</table>";
								?>

						
						</div>
						<div id="recommend">
						<h1><b>Concerts you recommnend</b></h1>
								<?php 
										//RECOMMEND by the user
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select c.cid,c.cname,b.bname,v.vname,v.vcity,c.ctime,c.tktprice,c.tktlink,c.avail
															from concert c,venue v,band b, recommend r
															where c.bid=b.bid and c.vid=v.vid and r.cid=c.cid and r.uid=?";
											
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("s", $uid);
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($cid,$cname,$bname,$vname,$vcity,$ctime,$tktprice,$tktlink,$avail);
										//	$result = $orderStmt->get_result();
									
											echo "<table border='5'align='center' width=380px>";
											echo "<tr id='x1'>";
												echo "<td>Concert Name</td>";
												echo "<td>Band</td>";
												echo "<td>Venue</td>";
												
												echo "</tr>";
											echo "<br>";
											while ($orderStmt->fetch()) 
												{
												$cname=htmlspecialchars($cname);
												$bname=htmlspecialchars($bname);
												$vcity=htmlspecialchars($vcity);
												echo"<form name='form1' action = 'recommend.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td>$cname</td>";
												echo "<td>$bname</td>";
												echo "<td>$vcity</td>";
												
												echo "</tr>";
												}
										
										echo "</table>";
								?>

						
						</div>
						<div id= "recommend_music">
								<h1><b>Music You May Like</b></h1>
								<?php 
										//Following Users
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select gname,gsubcategory from likes 
																where uid in (Select followingid from follow where followerid= ?)
																and gname not in ( select gname from likes where uid = ?)";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("ss", $uid, $uid );
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											$orderStmt->bind_result($gname,$gsubcategory);
										//	$result = $orderStmt->get_result();
									
											echo "<table border='5' align='center' width=380px>";
											echo "<tr id='x1'>";
												echo "<td>Genre</td>";
												echo "<td>SubGenre </td>";
												echo "<td>Select</td><td>Like Button</td>";
												echo "<br>";
												echo "</tr>";
											while ($orderStmt->fetch()) 
												{
												$gname=htmlspecialchars($gname);
												$gsubcategory=htmlspecialchars($gsubcategory);
												echo"<form name='form1' action = 'like.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td>$gname</td>";
												echo "<td>$gsubcategory</td>";
												echo "<td><input type=\"radio\" name=\"gname1[]\" value=\"$gname:$gsubcategory\"></input></td><td><input type='submit' value='Like'></input></td>";
												
												echo "</tr>";
												}
										
										echo "</table>";
								?>

						</div>
						<div id= "recommend_band">
								<h1><b>Bands You may be interested </b></h1>
								<?php 
										//Following User's Bands
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select distinct b.bid,b.bname from fan f, band b, plays p  where f.bid=b.bid and b.bid=p.bid 
											and f.uid in (Select followingid 	from follow where followerid= ?)
											and f.bid not in ( select bid from fan where uid = ?)";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("ss", $uid, $uid );
											if($orderStmt == false) 
											{
												trigger_error('Wrong SQL: ' . $orderQuery . ' Error: ' . $mysqli->error, E_USER_ERROR);
											}
											$orderStmt->execute();
											
											
											//Now trying to fetch the result of the query and displaying it on php page 
											$orderStmt->bind_result($bid,$bname);
										//	$result = $orderStmt->get_result();
									
									echo "<table border='5'  align='center' width=380px >";
									echo "<tr id ='x1'>";
										echo "<td>Band</a></td>";
										echo "<td>Select</td>";
										echo "<td>Become Fan</td>";
										
										echo "</tr>";
									while ($orderStmt->fetch()) 
										{
										echo"<form name='form1' action = 'follow.php' method='post'>";
										echo "<tr id ='x1'>";
										echo "<td><a id='x1' href='bandview.php?id=$bid'>$bname</a></td>";
										//echo "<td>$gname</td>";
										echo "<td><input type=\"radio\" name=\"bname[]\" value=\"$bid:$bname\"></input></td><td><input type='submit' value='Click Here'></input></td>";
										echo "<br>";
										echo "</tr>";
										}
								
								echo "</table>";
								?>

						</div>
						<div id= "recommend_concert">
								<h1><b>Recommended Concerts</b></h1>
								<?php 
										//Following User's Concert
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select c.cid,c.cname,b.bname,v.vname,v.vcity,c.ctime,c.tktprice,c.tktlink,c.avail
															from concert c,venue v,band b, attend a 
															where c.bid=b.bid and c.vid=v.vid and a.cid=c.cid and (c.ctime > NOW()) and a.uid  in (Select followingid 	from follow where followerid= ?)
															and a.cid not in ( select cid from attend where uid = ?)
															Union
															Select c.cid,c.cname,b.bname,v.vname,v.vcity,c.ctime,c.tktprice,c.tktlink,c.avail
															from concert c,venue v,band b, recommend r 
															where c.bid=b.bid and c.vid=v.vid and r.cid=c.cid and (c.ctime > NOW()) and r.uid  in (Select followingid 	from follow where followerid= ?)
															and r.cid not in ( select cid from attend where uid = ?)
															";
											
											$orderStmt = $mysqli->prepare($orderQuery);						
											$orderStmt->bind_param("ssss", $uid, $uid, $uid, $uid );
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
												echo "<td>Select</td>
												<td>Rate</td>
												<td>Recommend</td>";
												echo "<br>";
												echo "</tr>";
											while ($orderStmt->fetch()) 
												{
												echo"<form name='form1' action = 'handleconcert.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td>$cname</td>";
												echo "<td>$bname</td>";
												echo "<td>$vcity</td>";
												echo "<td><input type=\"radio\" name=\"array1[]\" value=\"$cid:$cname\"></input></td>
												<td><input type='submit' name = 'rate' value='RATE'></input></td>
												<td><input type='submit' name = 'recommend' value='RECOMMEND'></input></td>";
												
												echo "</tr>";}
																
												echo "</table>";
								?>

						</div>
						<div id="new_concert">
								<h1><b>New Concerts</b></h1>
								<?php 
										//Following User's Concert
										
											//Preparing and executing the query in database
											$orderQuery = 	"Select c.cid,c.cname,b.bname,v.vname,v.vcity,c.ctime,c.tktprice,c.tktlink,c.avail
															from concert c,venue v,band b , user u
															where c.bid=b.bid and c.vid=v.vid and (c.ctime > NOW())and c.cposttime> u.lastaccess and u.uid=? ";
											
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
												echo "<td>Select</td>
												<td>Rsvp</td>
												<td>Rate</td>
												<td>Recommend</td>";
												echo "<br>";
												echo "</tr>";
											while ($orderStmt->fetch()) 
												{
												echo"<form name='form1' action = 'handleconcert.php' method='post'>";
												echo "<tr id='x1'>";
												echo "<td>$cname</td>";
												echo "<td>Played by $bname</td>";
												echo "<td>At location $vcity</td>";
												echo "<td><input type=\"radio\" name=\"array1[]\" value=\"$cid:$cname\"></input></td>
												<td><input type='submit' name = 'rsvp' value='RSVP'></input></td>
												<td><input type='submit' name = 'rate' value='RATE'></input></td>
												<td><input type='submit' name = 'recommend' value='RECOMMEND'></input></td>";
												echo "</tr>";
												echo "</form>";
												}
																
												echo "</table>";
								?>


						</div>
	</section>
	
	<footer id="f2">
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