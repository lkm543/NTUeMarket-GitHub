<?php 
$username=$_POST['username'];
$password=$_POST['password'];
session_start(); 
//MySQL連線
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
mysqli_select_db ($link,"a4904409_goods");  
$sql = "select * from member where username='$username'"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
$message="";
if($username != null && $password != null && $row['username'] == $username && $row['password'] == $password)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['MM_Username'] = $username;
		include_once('modify.php');
}
else
{		$message="帳號密碼錯誤，請重新輸入!";
        include_once('login.php');
}
?>