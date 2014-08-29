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
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
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
echo "您已經登入!";
} else{?>
<center>

<div style="margin:100px 0px 250px 0px">
  <center><p style="margin:0px 0px 10px 0px;color:red"><?php if($message!="")
  {echo $message ?>已存在<br><?php }?></p><p>新用戶註冊</p></center>
<form action="Add_Member_Database.php" method="post" name="form1" >
  <table border="0">
      <tr>
      <td>用戶帳號</td>
      <td><input type="text" pattern=".{5,15}" name="username" id="username" class="form-control"></td>
      <td>(5-15字)</td>
    </tr>
    <tr>
      <td>電子郵件信箱</td>
      <td colspan="2"><input type="email" name="email" id="email" class="form-control"></td>
    </tr>
    <tr>
      <td>用戶密碼</td>
      <td><input type="password" pattern=".{5,15}" name="password" id="password" class="form-control"></td>
      <td>(5-15字)</td>
    </tr>
        <tr>
      <td>&nbsp;</td>
      <td colspan="2"><span class="General">
        <input type="submit" name="submit" id="submit" value="送出">
        <input type="reset" name="reload" id="reload" value="重設"></span>
      </td>
    </tr>
</table>
</form>
</div>
</center>

<?php }?>

<? include("footer.php");?>
</body>
</html>

