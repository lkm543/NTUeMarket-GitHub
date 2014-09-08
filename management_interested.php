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
<? include("header.php");?>
	<div id="main">
    <center>
        <div class="row">
            <div class="col-md-1">
       		   </div>
            <div class="col-md-2" align="left">
<table class="table table-hover">
<tr><td class="success" onClick="location.href='management_interested.php'"><center>&nbsp;興趣清單&nbsp;</center></td></tr>
<tr><td onClick="location.href='management.php'"><center>&nbsp;我的商品&nbsp;</center></td></tr>
<tr><td onClick="location.href='management_wanted.php'"><center>&nbsp;我的需求&nbsp;</center></td></tr>
<tr><td onClick="location.href='management_removed.php'"><center>已下架商品/需求</center></td></tr>
<tr><td onClick="location.href='management_idle.php'"><center>&nbsp;閒置商品/需求&nbsp;</center></td></tr>
</table>     
            </div>
  			<div class="col-md-9">
			<?php //MySQL
session_start();
$username=$_SESSION['MM_Username']; 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
mysqli_select_db ($link,"a4904409_goods");
$sql = "select * from member where username='$username'"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$total_fields=mysqli_num_fields($result); // 取得欄位數
$total_records=mysqli_num_rows($result);  // 取得記錄數
$totalCount = ceil($total_records/4)*4;
echo '<table align=left>';
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
echo '<td><form action="management_wanted_database.php" method="post"><table style="margin: 10px 10px 10px 10px">';
echo '<tr><td>&nbsp;&nbsp;名稱&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="name" class="form-control" value="'. $row[name].'"><input type="hidden" name="id" value="'.$row['id'].'"/></td></tr>';
echo '<tr><td>&nbsp;&nbsp;描述&nbsp;&nbsp;&nbsp;</td><td><textarea name="detail" id="detail" pattern=".{0,100}" class="form-control" rows="3">'.$row[detail].'</textarea></td></tr>';   
echo '<tr><td>&nbsp;&nbsp;價格&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="price" class="form-control" value="'.$row[price].'"></td></tr>';  
echo '<tr><td>&nbsp;&nbsp;方式&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="method" class="form-control" value="'.$row[method].'"></td></tr>';  
echo '<tr><td>&nbsp;&nbsp;分類&nbsp;&nbsp;&nbsp;</td><td>
		  <select name="sort" id="sort" class="form-control">'; ?>
          <option value="life" <?php if ($row['sort']=="life") echo 'selected="selected"';?>>生活用品</option>
          <option value="stationary" <?php if ($row['sort']=="stationary") echo 'selected="selected"';?>>文具</option>
          <option value="clothes" <?php if ($row['sort']=="clothes") echo 'selected="selected"';?>>衣物</option>
          <option value="3c" <?php if ($row['sort']=="3c") echo 'selected="selected"';?>>3c產品</option>
          <option value="bike" <?php if ($row['sort']=="bike") echo 'selected="selected"';?>>腳踏車</option>
          <option value="book" <?php if ($row['sort']=="book") echo 'selected="selected"';?>>課外讀物</option>
          <option value="textbook" <?php if ($row['sort']=="textbook") echo 'selected="selected"';?>>教科書</option>
          <option value="else" <?php if ($row['sort']=="else") echo 'selected="selected"';?>>其他</option>
<?php 
echo '</select></td></tr>';	
echo '<tr><td colspan="2"><center><input type="submit" value="移除" formaction="delete_item.php""></center></td></tr></table></form></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}
echo '</table>';
   
            
            ?>
            </div>
        </div>
       </center>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>
</body>
</html>
