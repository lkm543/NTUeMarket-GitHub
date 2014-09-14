<?php
// mySQL資料庫
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
//帳戶資料
$name=$_POST['name'];
$detail=$_POST['detail'];
$price=$_POST['price'];
$method=$_POST['method'];
$sort=$_POST['sort'];
$id=$_POST['id'];
mysqli_query ($link,"update item_wanted set name='$name', detail='$detail', price='$price', method='$method', sort='$sort' where id='$id'");
include_once("management_wanted.php");
?>  