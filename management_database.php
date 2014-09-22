<?php
// mySQL資料庫
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$name=$_POST['name'];
$detail=$_POST['detail'];
$price=$_POST['price'];
$method=$_POST['method'];
$sort=$_POST['sort'];
$id=$_POST['id'];
mysqli_query ($link,"update item_forsell set name='$name', detail='$detail', price='$price', method='$method', sort='$sort' where id='$id'");
header("Location: management.php");
?>  