<?php
// mySQL資料庫
$currtimestr=date("Y-m-d h:i:s"); 
$id=$_POST['id'];
include_once("mysql_info.php");
mysqli_query ($link," update item_forsell set status=1 where id='$id'");
mysqli_query ($link," update item_wanted set status=1 where id='$id'");
header("Location: management_removed.php");
?>  