<?php

if(!isset($_POST['id'])){
	?><script type="text/javascript" text="javascript">
		alert("你太邪惡囉!!!");
	</script><?php
		echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>'; 
}else{
	session_start();
	$username=$_SESSION['MM_Username'];
	$user_id=$_SESSION['MM_UserID'];

	include_once("mysql_info.php");
	$id=$_POST['id'];
	$sql="update message set receiver_status=2 where id='$id'";
	// $result = mysqli_query($link,$sql); // 執行SQL查詢引
	// $row = mysqli_fetch_array($result);
	// if($user_id==$row['to']){
	$result = mysqli_query ($link,$sql);
	if($result){
		// }
		header("Location: message_inbox.php");
	}else{
		?><script type="text/javascript" text="javascript">
			alert("發生錯誤! 訊息無法刪除，請稍後在試。");
		</script><?php
		header("Location: message_inbox.php");
	}
}
?>