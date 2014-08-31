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
<tr><td onClick="location.href='management_interested.php'"><center>&nbsp;興趣清單&nbsp;</center></td></tr>
<tr><td onClick="location.href='management.php'"><center>&nbsp;我的商品&nbsp;</center></td></tr>
<tr><td onClick="location.href='management_wanted.php'"><center>&nbsp;我的需求&nbsp;</center></td></tr>
<tr><td onClick="location.href='management_removed.php'"><center>已下架商品/需求</center></td></tr>
<tr><td class="success" onClick="location.href='management_idle.php'"><center>&nbsp;閒置商品/需求&nbsp;</center></td></tr>
</table>     
            </div>
  			<div class="col-md-9">
            <?php 
session_start();
$username=$_SESSION['MM_Username']; 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
mysqli_select_db ($link,"a4904409_goods");  
$sql = "select * from goods_test where owner='$username' and status=3 order by id desc"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$total_fields=mysqli_num_fields($result); // 取得欄位數
$number_of_row=mysqli_num_rows($result); // 取得記錄數
$totalCount = ceil($number_of_row/4)*4;
echo "<table><tr><th colspan=\"4\">閒置商品</th></tr>";
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
                echo '<td><table><form action="recover_item.php" method="post"><tr><td style="width:230px">'.$row[goods_name].
                     '</td></tr><tr><td>'.$row[price].
                     '</td><tr><td>'.$row["date"].
					 '</td><tr><td><img src="Picture/'.$row[filename].'" width="216" height="162" class="img-rounded"></td><tr><td><center><input type="submit" value="恢復上架"><input type="hidden" name="id" value="'.$row['id'].'"/></center></td></tr></form></table></td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}
echo "</table>";
echo "<table>";
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
                echo '<td><table><form action="recover_item.php" method="post"><tr><td style="width:230px">'.$row[goods_name].
                     '</td></tr><tr><td>'.$row[price].
                     '</td></tr><tr><td>'.$row["date"].
					 '</td></tr><tr><td><img src="Picture/'.$row[filename].'" width="216" height="162" class="img-rounded"></td></tr><tr><td><center><input type="submit" value="恢復上架"><input type="hidden" name="id" value="'.$row['id'].'"/></center></td></tr></form></table></td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}
echo "</table>";

$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
mysqli_select_db ($link,"a4904409_goods");  
$sql = "select * from goods_wanted where owner='$username' and status=3 order by id desc"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$total_fields=mysqli_num_fields($result); // 取得欄位數
$number_of_row=mysqli_num_rows($result); // 取得記錄數

echo "<table><tr><th colspan=\"4\">閒置需求</th></tr>";
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
                echo '<td><table><form action="recover_item.php" method="post"><tr><td style="width:230px">'.$row[name].
                     '</td></tr><tr><td>'.$row[detail].'</td></tr><tr><td>'.$row[price].
                     '</td></tr><tr><td>'.$row["date"].
					 '</td></tr><tr><td><center><input type="submit" value="繼續徵求"><input type="hidden" name="id" value="'.$row['id'].'"/></center></td></tr></form></table></td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}
echo "</table>";
echo "<table>";
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
                echo '<td><table><form action="recover_item.php" method="post"><tr><td style="width:230px">'.$row[goods_name].
                     '</td></tr><tr><td>'.$row[price].
                     '</td><tr><td>'.$row["date"].
					 '</td><tr><td><img src="Picture/'.$row[filename].'" width="216" height="162" class="img-rounded"></td><tr><td><center><input type="submit" value="恢復上架"><input type="hidden" name="id" value="'.$row['id'].'"/></center></td></tr></form></table></td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}
echo "</table>";

?>
            </div>
        </div>
       </center>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>
</body>
</html>
