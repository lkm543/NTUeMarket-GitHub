<?php

// mySQL資料庫
session_start(); 
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];

//產生驗證碼
srand((double)microtime()*1000000);
$no = md5(uniqid(rand()));
$ed = strlen($no)-8;
$rat = rand(0,$ed);
$chkno = strtoupper(substr("$no",$rat,8));

//密碼加密
$encrypt_pass = md5($_POST['password']);

//MySQL連接
$sucess = mysqli_query ($link,"insert into member(username,license_code,email,password,date) values('$username','$chkno','$email','$encrypt_pass','$currtimestr')");
//$_SESSION['MM_Username']=$username;

if($sucess){
	//產生信中快速認證連結(請自行修改)
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
	if($mail->Send()){
		?><script type="text/javascript" language="javascript">
		alert("感謝您! 驗證信已寄發到註冊的Email地址：\n <?php echo $email; ?> \n請檢查是否有收到驗證信並啟用帳號。");
		</script><?php
	}else{
		?><script type="text/javascript" language="javascript">
		alert("驗證信傳送失敗，請稍後再試!");
		</script><?php
	}
}
?>

<?php
$_SESSION['MM_Username'] = $username;
echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
?>  