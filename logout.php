<?php 
session_start(); 
$username=$_SESSION['MM_Username'];
//後臺記錄
$currtimestr=date("Y-m-d H:i:s");
//取得使用者ip
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
   $ip = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
   $ip= $_SERVER['REMOTE_ADDR'];
}

include_once("mysql_info.php");
$log_now=$currtimestr.'['.$ip.']使用者'.$username."登出".'<br>';
mysqli_query ($link,"update Stastic set Log=CONCAT(Log,'$log_now'), Login=CONCAT(Login,'$log_now')");

session_destroy(); 
header("Location: index.php");?>
