<? include("header.php");?>
	<div id="main">
        <div class="row">
            <div class="col-md-1">
       		   </div>
            <div class="col-md-2" align="left">
       		      <table class="table table-hover">
<tr><td class="success" onClick="location.href='management.php'"><center>我的商品</center></td></tr>
<tr><td onClick="location.href='management_wanted.php'"><center>我的需求</center></td></tr>
<tr><td onClick="location.href='management_removed.php'"><center>已下架商品/需求</center></td></tr>
<tr><td onClick="location.href='management_idle.php'"><center>閒置商品/需求</center></td></tr>
</table>     
            </div>
  			<div class="col-md-9">
       


        <?php 
$username=$_SESSION['MM_Username']; 
include_once("mysql_info.php");
$sql = "select m.id, m.username, i.* from member m, item_forsell i where m.id = i.owner and m.username = '$username' and status = 1 order by i.id desc"; 
$result = mysqli_query($link,$sql); 
$total_fields=mysqli_num_fields($result); // 取得欄位數
$total_records=mysqli_num_rows($result);  // 取得記錄數
?>


<?php

  $totalCount = ceil($total_records/3)*3;
  echo '<table align=left>';
  for($k = 0; $k < $totalCount; $k ++) {

        if($k%3 == 0) { echo '<tr class="row">'; }

        if($row = mysqli_fetch_array($result)) {
            echo '<td class="col-xs-9 col-md-4 col-md-offset-1">
                    <div class="item_wrapper" style="margin-bottom:20px">
                    <form action="management_database.php" method="post" style="max-width:360px">
                      <table class="manage_item_table" width="100%">
                        <tr>
                          <td colspan="2">
                            <div class="item_img_wrapper" style="background:url(Picture/'.$row[filename].'_1.jpg) no-repeat center center; background-size:230px"></div>
                          </td>
                        </tr>
                        <tr>
                          <td style="min-width:35px">名稱</td>
                          <td>
                              <input type="text" name="name" class="form-control" value="'. $row[name].'">
                              <input type="hidden" name="id" value="'.$row[id].'"/>
                          </td>
                        </tr>
                        <tr>
                          <td style="vertical-align:middle;">描述</td>
                          <td style="max-width:360px">
                            <textarea name="detail" id="detail" pattern=".{0,100}" class="form-control" rows="3">'.$row[detail].'</textarea>
                          </td>
                        </tr>
                        <tr>
                          <td>價格</td>
                          <td>
                            <input type="text" name="price" class="form-control" value="'.$row[price].'">
                          </td>
                        </tr>
                        <tr>
                          <td>方式</td>
                          <td>
                            <input type="text" name="method" class="form-control" value="'.$row[method].'">
                          </td>
                        </tr>
                        <tr>
                          <td>分類</td>
                          <td>
                            <select name="sort" id="sort" class="form-control">'; ?>
                            <option value="life" <?php if ($row[sort]=="life") echo 'selected="selected"';?>>生活用品</option>
                            <option value="stationary" <?php if ($row[sort]=="stationary") echo 'selected="selected"';?>>文具</option>
                            <option value="clothes" <?php if ($row[sort]=="clothes") echo 'selected="selected"';?>>衣物</option>
                            <option value="3c" <?php if ($row[sort]=="3c") echo 'selected="selected"';?>>3c產品</option>
                            <option value="bike" <?php if ($row[sort]=="bike") echo 'selected="selected"';?>>腳踏車</option>
                            <option value="book" <?php if ($row[sort]=="book") echo 'selected="selected"';?>>課外讀物</option>
                            <option value="textbook" <?php if ($row[sort]=="textbook") echo 'selected="selected"';?>>教科書</option>
                            <option value="else" <?php if ($row[sort]=="else") echo 'selected="selected"';?>>其他</option>
                            <?php 
                    echo '</select></td></tr><tr>
                          <td colspan="2">
                            <center><input type="submit" value="修改" class="btn btn-success">
                            <input type="hidden" value="item" name="type">
                            <input type="submit" value="下架" class="btn btn-danger" formaction="delete_item.php""></center>
                          </td>
                        </tr>
                      </table>
                    </form>
                    </div>
                  </td>';
        }
        else{
          echo "<td class=\"col-xs-9 col-md-4 col-md-offset-1\"></td>";
        }

        if($k%3 == 2) {
          echo '</tr>';
        }
  }
  echo '</table>';
  ?>

        </div>
        </div>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>