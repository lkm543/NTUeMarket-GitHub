<? include("header.php");?>
<div id="main">
  
    <div class="row">
      <div class="col-md-1">
      </div>
                        <div class="col-md-10">
                         <?php 
                         session_start();
                         $id=$_GET['id'];
                         include_once("mysql_info.php");
                         $sql = "select m.id, m.username, i.* from member m, item_wanted i where i.owner = m.id and i.id='$id'";
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
?><center>


    <table id="item_info_table">
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
          <td colspan="2" style="border-bottom:0px;">
            <form action="send_message.php" method="post">
              <input type="hidden" name="item_type" value="wanted">
              <input type="hidden" name="receiver" value="<?php echo $row[username];?>">
              <input type="hidden" name="id" value="<?php echo $row[id];?>">
              <input type="hidden" name="subject" value="<?php $row[name];?>">
              <input type="hidden" name="content" value="<?php echo "需求名稱:".$row[name]."\n需求描述:".nl2br($row[detail])."\n徵求價格:".$row[price]."\n交易方式:".$row[method]."\n聯絡email:".$row[contact_email]."\n手機:".$row[phone];?>">
              <input type="submit" value="加到興趣清單" class="btn btn-success" formaction="add_interested.php">&nbsp;&nbsp;
              <input type="submit" value="丟私人訊息" class="btn btn-info">
              <input type="submit" value="回報已成交/閒置" formaction="report_idle.php" class="btn btn-warning" style="margin:0px 5px;">
            <div class="fb-share-button btn btn-primary" style="width:100px;height:33px;margin:0px 5px;" data-href="http://collegebazaar.tw/show_wanted_detail.php?id=<?php echo $row[id];?>"></div>
            
          </form>

        </td>
      </tr>

    </table>
    <div class="fb-comments" style="margin-top:10px;padding-bottom:10px;"data-href="http://collegebazaar.tw/show_wanted_detail.php?id=<?php echo $row[id];?>" data-width="500" data-numposts="10" data-colorscheme="light"></div>
</center>
  </div>

</div><!-- // end #main -->
<? include("footer.php");?>