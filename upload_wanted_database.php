<?php
session_start();
$username=$_SESSION['MM_Username'];
$user_id=$_SESSION['MM_UserID'];
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$sql = "insert into item_wanted (name,detail,price,method,sort,date,owner,msg_welcome,phone,contact_email)
values('$_POST[name]','$_POST[detail]','$_POST[price]','$_POST[method]','$_POST[sort]','$currtimestr','$user_id','$_POST[message]','$_POST[phone]','$_POST[contact_email]')";
$success = mysqli_query ($link,$sql);

if($success){
	header("Location: upload_wanted_succeed.php");
}else{
	echo $_POST[name].','.$_POST[detail].','.$_POST[price].','.$_POST[method].','.$_POST[sort].','.$currtimestr.','.$user_id.','.$_POST[message].','.$_POST[phone].','.$_POST[contact_email].'<br>';
	echo $username." ".$user_id."<br>";
	echo "Error uploading request!";
}
?>