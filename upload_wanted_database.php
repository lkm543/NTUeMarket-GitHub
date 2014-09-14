<?php
session_start();
$username=$_SESSION['MM_Username'];
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$sql="select * from backend";
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
$id_old=$row['id'];
$id=$row['id']+1;
mysqli_query ($link,"insert into item_wanted (name,detail,price,method,sort,date,owner,id,message,phone,contact_email)
values('$_POST[name]','$_POST[detail]','$_POST[price]','$_POST[method]','$_POST[sort]','$currtimestr','$username','$id','$_POST[message]','$_POST[phone]','$_POST[contact_email]')");
mysqli_query ($link,"update backend set id='$id' where id='$id_old'");?>
<script type="text/javascript" language="javascript">
alert("Succeed!");
</script>
<?php
header("Location: http://plog.longwin.com.tw/");
exit;
include_once("upload_wanted_succeed.php");
?>