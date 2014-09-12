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
			include_once("function/mysql_info.php");
$sql = "select * from goods_wanted where id='$id'";
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
<td>需求名稱</td>
<td><?php echo $row['name'];?></td>
</tr>
<tr>
<td>需求描述</td>
<td><?php echo nl2br($row['detail']);?></td>
</tr>
<tr>
<td>徵求價格</td>
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
<td>徵求日期</td>
<td><?php echo $row['date'];?></td>
</tr>
<tr>
</tr>
<tr><td colspan="2">
<form action="send_message.php" method="post"><input type="hidden" name="receiver" value="<?php echo $row[owner];?>"><input type="hidden" name="id" value="<?php echo $row['id'];?>"><input type="hidden" name="subject" value="<?php echo "商品：".$row[name];?>"><input type="hidden" name="id" value="<?php echo$row[id];?>">
<input type="hidden" name="content" value="<?php echo "需求名稱:".$row[name]."\n需求描述:".nl2br($row['detail'])."\n徵求價格:".$row['price']."\n交易方式:".$row[method]."\n聯絡email:".$row['contact_email']."\n手機:".$row['phone'];?>">
<center><input type="submit" value="加到興趣清單" formaction="function/add_interested.php">&nbsp;&nbsp;<input type="submit" value="丟私人訊息">&nbsp;&nbsp;<input type="submit" value="回報已成交">&nbsp;&nbsp;<input type="submit" value="回上一頁"></center></form></td></tr>
</table></div></div><center>
            </div>
        </div>
       </center>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>