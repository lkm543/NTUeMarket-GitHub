<?php
// mySQL資料庫
session_start(); 
$currtimestr=date("Y-m-d h:i:s"); 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
//mysqli_query($link, "SET collation_connection ='utf8_general_ci'");
//帳戶資料
$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
//產生驗證碼
srand((double)microtime()*1000000);
$no = md5(uniqid(rand()));
$ed = strlen($no)-8;
$rat = rand(0,$ed);
$chkno = strtoupper(substr("$no",$rat,8));
//MySQL連接
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"a4904409_goods"); 
mysqli_query($link,"SET NAMES 'utf8'");
//檢查帳號重複
$search_username="select * from member where username='$username'";
$search_email="select * from member where email='$email'";
$result_username = mysqli_query($link,$search_username);
$result_email = mysqli_query($link,$search_email);
if (mysqli_num_rows($result_username) == 0 && mysqli_num_rows($result_email)== 0)
{
mysqli_query ($link,"insert into member(username,license_code,email,password,date) values('$username','$chkno','$email','$password','$currtimestr')");
//$_SESSION['MM_Username']=$username;

//產生信中快速認證連結(請自行修改)
$chklink = "<a href=http://www.b98502030.uphero.com/member_license.php?email=$email&license_code=$chkno>http://www.b98502030.uphero.com/member_license.php?email=$email&liences_code=$chkno</a>";
//寄出認證信
$inputime=date("Y-m-d H:i:s");
require_once("license_email.php");//信件內容格式付在後面
include_once("class.phpmailer.php"); //匯入PHPMailer類別 
$mail= new PHPMailer(); //建立新物件 
$mail->IsSMTP(); //設定使用SMTP方式寄信 
$mail->SMTPAuth = true; //設定SMTP需要驗證 
$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線 
$mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機 
$mail->Port = 465; //Gamil的SMTP主機的SMTP埠位為465埠。 
$mail->CharSet = "UTF-8"; //設定郵件編碼 

$mail->Username = "lkm543@gmail.com"; //設定驗證帳號 
$mail->Password = "lkm543lkm543"; //設定驗證密碼 

$mail->From = "lkm543@gmail.com"; //設定寄件者信箱 
$mail->FromName = "NTUeMarket"; //設定寄件者姓名 

$mail->Subject = "NTUeMarket會員驗證信--$inputime"; //設定郵件標題 
$mail->Body = "$message"; //設定郵件內容 
$mail->IsHTML(true); //設定郵件內容為HTML 
$mail->AddAddress($email,"lkm543"); //設定收件者郵件及名稱 
$mail->Send();
?>
<script type="text/javascript" language="javascript">
alert("用戶<?php echo $username;?>註冊成功!請至<?php echo $email;?>收取驗證信啟用帳號。");
</script>
<?php
include_once('default.php');
}
//帳號或電子郵件重複
else{
$message="";
if(mysqli_num_rows($result_username)!=0){
$message.="帳號名稱";}
if(mysqli_num_rows($result_email)!=0){
$message.=" 電子郵件位址";
}	
	include_once('registration.php');
	}
?>  