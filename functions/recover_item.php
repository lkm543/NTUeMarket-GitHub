<?php
// mySQL資料庫
$currtimestr=date("Y-m-d h:i:s"); 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
//mysqli_query($link, "SET collation_connection ='utf8_general_ci'");
//帳戶資料
$id=$_POST['id'];
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"a4904409_goods"); 
mysqli_query($link,"SET NAMES 'utf8'");  
mysqli_query ($link," update goods_test set status=1 where id='$id'");
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"a4904409_goods"); 
mysqli_query($link,"SET NAMES 'utf8'");  
mysqli_query ($link," update goods_wanted set status=1 where id='$id'");
?>
<script type="text/javascript" language="javascript">
alert("重新上架成功!稍後跳回修改頁面");
</script>
<?php
include_once("management.php");
?>  