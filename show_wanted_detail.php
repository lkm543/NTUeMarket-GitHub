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
<form role="form" action="show_item.php" method="get">
  <div class="form-group">
    <label for="InputKeyword">關鍵字搜尋</label>
   <input type="text" class="form-control" placeholder="關鍵字" size="10" name="keyword">  
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
			session_start();
			$id=$_GET['id'];
			include_once("mysql_info.php");
$sql = "select * from item_wanted where id='$id'";
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
if($row['msg_welcome']==1)
{echo "歡迎私訊";} 
if($row['msg_welcome']==2)
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
<center><input type="submit" value="加到興趣清單" class="btn btn-default" formaction="add_interested.php">&nbsp;&nbsp;<input type="submit" value="丟私人訊息" class="btn btn-default"></center></form></td></tr>
</table></div></div><center>
            </div>
        </div>
       </center>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>