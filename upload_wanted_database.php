<?php
session_start();
$username=$_SESSION['MM_Username'];
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$sql = "select id from member where username = '$username'";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_array($result);
		$user_id = $row['id'];
mysqli_query ($link,"insert into item_wanted (name,detail,price,method,sort,date,owner,msg_welcome,phone,contact_email)
values('$_POST[name]','$_POST[detail]','$_POST[price]','$_POST[method]','$_POST[sort]','$currtimestr','$user_id','$_POST[message]','$_POST[phone]','$_POST[contact_email]')");
mysqli_query ($link,"update backend set id='$id' where id='$id_old'");
header("Location: upload_wanted_succeed.php");
?>