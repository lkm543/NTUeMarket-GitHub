<?php
session_start();
$username=$_SESSION['MM_Username'];
$currtimestr=date("Y-m-d h:i:s"); 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"a4904409_goods"); 
mysqli_query($link,"SET NAMES 'utf8'");  
$sql="select * from backend";
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
$id_old=$row['id'];
$id=$row['id']+1;
mysqli_query ($link,"insert into `Message` (`From`,`To`,`subject`,`Message`,`date`,`id`) values('$username','$_POST[receiver]','$_POST[subject]','$_POST[content]','$currtimestr','$id')");
mysqli_query ($link,"update backend set id='$id' where id='$id_old'");?>
<script type="text/javascript" language="javascript">
alert("Succeed!");
</script>
<?php
//echo $username.$_POST[receiver].$_POST[subject].$_POST[content].$currtimestr.$id;
echo '<meta http-equiv=REFRESH CONTENT=2;url=message_area.php>';
?>