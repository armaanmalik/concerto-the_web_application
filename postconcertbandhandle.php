<?php

//database connection
include "php/connectdb.php";

//starting session
session_start();
$userid = $_SESSION["uid"];

print_r ($_POST);


//Getting variables
$cname=$_POST['cname'];
$ctime=$_POST['ctime'];
$vid=$_POST['vid'];
$tktprice=$_POST['tktprice'];
$tktlink=$_POST['tktlink'];


$stmt= $mysqli -> prepare("CALL band_post_concert(?,?,?,?,?,?)");
$stmt -> bind_param("sssiis",$cname,$userid,$ctime,$vid,$tktprice,$tktlink);
$stmt -> execute(); 


header( 'Location: http://localhost/concerto/bandprofilebasic.php' ) ;



?>