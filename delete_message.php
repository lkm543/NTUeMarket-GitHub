<?php

session_start();
$username=$_SESSION['MM_Username'];
$currtimestr=date("Y-m-d h:i:s"); 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,"SET NAMES 'utf8'");  
mysqli_select_db ($link,"a4904409_goods"); 
$id=$_POST['id'];
$sql="select * from Message where id='$id'";
$result = mysqli_query($link,$sql); // 執行SQL查詢引
$row = mysqli_fetch_array($result);
$sender_status=$row[sender_status];
$receiver_status=$row[receiver_status];
if($username==$row['From']){//update Message set sender_status= 2 where id=57
mysqli_query ($link,"update Message set sender_status= ($sender_status+1) where id='$id'");
	}
if($username==$row['To']){
mysqli_query ($link,"update Message set receiver_status= ($receiver_status+1) where id='$id'");
	}
?>


<script type="text/javascript" language="javascript">
alert("Succeed!");
</script>
<?php
echo '<meta http-equiv=REFRESH CONTENT=2;url=garbage_message_area.php>';
?>