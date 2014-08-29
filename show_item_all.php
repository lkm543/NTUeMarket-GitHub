<?php 
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
$sql = "select * from goods_test where status=1";
}
if($sort==null&$keyword!=null){
$sql = "select * from goods_test where (goods_name like '%$keyword%' or detail like '%$keyword%') and status=1";
}
if($sort!=null&$keyword==null){
$sql = "select * from goods_test where sort='$sort' and status=1";
}
if($sort!=null&$keyword!=null){
$sql = "select * from goods_test where ((goods_name like '%$keyword%' or detail like '%$keyword%') and sort='$sort') and status=1";
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
$sql2 = "select * from goods_test where status=1 ORDER BY id DESC limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort==null&$keyword!=null){
$sql2 = "select * from goods_test where (goods_name like '%$keyword%' or detail like '%$keyword%') and status=1 order by id desc limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort!=null&$keyword==null){
$sql2 = "select * from goods_test where sort='$sort' and status=1 ORDER BY id DESC limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}
if($sort!=null&$keyword!=null){
$sql2 = "select * from goods_test where ((goods_name like '%$keyword%' or detail like '%$keyword%') and sort='$sort') and status=1 ORDER BY id DESC limit ".$start.",".$per;
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
}

//每頁起始資料序號
//$result2 = mysqli_query('SELECT * FROM table LIMIT ' . $start . ', ' . $per); 
//while($data2 = mysql_fetch_row($result2)) { 
//    print_r($data2); 
//}

?>

<table>
<?php
$number_of_row=mysqli_num_rows($result2);
$totalCount = ceil($number_of_row/4)*4;
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result2)) {
                echo '<td style="width:230px">'.$row[goods_name].
                     '<br>$'.$row[price].
                     '<br>'.$row["date"].
					 '<br>'.
					 '<a href="show_item_detail.php?id='
					 .$row['id'].'"><img src="Picture/'.$row[filename].'" width="216" height="162" class="img-rounded"></a><br></td>';
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