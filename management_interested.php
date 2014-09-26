<?php include("header.php");?>

<div id="main">
  <div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-11">
         <?php 
      include_once("mysql_info.php");
      $result2=mysqli_query($link,"select * from member where username='$username'");
      $row2 = mysqli_fetch_array($result2);
      $interest_array=array();
      $interest_array=unserialize($row2[interested]);
      $interest_forsell=array();
      $interest_wanted=array();

      if($interest_array!=NULL){

        foreach($interest_array as $item){
         $type=explode("_",$item);
         if(strcmp($type[0],"s")===0){
          array_push($interest_forsell, $type[1]);
        }elseif(strcmp($type[0],"w")===0){
          array_push($interest_wanted, $type[1]);
        }
      }

      $sql = "select * from item_forsell where status=1 and `id` in (".implode(",",$interest_forsell).")"; 
    //test用
    //echo implode(",",$interest_array);
    $result = mysqli_query($link,$sql); // 執行SQL查詢
    $total_fields=mysqli_num_fields($result); // 取得欄位數
    $number_of_row=mysqli_num_rows($result); // 取得記錄數
    $totalCount = ceil($number_of_row/4)*4;
    if ($number_of_row==0){
      echo '<table><tr><th colspan="4"><p style="font-size:20px;">您目前沒有追蹤任何商品</p></th></tr></table>';
    }
    else{
      echo '<table><tr><th colspan="4"><p style="font-size:20px;">追蹤商品一覽</p></th></tr>';

      for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr class="row item_list_row">'; }

        if($row = mysqli_fetch_array($result)) {
          echo '<td class="col-xs-9 col-md-3 col-md-offset-1">
          <div class="item_wrapper" >
            <div class="item_title">'.$row[name].'</div>
            <a href="show_item_detail.php?id='.$row[id].'">
              <div class="item_img_wrapper" style="background:url(Picture/'.$row[filename].'_1.jpg) no-repeat center center; background-size:100%"></div></a>
              <div class="item_value">出價金額: $'.$row[price].'</div>
              <div>上架日期: '.$row[date].'</div>
              <div><center>
                <form action="delete_interested.php" method="post">
                  <input type="submit" value="取消追蹤" class="btn btn-default">
                  <input type="hidden" name="item_type" value="sell"/>
                  <input type="hidden" name="id" value="'.$row[id].'"/></center></form>
                </div></td>';
              }
              else{
                echo "<td class=\"col-xs-9 col-md-3 col-md-offset-1\"></td>";
              }

              if($k%4 == 3) { echo '</tr>'; }

            }

            echo "</table>";}
            $sql = "select * from item_wanted where status=1 and `id` in (".implode(",",$interest_wanted).")"; 
    $result2 = mysqli_query($link,$sql); // 執行SQL查詢
    $total_fields=mysqli_num_fields($result2); // 取得欄位數
    $number_of_row=mysqli_num_rows($result2); // 取得記錄數
    $totalCount = ceil($number_of_row/4)*4;
    if ($number_of_row==0){
      echo '<table><tr><td>&nbsp;</td></tr><tr><th colspan="4"><p style="font-size:20px;">您目前沒有追蹤任何徵求</p></th></tr></table>';
    }
    else{
      echo '<table style="margin-top:20px"><tr><th colspan="4"><p style="font-size:20px;">追蹤需求一覽</p></th></tr>';

      for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr class="row item_list_row">'; }

        if($row2 = mysqli_fetch_array($result2)) {
          echo '<td class="col-xs-9 col-md-3 col-md-offset-1">
          <div class="item_wrapper">
            <a href="show_wanted_detail.php?id='.$row2['id'].'">
              <div class="item_title" style="min-height: 30px;">'.$row2[name].'</div></a>
              <div class="item_value">出價金額: $'.$row2[price].'</div>
              <div>上架日期: '.$row2[date].'</div>
              <div><center>
                <form action="delete_interested.php" method="post">
                  <input type="submit" value="取消追蹤" class="btn btn-default">
                  <input type="hidden" name="item_type" value="wanted"/>
                  <input type="hidden" name="id" value="'.$row2[id].'"/></center></form>
                </div></td>';
              }
              else{
                echo "<td class=\"col-xs-9 col-md-3 col-md-offset-1\"></td>";
              }

              if($k%4 == 3) { echo '</tr>'; }

            }

            echo "</table>";}
          }else{
            echo "<br><br><br><br><br>您目前沒有追蹤任何商品或需求<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
          }
          ?>
    </div>
  </div>
</div><!-- // end #main -->

<?php include("footer.php");?>