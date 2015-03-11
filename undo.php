<?php

//making connection
include "php/connectdb.php";

//starting session
session_start();
$userid = $_SESSION["uid"];




if (isset($_POST['unlike']))
{
//storing the array variable in Gname
$Gname = $_POST["gname1"];

//Breaking the array into linear variables
$Container=explode(":",$Gname[0]);


//catching the genre from container;
$genrename=$Container[0];
$genresubcategory=$Container[1];


//calling procedure in database
$stmt= $mysqli -> prepare("CALL user_unlikes(?,?,?)");
$stmt -> bind_param("sss",$userid,$genrename,$genresubcategory);
$stmt -> execute();

//redirecting to the page again
header( 'Location: userprofilebasic.php' ) ;
}





if (isset($_POST['unfan']))
{
//storing the array variable in Bname
$Bname = $_POST["bname"];

//Breaking the array into linear variables
$Container=explode(":",$Bname[0]);


//catching the bandid from container;
$bid=$Container[0];


//calling procedure in database
$stmt= $mysqli -> prepare("CALL user_unfan(?,?)");
$stmt -> bind_param("ss",$userid,$bid);
$stmt -> execute();

//redirecting to the page again
header( 'Location: userprofilebasic.php' ) ;
}







if (isset($_POST['unfollow1']))
{

//storing the array variable in uname
$username = $_POST["username"];

//Breaking the array into linear variables
$Container=explode(":",$username[0]);

//catching the uid from container;
$fid=$Container[0];


//calling procedure in database
$stmt= $mysqli -> prepare("CALL user_unfollow(?,?)");
$stmt -> bind_param("ss",$userid,$fid);
$stmt -> execute();

//redirecting to the page again
header( 'Location: userprofilebasic.php' ) ;
}




	 
?>