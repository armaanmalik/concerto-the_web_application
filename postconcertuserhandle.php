<?php

//database connection
include "php/connectdb.php";

//starting session
session_start();
$userid = $_SESSION["uid"];
echo $userid;
print_r ($_POST);


//Getting variables
$cname=$_POST['cname'];
$bid=$_POST['bid'];
$ctime=$_POST['ctime'];
$vid=$_POST['vid'];
$tktprice=$_POST['tktprice'];
$tktlink=$_POST['tktlink'];


$stmt= $mysqli -> prepare("CALL user_post_concert(?,?,?,?,?,?,?)");
$stmt -> bind_param("sssiiss",$cname,$bid,$ctime,$vid,$tktprice,$tktlink,$userid);
$stmt -> execute(); 

header( 'Location: http://localhost/concerto/userprofilebasic.php' ) ;



?>