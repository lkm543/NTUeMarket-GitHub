<?php
// mySQL資料庫
$currtimestr=date("Y-m-d h:i:s"); 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
//帳戶資料
$name=$_POST['name'];
$detail=$_POST['detail'];
$price=$_POST['price'];
$method=$_POST['method'];
$sort=$_POST['sort'];
$id=$_POST['id'];
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"a4904409_goods"); 
mysqli_query($link,"SET NAMES 'utf8'");  
mysqli_query ($link,"update goods_wanted set name='$name', detail='$detail', price='$price', method='$method', sort='$sort' where id='$id'");
?>
<script type="text/javascript" language="javascript">
alert("商品資料修改成功!稍後跳回修改頁面");
</script>
<?php
include_once("management_wanted.php");
?>  