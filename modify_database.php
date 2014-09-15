<?php
// mySQL資料庫
session_start(); 
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$username=$_SESSION['MM_Username'];
$method=$_POST['method'];
$phone=$_POST['phone'];
$nickname=$_POST['nickname'];
$message=$_POST['message'];
$contact_email=$_POST['contact_email'];
//密碼未改
mysqli_query ($link,"update member set phone='$phone', nickname='$nickname', method='$method', contact_email='$contact_email', message='$message' where username='$username'");
//密碼修改
$password1=$_POST['password1'];
$password2=$_POST['password2'];
if ($password1!=null&$password1==$password2)
{
	mysqli_query ($link,"update member set password=$password1 where username=$username");
	$notice="密碼修改成功";
	include_once("modify.php");
}
elseif($password1!=$password2){
$notice="兩次輸入的密碼不同，請重新輸入";
include_once("modify.php");
} 
else{
	$notice="會員資料修改成功!";
include_once("modify.php");
}?>  