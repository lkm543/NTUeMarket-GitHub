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
               <div id=search>
       		      
                  
                  <?php
$sort=$_GET['sort'];
?>
<form role="form" action="show_item_wanted.php" method="get">
  <div class="form-group">
    <label for="InputKeyword">關鍵字搜尋</label>
   <input type="text" class="form-control" placeholder="關鍵字" size="10" name="keyword">  
   <input type="hidden" name="sort" value="<?php echo $sort;?>">  
  </div>
  <p><button type="submit" class="btn btn-default">Submit</button></p>
</form>
<table class="table table-hover" width="100%" style="margin:0 0 0 0">
<tr><td class="active" onClick="location.href='show_item_wanted.php'"><center>需求總覽</center></td></tr>
<tr><td onClick="location.href='show_item.php'"><center>商品總覽</center></td></tr></table>
<table width="100%">
<tr><td>
<table class="table table-hover" width="100%" style="margin:0 0 0 0">
<tr><td <?php 
	if($sort=="life")
	echo "class=\"success\" ";
?>onClick="location.href='show_item_wanted.php?sort=life'"><center>生活用品</center></td></tr>
<tr><td <?php 
	if($sort=="clothes")
	echo "class=\"success\" ";
?>onClick="location.href='show_item_wanted.php?sort=clothes'"><center>&nbsp;&nbsp;衣&nbsp;&nbsp;&nbsp;物&nbsp;&nbsp;</center></td></tr>
<tr><td <?php 
	if($sort=="bike")
	echo "class=\"success\" ";
?>onClick="location.href='show_item_wanted.php?sort=bike'"><center>&nbsp;腳&nbsp;踏&nbsp;車&nbsp;</center></td></tr>
<tr><td <?php 
	if($sort=="book")
	echo "class=\"success\" ";
?>onClick="location.href='show_item_wanted.php?sort=book'"><center>課外讀物</center></td></tr></table>
</td>
<td>
<table class="table table-hover" width="100%" style="margin:0 0 0 0">
<tr><td <?php 
	if($sort=="stationary")
	echo "class=\"success\" ";
?>onClick="location.href='show_item_wanted.php?sort=stationary'"><center>&nbsp;&nbsp;文&nbsp;&nbsp;&nbsp;具&nbsp;&nbsp;
</center></td></tr>
<tr><td <?php 
	if($sort=="3c")
	echo "class=\"success\" ";
?>onClick="location.href='show_item_wanted.php?sort=3c'"><center>&nbsp;&nbsp;3C產品&nbsp;</center></td></tr>
<tr><td <?php 
	if($sort=="textbook")
	echo "class=\"success\" ";
?>onClick="location.href='show_item_wanted.php?sort=textbook'"><center>&nbsp;&nbsp;教科書&nbsp;&nbsp;</center></td></tr>
<tr><td <?php 
	if($sort=="else")
	echo "class=\"success\" ";
?>onClick="location.href='show_item_wanted.php?sort=else'"><center>&nbsp;&nbsp;其&nbsp;&nbsp;&nbsp;他&nbsp;&nbsp;</center></td></tr>
</table>
</td></tr></table>
                  
                  
       		   </div>
            </div>
  			<div class="col-md-9">
<!-- MySQL 連線!-->
<?php 
//mysqli為主 非mysql
//header('Content-type:text/html; charset=utf-8');
$sort=$_GET['sort'];
$page=$_GET['page'];
$keyword=$_GET['keyword'];
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
mysqli_select_db ($link,"a4904409_goods");
if($sort==null&$keyword==null){
$sql = "select * from goods_wanted where status=1";
}
if($sort==null&$keyword!=null){
$sql = "select * from goods_wanted where (name like '%$keyword%' or detail like '%$keyword%') and status=1";
}
if($sort!=null&$keyword==null){
$sql = "select * from goods_wanted where sort='$sort' and status=1";
}
if($sort!=null&$keyword!=null){
$sql = "select * from goods_wanted where ((name like '%$keyword%' or detail like '%$keyword%') and sort='$sort') and status=1)";
}
$result = mysqli_query($link,$sql); // 執行SQL查詢引
$total_records=mysqli_num_rows($result);  // 取得記錄數
$per = 20; //每頁顯示項目數量 
$pages = ceil($total_records/$per); //總頁數
if(!isset($_GET["page"])){ 
    $page=1; //設定起始頁 
} 
else { 
    $page = intval($_GET["page"]); //確認頁數只能夠是數值資料 
    $page = ($page > 0) ? $page : 1; //確認頁數大於零 
    $page = ($pages > $page) ? $page : $pages; //確認使用者沒有輸入太神奇的數字 
}
$start = ($page-1)*$per; 
//for test
//echo $start.$per; 
if($sort==null&$keyword==null){
$sql2 = "select * from goods_wanted where status=1 ORDER BY id DESC limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort==null&$keyword!=null){
$sql2 = "select * from goods_wanted where (name like '%$keyword%' or detail like '%$keyword%') and status=1 ORDER BY id DESC limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort!=null&$keyword==null){
$sql2 = "select * from goods_wanted where sort='$sort' and status=1 ORDER BY id DESC  limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort!=null&$keyword!=null){
$sql2 = "select * from goods_wanted where ((name like '%$keyword%' or detail like '%$keyword%') and sort='$sort') and status=1ORDER BY id DESC  limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}


?>

<table>
<?php
$number_of_row=mysqli_num_rows($result2);
$totalCount = ceil($number_of_row/4)*4;
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result2)) {
                echo '<td style="width:230px">'.$row[name].'<br>'.$row[detail].
                     '<br>$'.$row[price].'<br>'.$row[method].
                     '<br>'.$row["date"].
					 '<br>'.
					 '</td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}

?>

</table>
<?php for($i=1;$i<=$pages;$i++) { 
    echo '<a href="http://b98502030.uphero.com/show_item.php?';?>
    <?php 
if($sort==null&$keyword!=null){
echo 'keyword='.$keyword;
}
if($sort!=null&$keyword==null){
echo 'sort='.$sort;
}
if($sort!=null&$keyword!=null){
echo 'keyword='.$keyword.'sort='.$sort;
}
	?>
	<?php echo 'page='.$i.'">'.$i.'</a>'; 
}
?>
            
            
            
            
            
            
            </div>
        </div>
       </center>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>
</body>
</html>
