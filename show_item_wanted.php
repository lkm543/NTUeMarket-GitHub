<? include("header.php");?>
<?php 
$sorting=$_GET['sorting'];
$sort=$_GET['sort'];
$page=$_GET['page'];
$keyword=$_GET['keyword'];
?><?php 
$sorting=$_GET['sorting'];
$sort=$_GET['sort'];
$page=$_GET['page'];
$keyword=$_GET['keyword'];
?>
<div id="main" style="padding-top:85px;">
  <center>
    <div class="row">
      <form role="form" action="show_item_wanted.php" method="get">
        <div class="search_bar col-md-2 col-md-offset-2" style="padding-right:3px;">
          <input type="text" class="form-control" placeholder="關鍵字" size="10" name="keyword" <?php if($keyword!=NULL) echo "value=".$keyword;?>>
        </div>
        <div class="search_bar col-md-1"style="padding-left:5px;padding-right:0px;">
          <select name="sort" id="sort" class="form-control"  onchange="this.form.submit()">
                            <option value="" <?php if($sort=='') echo 'selected=selected'; ?>>商品分類</option>
                            <option value="life" <?php if($sort=='life') echo 'selected=selected'; ?>>生活用品</option>
                            <option value="sport" <?php if($sort=='sport') echo 'selected=selected'; ?>>運動用品</option>
                            <option value="3c" <?php if($sort=='3c') echo 'selected=selected'; ?>>3C產品</option>
                            <option value="transportation" <?php if($sort=='transportation') echo 'selected=selected'; ?>>交通工具</option>
                            <option value="clothes" <?php if($sort=='clothes') echo 'selected=selected'; ?>>衣褲鞋帽</option>
                            <option value="stationary" <?php if($sort=='stationary') echo 'selected=selected'; ?>>文具</option>
                            <option value="book" <?php if($sort=='book') echo 'selected=selected'; ?>>課外讀物</option>
                            <option value="textbook" <?php if($sort=='textbook') echo 'selected=selected'; ?>>教科書</option>
                            <option value="makeup" <?php if($sort=='makeup') echo 'selected=selected'; ?>>美妝保養</option>
                            <option value="furniture" <?php if($sort=='furniture') echo 'selected=selected'; ?>>傢俱</option>
                            <option value="games" <?php if($sort=='games') echo 'selected=selected'; ?>>各式遊戲</option>
                            <option value="else" <?php if($sort=='else') echo 'selected=selected'; ?>>其他</option>
                            <option value="giving" <?php if($sort=='giving') echo 'selected=selected'; ?>>贈送</option>
          </select>
        </div>
        <div class="search_bar col-md-2"style="padding-left:0px;padding-right:0px;">
          <select name="sorting" id="sort" class="form-control" style="width:75%"  onchange="this.form.submit()"> 
            <option value="" <?php if($sorting=='') echo 'selected=selected'; ?>>排序方式</option>
            <option value="date" <?php if($sorting=='date') echo 'selected=selected'; ?>>上架時間：近到遠</option>
            <option value="date_revert" <?php if($sorting=='date_revert') echo 'selected=selected'; ?>>上架時間：遠到近</option>
            <option value="price" <?php if($sorting=='price') echo 'selected=selected'; ?>>價格：便宜到貴</option>
            <option value="price_revert" <?php if($sorting=='price_revert') echo 'selected=selected'; ?>>價格：貴到便宜</option>

          </select>
        </div>
        <div class="search_bar col-md-1"style="padding-left:0px;padding-right:80px;">
          <button type="submit" class="btn btn-default">搜尋</button>
        </div>
        <div class="search_bar col-md-3"style="padding-left:0px;text-align:left;">
          <?php 
          include_once("mysql_info.php");
          if($sort==null&$keyword==null){
            $sql = "select * from item_wanted where status=1";
          }
          if($sort==null&$keyword!=null){
            $sql = "select * from item_wanted where (name like '%$keyword%' or detail like '%$keyword%') and status=1";
          }
          if($sort!=null&$keyword==null){
            $sql = "select * from item_wanted where sort='$sort' and status=1";
          }
          if($sort!=null&$keyword!=null){
            $sql = "select * from item_wanted where ((name like '%$keyword%' or detail like '%$keyword%') and sort='$sort') and status=1";
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
  switch ($sorting) {

    case 'date':
    $order_by="ORDER BY id DESC";
    break;
    
    case 'date_revert':
    $order_by="ORDER BY id ASC";
    break;

    case 'price':
    $order_by="ORDER BY price asc";
    break;

    case 'price_revert':
    $order_by="ORDER BY price DESC";
    break;

    default:
    $order_by="ORDER BY id DESC";
    break;
  }

//for test
//echo $start.$per; 
  if($sort==null&$keyword==null){
    $sql2 = "select * from item_wanted where status=1 ".$order_by." limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort==null&$keyword!=null){
  $sql2 = "select * from item_wanted where (name like '%$keyword%' or detail like '%$keyword%') and status=1 ".$order_by." limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort!=null&$keyword==null){
  $sql2 = "select * from item_wanted where sort='$sort' and status=1 ".$order_by." limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort!=null&$keyword!=null){
  $sql2 = "select * from item_wanted where ((name like '%$keyword%' or detail like '%$keyword%') and sort='$sort') and status=1 ".$order_by." limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
$number_of_row=mysqli_num_rows($result2);
$totalCount = ceil($number_of_row/4)*4;
//每頁起始資料序號
//$result2 = mysqli_query('SELECT * FROM table LIMIT ' . $start . ', ' . $per); 
//while($data2 = mysql_fetch_row($result2)) { 
//    print_r($data2); 
//}

?>
<span style="font-size:23px;margin-left:20px;">有<span style="color:red;"><?php echo $total_records;?></span>項商品符合需求</span>
</div>
</form>
</div>


<!-- 商品展示-->
<div class="row" style="padding-top:10px;">
  <div class="col-md-10 col-md-offset-1">

    <center><div style="margin:10px 0px 5px 0px"><font color="#FF0000" size="5"><?php echo $notice;?></font></div></center>

<table>
  <?php
  $number_of_row=mysqli_num_rows($result2);
  $totalCount = ceil($number_of_row/4)*4;
  for($k = 0; $k < $totalCount; $k ++) {

    if($k%4 == 0) { echo '<tr class="row item_list_row">'; }

    if($row = mysqli_fetch_array($result2)) {
      echo '<td class="col-xs-9 col-md-3 col-md-offset-1">
      <div class="item_wrapper">
        <a href="show_wanted_detail.php?id='.$row['id'].'"><div class="item_title" style="min-height: 30px;">'.$row[name].'</div></a>
        <div>需求描述：'.$row[detail].'</div>
        <div class="item_value">徵求價格：$'.$row[price].'</div>
        <div>上架日期：'.$row[date].'</div>
      </div></td>';
    }
    else {
      echo '<td style="width:279px"></td>';
    }

    if($k%4 == 3) { echo '</tr><tr><td style="height: 20px;"></td></tr>'; }

  }

  ?>

    </table>
    <?php for($i=1;$i<=$pages;$i++) { 
      echo "<a href=\"show_item_wanted.php?keyword=".$keyword."&sort=".$sort."&sorting=".$sorting."&page=".$i."\"><span class=\"item_pagination\">".$i."</span></a>"; 
    }
    ?>

</div>    
</div>
</center>
</div><!-- // end #main -->
<? include("footer.php");?>