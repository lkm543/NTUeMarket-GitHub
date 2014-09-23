<?php
// mySQL資料庫
$currtimestr=date("Y-m-d h:i:s"); 
$id=$_POST['id'];
$type=$_POST['type'];
include_once("mysql_info.php");
if($type=="item"){
	mysqli_query ($link," update item_forsell set status=1 where id='$id'");
	header("Location: management.php");
}
if($type=="want"){
	mysqli_query ($link," update item_wanted set status=1 where id='$id'");
	header("Location: management_wanted.php");
}
	?>  