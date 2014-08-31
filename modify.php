<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="我們試圖建立一個屬於台大人的二手交換電子商務平台，你可能會有想要買/賣/贈送的二手教科書，要搬家出清的家具、用不到的衣服雜物。你可以藉由社群成員具有需求同質性高、地利之便的優勢，很快找到買/賣家、很方便遞交/接收物品，最重要的是能讓物盡其用，每一分資源都不被浪費。" />
    <meta name="keywords" content="台大,二手物,交換平台,電子商務" />
    <title>NTUeMarket</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />	
	<link href="css/nivo-slider.css" rel="stylesheet" type="text/css" />
    <!--[if IE]><link href="css/style-ie.css" rel="stylesheet" type="text/css" /><![endif]-->
    <!-- jQuery (使用Bootstrap的JavaScript外掛) -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- jQuery (使用Bootstrap的JavaScript外掛) -->
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$('#slideshow').nivoSlider({
				directionNav: false
			});
		});
	</script>
        <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style-ie.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 shim 和 Respond.js 讓IE8支援HTML5元素和媒體查詢 -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <!-- 在下面加入所有已編譯外掛，或是當需要時加入獨立檔案 -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

<div id="wrapper">
<? include("header.php");
session_start(); 
if (isset($_SESSION['MM_Username'])){
$username=$_SESSION['MM_Username'];
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
mysqli_select_db ($link,"a4904409_goods");  
$sql = "select * from member where username = '$username'"; //在資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
?>
<div class="row">
<div class="col-md-6 col-md-offset-3">
<form action="modify_database.php" method="post">
<table class="table table-striped" style="margin:45px 0px 5px 0px">
<tr><th colspan="2">帳戶基本資料</th></tr>
<tr>
<td>帳號</td>
<td><?php echo $username;?></td>
</tr>
<tr>
<td>啟用</td>
<td><?php 
if($row[active]==0){echo "<font color=\"red\">尚未啟用，請收取驗證信以啟用帳號</font>";} else {echo "已啟用";}?></td>
</tr>
<tr>
<td>註冊email</td>
<td><?php echo $row[email];?></td>
</tr>
<tr>
<tr>
<td>暱稱</td>
<td><input type="text" value="<?php echo $row[nickname];?>" name="nickname"/></td>
</tr>
<tr>
<td>
重設新密碼
</td>
<td>
<input type="password" name="password1" value="" /> 
</td>
</tr>
<tr>
<td>
新密碼確認
</td>
<td>
<input type="password" name="password2" value=""/> 
</td>
</tr>
</table>
<table class="table table-striped" style="margin:15px 0px 25px 0px">
<tr><th colspan="2">使用者偏好設定  (填入後將於每次上傳商品自動帶入)</th></tr>
<tr>
<td width="170">慣用交易方式/地點</td>
<td><input type="method" value="<?php echo $row[method];?>" name="method"/></td>
</tr>
<tr>
<td>手機</td>
<td><input type="text" value="<?php echo $row[phone];?>" name="phone"/></td>
<td></td>
</tr>
<tr>
<td>聯絡email</td>
<td><input type="email" value="<?php echo $row[contact_email];?>" name="contact_email"/></td>
<td></td>
</tr>
<tr>
<td>私人訊息</td>
<td><input type="radio" name="message" value="1"<?php 
if($row[message]==1)
{
	echo " checked";
	}
?>>歡迎私訊   <input type="radio" name="message" value="2"<?php 
if($row[message]==2)
{
	echo " checked";
	}
?>>以其他聯絡方式為主</td>
<td></td>
</tr>
<tr>
<td colspan="2"> <center>
<input type="submit" /></center>
</td>
</tr>
</table>
</form>
</div>
</div>

<?php
}
?>


<? include("footer.php");?>
</body>
</html>

