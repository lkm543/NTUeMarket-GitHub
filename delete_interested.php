<?php
// mySQL資料庫
session_start(); 
$currtimestr=date("Y-m-d h:i:s"); 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
//帳戶資料
$username=$_SESSION['MM_Username'];
$id=$_POST['id'];
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"a4904409_goods"); 
mysqli_query($link,"SET NAMES 'utf8'"); 
$result=mysqli_query($link,"select * from member where username='$username'");
$row = mysqli_fetch_array($result);
$interested_array=array();
$interested_array=unserialize($row['interested']);
//echo implode(",",$interested_array);
$number=sizeof($interested_array);
//echo sizeof($interested_array)."<br>";
for( $i=0; $i < $number; $i++){
	//echo $i."<br>";
	//echo implode(",",$interested_array)."<br>";
	if( $interested_array[$i] == $id) 
	{
		unset($interested_array[$i]);
		//重新整理迴圈
		for ($i;$i < $number-1;$i++){
			$interested_array[$i]=$interested_array[$i+1];
			break;
		}	
	}
}
$tempt=serialize($interested_array);
mysqli_query ($link,"update member set interested='$tempt' where username='$username'");
include_once("management_interested.php");
?>  