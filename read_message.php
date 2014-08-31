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
?>
<div id="main">
    <center>
        <div class="row">
            <div class="col-md-1">
       		   </div>
            <div class="col-md-2" align="left">
               <div id=search>
<form role="form" action="show_item.php" method="get">
  <div class="form-group">
    <label for="InputKeyword">關鍵字搜尋</label>
   <input type="text" class="form-control" placeholder="關鍵字" size="10" name="keyword">  
  </div>
  <p><button type="submit" class="btn btn-default">Submit</button></p>
</form>
<table class="table table-hover">
<tr><td onClick="location.href='send_message.php'"><center>撰寫新郵件</center></td></tr>
<tr><td onClick="location.href='message_area.php'"><center>收&nbsp;&nbsp;&nbsp;件&nbsp;&nbsp;&nbsp;&nbsp;夾</center></td></tr>
<tr><td onClick="location.href='sent_message_area.php'"><center>寄&nbsp;件&nbsp;備&nbsp;份</center></td></tr>
<tr><td onClick="location.href='garbage_message_area.php.php'"><center>垃&nbsp;&nbsp;&nbsp;圾&nbsp;&nbsp;&nbsp;桶</center></td></tr>
</table>       		   </div>
            </div>
  			<div class="col-md-8">
            <?php 
session_start();
$username=$_SESSION['MM_Username']; 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
mysqli_select_db ($link,"a4904409_goods");  
$id=$_GET["id"];
//0未讀 1 已讀 2 刪除
$sql = "select * from `Message` where `To`='$username' and (sender_status=1 or sender_status=0) order by `id` desc"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢引
//$row = mysqli_fetch_array($result);
?>
			<table class="table table-striped table table-hover" style="margin:15px 0px 15px 0px"
            <tr><th width="200px">寄件人</th><th colspan="2">主旨</th></tr>
            <?php
$number_of_row=mysqli_num_rows($result)+1;
for($k = 0; $k < $number_of_row; $k ++) {
	if($row = mysqli_fetch_array($result)){
    echo '<tr onClick="location.href=\'read_message.php?id='.$row[id].'"">><form action="delete_message.php"><td>'.$row[From].'</td><td>'.$row[subject].'</td><td width="100" align="right"><input type="submit" value=刪除><input type="hidden" value="$row[id]" name=id></td></form><tr>';
	if($id==$row[id]){
		echo '<tr><td></td><td>'.$row[content].'</td><td></td></tr>';
		
	}};}?>
	
	?></table> <div class="col-md-1">
       		   </div></div>
        </div>
       </center>
	</div><!-- // end #main -->

<?php
}
else{echo '請先登入！';}
?>


<? include("footer.php");?>
</body>
</html>

