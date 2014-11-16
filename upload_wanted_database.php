<?php
session_start();
$username=$_SESSION['MM_Username'];
$user_id=$_SESSION['MM_UserID'];
$currtimestr=date("Y-m-d H:i:s");
include_once("mysql_info.php");
		if ($_POST[name]==NULL)
			$name="未命名";
		else
			$name=$_POST[name];
$sql = "insert into item_wanted (name,detail,price,method,sort,date,owner,msg_welcome,phone,contact_email)
values('$name','$_POST[detail]','$_POST[price]','$_POST[method]','$_POST[sort]','$currtimestr','$user_id','$_POST[message]','$_POST[phone]','$_POST[contact_email]')";
$success = mysqli_query ($link,$sql);

if($success){


//取得使用者ip
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
   $ip = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
   $ip= $_SERVER['REMOTE_ADDR'];
}

$count=file("counter.txt") ;
$log_now=$currtimestr.'['.$ip.']使用者'.$username."上傳需求----瀏覽人次：".$count[0].'<br>';
mysqli_query ($link,"update Stastic set Log=CONCAT(Log,'$log_now'), Upload_wanted=CONCAT(Upload_wanted,'$log_now')");

	header("Location: upload_wanted_succeed.php");
}else{
	echo $_POST[name].','.$_POST[detail].','.$_POST[price].','.$_POST[method].','.$_POST[sort].','.$currtimestr.','.$user_id.','.$_POST[message].','.$_POST[phone].','.$_POST[contact_email].'<br>';
	echo $username." ".$user_id."<br>";
	echo "Error uploading request!";
}
?>