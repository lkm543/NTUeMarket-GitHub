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
$result=mysqli_query($link,"select * from goods_test where id='$id'");
$number= mysqli_num_rows($result);
//檢查登入
if($username!=NULL){
$result2=mysqli_query($link,"select * from member where username='$username'");
$row = mysqli_fetch_array($result2);
//初始
if($row['interested']==NULL){
$tempt=array();
array_push($tempt,$id);
$tempt=serialize($tempt);
mysqli_query ($link,"update member set interested='$tempt' where username='$username'");
}
//興趣清單裡已有值
else{
$tempt=unserialize($row['interested']);
//r檢查是否已經加入
if(!in_array($id, $tempt)){	
array_push($tempt,$id);//增加
$tempt=serialize($tempt);
mysqli_query ($link,"update member set interested='$tempt' where username='$username'");}}

$notice="已加入興趣清單，可至會員專區頁面查看";

if($number==1){//商品
include_once("show_item.php");
}
else{
//徵求	
	include_once("show_item_wanted.php");
}
}

//尚未登入
else
{
	$notice="請登入以啟用此功能";
	include_once("show_item_detail.php");}
?>  