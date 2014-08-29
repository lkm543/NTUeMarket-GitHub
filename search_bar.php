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