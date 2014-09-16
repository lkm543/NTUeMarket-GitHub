<?php

session_start(); 

$currtimestr=date("Y-m-d h:i:s"); 

//產生驗證碼

srand((double)microtime()*1000000);

$no = md5(uniqid(rand()));

$ed = strlen($no)-8;

$rat = rand(0,$ed);

$chkno = strtoupper(substr("$no",$rat,8));

//產生信中快速認證連結(請自行修改)

//修改 mysql 資料

include_once("mysql_info.php");
$username=$_SESSION['MM_Username'];

mysqli_query ($link,"update member set license_code='$chkno' where username='$username'");

$sql = "select * from member where username = '$username'"; //在資料表中選擇所有欄位

$result = mysqli_query($link,$sql); // 執行SQL查詢

$row = mysqli_fetch_array($result);

$email=$row[email];


	$chklink = "<a href=http://collegebazaar.tw/member_license.php?email=$email&license_code=$chkno>http://collegebazaar.tw/member_license.php?email=$email&liences_code=$chkno</a>";

	//寄出認證信

	$inputime=date("Y-m-d H:i:s");

	require 'PHPMailer/PHPMailerAutoload.php';

	require_once("license_email.php");//信件內容格式付在後面

	require_once("PHPMailer/class.phpmailer.php"); //匯入PHPMailer類別 

	$mail= new PHPMailer(); //建立新物件 

	$mail->IsSMTP(); //設定使用SMTP方式寄信 

	$mail->SMTPAuth = true; //設定SMTP需要驗證 

	$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線 

	$mail->Host = "box990.bluehost.com"; //Gamil的SMTP主機 

	$mail->Port = 465; //Gamil的SMTP主機的SMTP埠位為465埠。 

	$mail->CharSet = "UTF-8"; //設定郵件編碼 



	$mail->Username = "customer_service@collegebazaar.tw"; //設定驗證帳號 

	$mail->Password = "cs@collegebazaar.tw"; //設定驗證密碼 



	$mail->From = "customer_service@collegebazaar.tw"; //設定寄件者信箱 

	$mail->FromName = "CollegeBazaar"; //設定寄件者姓名 



	$mail->Subject = "CollegeBazaar會員驗證信--$inputime"; //設定郵件標題 

	$mail->Body = "$message"; //設定郵件內容 

	$mail->IsHTML(true); //設定郵件內容為HTML 

	$mail->AddAddress($email, $username); //設定收件者郵件及名稱 

	$mail->Send();
	$notice="已寄出驗證信，請至註冊信箱收取";

	include_once("index.php");

?>