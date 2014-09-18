<? include("header.php");?>
	<div id="main">
    <center>
        <div class="row">
            <div class="col-md-1">
       		   </div>
            <div class="col-md-2" align="left">
               <div id=search>
               <?php  //search_bar
$sort=$_GET['sort'];
?>
<form role="form" action="show_item.php" method="get">
  <div class="form-group">
    <label for="InputKeyword">關鍵字搜尋</label>
   <input type="text" class="form-control" placeholder="關鍵字" size="10" name="keyword" value="<?php echo $_GET['keyword'];?>">  
   <input type="hidden" name="sort" value="<?php echo $sort;?>">  
  </div>
  <p><button type="submit" class="btn btn-default">Submit</button></p>
</form>
<table class="table table-hover" width="100%" style="margin:0 0 0 0">
<tr><td onClick="location.href='show_item_wanted.php'"><center>需求總覽</center></td></tr>
<tr><td class="active" onClick="location.href='show_item.php'"><center>商品總覽</center></td></tr></table>
<table width="100%">
<tr><td>
<table class="table table-hover" width="100%" style="margin:0 0 0 0">
<tr><td <?php 
  if($sort=="life")
  echo "class=\"success\" ";
?>onClick="location.href='show_item.php?sort=life'"><center>生活用品</center></td></tr>
<tr><td <?php 
  if($sort=="clothes")
  echo "class=\"success\" ";
?>onClick="location.href='show_item.php?sort=clothes'"><center>&nbsp;&nbsp;衣&nbsp;&nbsp;&nbsp;物&nbsp;&nbsp;</center></td></tr>
<tr><td <?php 
  if($sort=="bike")
  echo "class=\"success\" ";
?>onClick="location.href='show_item.php?sort=bike'"><center>&nbsp;腳&nbsp;踏&nbsp;車&nbsp;</center></td></tr>
<tr><td <?php 
  if($sort=="book")
  echo "class=\"success\" ";
?>onClick="location.href='show_item.php?sort=book'"><center>課外讀物</center></td></tr></table>
</td>
<td>
<table class="table table-hover" width="100%" style="margin:0 0 0 0">
<tr><td <?php 
  if($sort=="stationary")
  echo "class=\"success\" ";
?>onClick="location.href='show_item.php?sort=stationary'"><center>&nbsp;&nbsp;文&nbsp;&nbsp;&nbsp;具&nbsp;&nbsp;
</center></td></tr>
<tr><td <?php 
  if($sort=="3c")
  echo "class=\"success\" ";
?>onClick="location.href='show_item.php?sort=3c'"><center>&nbsp;&nbsp;3C產品&nbsp;</center></td></tr>
<tr><td <?php 
  if($sort=="textbook")
  echo "class=\"success\" ";
?>onClick="location.href='show_item.php?sort=textbook'"><center>&nbsp;&nbsp;教科書&nbsp;&nbsp;</center></td></tr>
<tr><td <?php 
  if($sort=="else")
  echo "class=\"success\" ";
?>onClick="location.href='show_item.php?sort=else'"><center>&nbsp;&nbsp;其&nbsp;&nbsp;&nbsp;他&nbsp;&nbsp;</center></td></tr>
</table>
</td></tr></table>
       		   </div>
            </div>
  			<div class="col-md-9">
       

<?php 
$sort=$_GET['sort'];
$page=$_GET['page'];
$keyword=$_GET['keyword'];
include_once("mysql_info.php");
if($sort==null&$keyword==null){
$sql = "select * from item_forsell where status=1";
}
if($sort==null&$keyword!=null){
$sql = "select * from item_forsell where (name like '%$keyword%' or detail like '%$keyword%') and status=1";
}
if($sort!=null&$keyword==null){
$sql = "select * from item_forsell where sort='$sort' and status=1";
}
if($sort!=null&$keyword!=null){
$sql = "select * from item_forsell where ((name like '%$keyword%' or detail like '%$keyword%') and sort='$sort') and status=1";
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
$sql2 = "select * from item_forsell where status=1 ORDER BY id DESC limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort==null&$keyword!=null){
$sql2 = "select * from item_forsell where (name like '%$keyword%' or detail like '%$keyword%') and status=1 order by id desc limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort!=null&$keyword==null){
$sql2 = "select * from item_forsell where sort='$sort' and status=1 ORDER BY id DESC limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort!=null&$keyword!=null){
$sql2 = "select * from item_forsell where ((name like '%$keyword%' or detail like '%$keyword%') and sort='$sort') and status=1 ORDER BY id DESC limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}

//每頁起始資料序號
//$result2 = mysqli_query('SELECT * FROM table LIMIT ' . $start . ', ' . $per); 
//while($data2 = mysql_fetch_row($result2)) { 
//    print_r($data2); 
//}

?>
<center><div style="margin:20px 0px 5px 0px"><font color="#FF0000" size="5"><?php echo $notice;?></font></div></center>
<table>
<?php
$number_of_row=mysqli_num_rows($result2);
$totalCount = ceil($number_of_row/3)*3;
for($k = 0; $k < $totalCount; $k ++) {

        if($k%3 == 0) { echo '<tr class="row item_list_row">'; }

        if($row = mysqli_fetch_array($result2)) {
                echo '<td class="col-md-3 col-xs-9">
                      <div class="item_wrapper">
                      <div>商品名稱: '.$row[name].'</div>
                      <div>出價金額: $'.$row[price].'</div>
                      <div>上架日期: '.$row[date].'</div>
                      <a href="show_item_detail.php?id='.$row['id'].'">
                      <div class="item_img_wrapper"><img src="Picture/'.$row[filename].'" width="208" class="img-rounded">
                      </a></div></div></td>';
        }
        else {
                echo '</div><td style="width:230px"></td>';
        }

        if($k%3 == 2) { echo '</tr><tr><td style="height: 20px;"></td></tr>'; }

}

?>

</table>
<div class="col-md-12">
<?php for($i=1;$i<=$pages;$i++) { 
  echo '<a href="show_item.php?';?>
  <?php 
  if($sort==null&&$keyword!=null){
    echo 'keyword='.$keyword;
  }
  if($sort!=null&&$keyword==null){
    echo 'sort='.$sort;
  }
  if($sort!=null&&$keyword!=null){
    echo 'keyword='.$keyword.'sort='.$sort;
  }
  ?>
  <?php echo 'page='.$i.'"><span class="pagination">'.$i.'</span></a>'; 
}
?>

</div>    
        </div>
        </div>
       </center>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>