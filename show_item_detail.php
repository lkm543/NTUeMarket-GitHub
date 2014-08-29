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
<? include("header.php");?>
	<div id="main">
    <center>
        <div class="row">
            <div class="col-md-1">
       		   </div>
            <div class="col-md-2" align="left">
               <div id=search>
       		      <? include("search_bar.php");?>
       		   </div>
            </div>
  			<div class="col-md-9">
			<?php 
			session_start();
			$id=$_GET['id'];
			$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
mysqli_select_db ($link,"a4904409_goods");
$sql = "select * from goods_test where id='$id'";
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
			?><center>
            <div class="row">
<div class="col-md-6 col-md-offset-3">
            <table class="table table-striped">
<tr>
<td width="70">帳號</td>
<td width="150"><?php echo $row['owner'];?></td>
</tr>
<tr>
<td>商品名稱</td>
<td><?php echo $row['goods_name'];?></td>
</tr>
<tr>
<td>商品描述</td>
<td><?php echo nl2br($row['detail']);?></td>
</tr>
<tr>
<td>商品價格</td>
<td><?php echo '$'.$row['price'];?></td>
</tr>
<tr>
<td>交易方式</td>
<td><?php echo $row['method'];?></td>
</tr>
<tr>
<td>聯絡email</td>
<td><?php echo $row['contact_email'];?></td>
</tr>
<tr>
<td>手機</td>
<td><?php echo $row['phone'];?></td>
</tr>
<tr>
<td>私人訊息</td>
<td><?php 
if($row['message']==1)
{echo "歡迎私訊";} 
if($row['message']==2)
{echo "不常用，以其他聯絡方式為主";}?></td>
</tr>
<tr>
<td>上架日期</td>
<td><?php echo $row['date'];?></td>
</tr>
<tr>
<td colspan="2"><center><?php echo '<img src="Picture/'.$row[filename].'"width="432" height="324" class="img-rounded">';?></center></td>
</tr>
<tr><td colspan="2">
<form action="send_message.php" method="post"><input type="hidden" name="receiver" value="<?php echo $row[owner];?>"><input type="hidden" name="subject" value="<?php echo "商品：".$row[goods_name];?>">
<input type="hidden" name="content" value="<?php echo "商品名稱:".$row[goods_name]."\n商品描述:".nl2br($row['detail'])."\n商品價格:".$row['price']."\n交易方式:".$row[method]."\n聯絡email:".$row['contact_email']."\n手機:".$row['phone'];?>">
<center><input type="submit" value="加到興趣清單" formaction="add_interested.php">&nbsp;&nbsp;<input type="submit" value="丟私人訊息">&nbsp;&nbsp;<input type="submit" value="回報已成交">&nbsp;&nbsp;<input type="submit" value="回上一頁"></center></form></td></tr>
</table></div></div><center>
            </div>
        </div>
       </center>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>
</body>
</html>
