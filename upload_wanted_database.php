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
mysqli_query ($link,"insert into goods_wanted (name,detail,price,method,sort,date,owner,id,message,phone,contact_email)
values('$_POST[name]','$_POST[detail]','$_POST[price]','$_POST[method]','$_POST[sort]','$currtimestr','$username','$id','$_POST[message]','$_POST[phone]','$_POST[contact_email]')");
mysqli_query ($link,"update backend set id='$id' where id='$id_old'");?>
<script type="text/javascript" language="javascript">
alert("Succeed!");
</script>
<?php
echo '<meta http-equiv=REFRESH CONTENT=2;url=show_item_wanted.php>';
?>