<?php 
//mysqli為主 非mysql
//header('Content-type:text/html; charset=utf-8');
$keyword=$_GET[keyword];
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
//mysqli_query("SET NAMES 'utf8'"); 
//mysqli_query("set character set utf8",$link);
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
//mysqli_query("set character set utf8",$link);
//$mysqli->query("SET NAMES 'utf8'");
mysqli_select_db ($link,"a4904409_goods");  
//mysqli_query("set character set utf8",$link);
//mysql_query("SET NAMES 'utf8'");  
//mysqli_query("SET NAMES 'utf8'");  
$sql = "select * from goods_test where (goods_name like '%$keyword%' or detail like '%$keyword%' ORDER BY id DESC"; //在test資料表中選擇所有欄位
//mysqli_query($link, "SET CHARACTER SET utf8");// 送出Big5編碼的MySQL指令
//mysqli_query($link, "SET collation_connection ='utf8_general_ci'");
$result = mysqli_query($link,$sql); // 執行SQL查詢
//$row = mysqli_fetch_array($result); //將陣列以欄位名索引
//$row = mysqli_fetch_row($result); //將陣列以數字排列索引
$total_fields=mysqli_num_fields($result); // 取得欄位數
$total_records=mysqli_num_rows($result);  // 取得記錄數
?>


<strong><span size:"20px">關鍵字：&nbsp&nbsp"<? echo $keyword; ?>" &nbsp&nbsp的<? echo $total_records;?>個搜尋結果</span></strong>

<table>
<?php

$totalCount = ceil($total_records/4)*4;
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
                echo '<td style="width:230px">'.$row[goods_name].
                     '<br>'.$row[price].
                     '<br>'.$row["date"].
					 '<br>'.
					 '<img src="Picture/'.$row[filename].'"width="216" height="162" class="img-rounded"><br></td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}

?>
</table>

