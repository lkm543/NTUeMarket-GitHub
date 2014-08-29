<?php
// mySQL資料庫
session_start(); 
$currtimestr=date("Y-m-d h:i:s"); 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
//mysqli_query($link, "SET collation_connection ='utf8_general_ci'");
//帳戶資料
$username=$_SESSION['MM_Username'];
$password=$_POST['password'];
$method=$_POST['method'];
$phone=$_POST['phone'];
$nickname=$_POST['nickname'];
$message=$_POST['message'];
$contact_email=$_POST['contact_email'];
$link=mysql_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysql_select_db ("a4904409_goods"); 
mysql_query("SET NAMES 'utf8'");  
//密碼未改
mysql_query ("update member set phone='$phone', nickname='$nickname', method='$method', contact_email='$contact_email', message='$message' where username='$username'");
?>
<script type="text/javascript" language="javascript">
alert("<?php echo $username;?>會員資料修改成功!稍後跳回修改頁面");
</script>
<?php
include_once("modify.php");
?>  