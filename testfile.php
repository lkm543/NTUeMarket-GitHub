<?php
	session_start();
	$username=$_SESSION['MM_Username'];
	$user_id=$_SESSION['MM_UserID'];
include_once('mysql_info.php');
$sql="select id as reciever_id from member where username='$username'";
$result = mysqli_query($link,$sql); // 執行SQL查詢引
$rows = 0;
while($row = mysqli_fetch_array($result)){
	$rows++;
	echo $rows;
}
?>