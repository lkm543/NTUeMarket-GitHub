<?php 
$username=$_POST['username'];
$password=$_POST['password'];
session_start(); 
//MySQL連線
include_once("mysql_info.php");
$sql = "select * from member where username='$username'"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
$message="";
if($username != null && $password != null && $row['username'] == $username && $row['password'] == md5($password))
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['MM_Username'] = $username;
echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
}
else
{		$message="帳號或密碼錯誤，請重新輸入!";
        include_once('login.php');
}
?>