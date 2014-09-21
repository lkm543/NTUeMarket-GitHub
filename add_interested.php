<?php
// mySQL資料庫
if(isset($_POST['id'])&&isset($_POST['item_type'])){
	session_start(); 
	$currtimestr=date("Y-m-d h:i:s"); 
	$username=$_SESSION['MM_Username'];
	$id=$_POST['id'];
	$type=$_POST['item_type'];
	$table="";

	if($type=="sell")
		$table="s";
	elseif($type=="wanted")
		$table="w";

	include_once("mysql_info.php");

	//檢查登入
	if($username!=NULL){
		$result2=mysqli_query($link,"select interested from member where username='$username'");
		$row = mysqli_fetch_array($result2);
		//初始
		if($row[interested]==NULL){
			$tempt=array();
			array_push($tempt,$table.'_'.$id);
			$tempt=serialize($tempt);
			mysqli_query ($link,"update member set interested='$tempt' where username='$username'");
		}else{ 	
			//興趣清單裡已有值
			$tempt=unserialize($row[interested]);
			//檢查是否已經加入
			if(!in_array($table.'_'.$id, $tempt)){	
				array_push($tempt,$table.'_'.$id);//增加
				$tempt=serialize($tempt);
				mysqli_query ($link,"update member set interested='$tempt' where username='$username'");
			}
		}

		$notice='已加入興趣清單，可至<a href="management_interested.php">會員專區</a>查看';

		if($table=="s"){
			//商品
			include_once("show_item.php");
		}else{
			//徵求	
			include_once("show_item_wanted.php");
		}
	}else{ 
		//尚未登入
		$notice="請登入以啟用此功能";
		include_once("login.php");
	}
}?>  