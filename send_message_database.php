<?php
session_start();
$username=$_SESSION['MM_Username'];
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$sql="select * from backend";
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
$id_old=$row['id'];
$id=$row['id']+1;
$receiver=$_POST[receiver2];
//檢查收件人是否存在
$result2 = mysqli_query($link,"select * from member where username='$receiver'"); // 執行SQL查詢
$number= mysqli_num_rows($result2);
if($number!=0)
{
mysqli_query ($link,"insert into `message` (`From`,`To`,`subject`,`message`,`date`,`id`) values('$username','$_POST[receiver2]','$_POST[subject2]','$_POST[content2]','$currtimestr','$id')");
mysqli_query ($link,"update backend set id='$id' where id='$id_old'");
echo '<meta http-equiv=REFRESH CONTENT=2;url=message_area.php>';}
else{
	$notice="查無此收件者";

	include_once("send_message.php");
	}
?>