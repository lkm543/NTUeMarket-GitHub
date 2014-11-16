<?php 

$username=$_POST['username'];

$password=$_POST['password'];

session_start(); 
$count=file("counter.txt") ;
//MySQL連線
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
$log_now=$currtimestr.'['.$ip.']使用者'.$username."使用傳統方式登入----瀏覽人次：".$count[0].'<br>';
mysqli_query ($link,"update Stastic set Log=CONCAT(Log,'$log_now'), Login=CONCAT(Login,'$log_now')");





$sql = "select * from member where username='$username'"; 
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);

$message="";

if($username != null && $password != null && $row[username] == $username && $row[password] == md5($password))

{

        //將帳號寫入session，方便驗證使用者身份

        $_SESSION['MM_UserID'] = $row[id];
        $_SESSION['MM_Username'] = $row[username];

header("Location: index.php");

}

else

{		$message="帳號或密碼錯誤，請重新輸入!";

        include_once('login.php');

}

?>