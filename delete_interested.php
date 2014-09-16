<?php
// mySQL資料庫
session_start(); 
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$username=$_SESSION['MM_Username'];
$id=$_POST['id'];
$result=mysqli_query($link,"select interested from member where username='$username'");
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