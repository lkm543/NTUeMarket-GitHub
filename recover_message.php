<?php

if(isset($_POST['id'])){

	session_start();

	$username=$_SESSION['MM_Username'];
	$user_id=$_SESSION['MM_UserID'];

	$currtimestr=date("Y-m-d h:i:s"); 

	include_once("mysql_info.php");

	$id=$_POST['id'];

	$sql="select `from`, `to` from message where id='$id'";

	$result = mysqli_query($link,$sql); // 執行SQL查詢引

	$row = mysqli_fetch_array($result);

	if($user_id==$row['from']){

		mysqli_query ($link,"update message set sender_status= 1 where id='$id'");

	}

	if($user_id==$row['to']){

		mysqli_query ($link,"update message set receiver_status= 1 where id='$id'");

	}
}
header("Location: garbage_message_area.php");

?>