<?php


	session_start();
	$username=$_SESSION['MM_Username'];
	$user_id=$_SESSION['MM_UserID'];

	$receiver=trim($_POST['receiver2']);
	$subject=($_POST['subject2']);
	$content=($_POST['content2']);
	$currtimestr=date("Y-m-d h:i:s"); 

	include_once("mysql_info.php");

	$query = "select id as receiver_id from member where username='$receiver'";
	//檢查收件人是否存在
	$result = mysqli_query($link,$query); // 執行SQL查詢引
	$row = mysqli_fetch_array($result);
	$number= mysqli_num_rows($result);
	// echo $number;
	if($result){
		if($number==1){
			$sql = "insert into `message` (`from`,`to`,`subject`,`body`,`date`) values('$user_id','".$row[receiver_id]."','$subject','$content','$currtimestr')";

			if($sucess=mysqli_query ($link,$sql)){
				echo '<meta http-equiv=REFRESH CONTENT=2;url=message_inbox.php>';
			}else{
				?><script type="text/javascript" text="javascript">
					alert("Error sending message to ".<?php echo $receiver; ?>.", please try again later.");
					</script><?php
			}
		}else{

			$notice="查無此收件者";

			include_once("send_message.php");
		}		
	}else{
		?><script type="text/javascript" text="javascript">
					alert("Could not run query.");
					</script><?php
	}

?>