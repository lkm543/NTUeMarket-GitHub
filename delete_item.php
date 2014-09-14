<?php
// mySQL資料庫
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$id=$_POST['id'];
mysqli_query ($link," update item_forsell set status=2 where id='$id'");
include_once("management.php");
?>  