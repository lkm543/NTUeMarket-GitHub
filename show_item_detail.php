<? include("header.php");?>

<!-- First, add jQuery (and jQuery UI if using custom easing or animation -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

<!-- Second, add the Timer and Easing plugins -->
<script type="text/javascript" src="GalleryView/js/jquery.timers-1.2.js"></script>
<script type="text/javascript" src="GalleryView/js/jquery.easing.1.3.js"></script>

<!-- Third, add the GalleryView Javascript and CSS files -->
<script type="text/javascript" src="GalleryView/js/jquery.galleryview-3.0-dev.js"></script>
<link type="text/css" rel="stylesheet" href="GalleryView/css/jquery.galleryview-3.0-dev.css" />

<!-- Lastly, call the galleryView() function on your unordered list(s) -->
<script type="text/javascript">
  $(function(){
    $('#myGallery').galleryView({panel_width: 450, panel_height: 250, frame_width: 75,frame_height: 40,frame_gap: 0, transition_speed: 500,});
  });
</script>


<div id="main">

  <div class="row">

    <div class="col-md-5 col-md-offset-1">

      <?php 

      session_start();

//若無，則為加入興趣清單時未登入的回傳

      if($_GET['id']!=NULL){

       $id=$_GET['id'];}

       include_once("mysql_info.php");

       $sql = "select m.id, m.username, i.* from member m, item_forsell i where i.owner = m.id and i.id='$id'";

$result = mysqli_query($link,$sql); // 執行SQL查詢

$row = mysqli_fetch_array($result);?>
  <table>
    <tr>
      <td>
      <center>
      <div style="margin-bottom:10px">
       <ul id="myGallery">
        <?php 
        $number=$row[img_count];
        for($i=1;$i<=$number;$i++)
        {
          echo '<li><img src="Picture/'.$row[filename].'_'.$i.'.jpg" /></li>';
        }
        ?>
      </ul>
      </div>
      </center>
      </td>
    </tr>
    <tr>
      <td>
        <form action="send_message.php" method="post">
          <input type="hidden" name="item_type" value="sell">
          <input type="hidden" id="receiver" name="receiver" value="<?php echo $row[username];?>">
          <input type="hidden" id="id" name="id" value="<?php echo $row[id];?>">
          <input type="hidden" id="subject" name="subject" value="<?php echo $row[name];?>">
          <input type="hidden" id="content" name="content" value="<?php echo "商品內容:".$row[name]."\n商品描述:".$row[detail]."\n商品價格:".$row[price]."\n交易方式:".$row[method]."\n聯絡email:".$row[contact_email]."\n手機:".$row[phone];?>">

          <input type="submit" value="加到興趣清單" class="btn btn-success" formaction="add_interested.php" style="margin:0px 5px">
          <input type="submit" value="丟私人訊息" class="btn btn-info" style="margin:0px 5px">
          <input type="submit" value="回報已成交/閒置" formaction="report_idle.php" class="btn btn-warning" style="margin:0px 5px;">
          <button class="fb-share-button btn btn-primary" style="width:100px;height:33px;margin:0px 5px;" data-href="http://collegebazaar.tw/show_item_detail.php?id=<?php echo $row[id];?>"></button>

        </form>
      </td>
    </tr>
    <tr>
      <td>
        <div class="fb-comments" style="margin-top:10px;padding-bottom:10px;"data-href="http://collegebazaar.tw/show_item_detail.php?id=<?php echo $row[id];?>" data-width="500" data-numposts="10" data-colorscheme="light">
        </div>
      </td>
    </tr>
  </table>



</div>
<div class="col-md-6">


  <font color="#FF0000" size="5">
    <?php echo $notice;?>
  </font>
  <table id="item_info_table" >

  <tr>

    <td style="width:30%">商品名稱</td>

    <td style="width:70%"><?php echo $row[name];?></td>

  </tr>

  <tr>

    <td>商品描述</td>

    <td><?php echo nl2br($row[detail]);?></td>

  </tr>

  <tr>

    <td>商品價格</td>

    <td><?php echo '$'.$row[price];?></td>

  </tr>

  <tr>

    <td>交易方式</td>

    <td><?php echo $row[method];?></td>

  </tr>

  <tr>

    <td>聯絡email</td>

    <td><?php echo $row[contact_email];?></td>

  </tr>

  <tr>

    <td>手機</td>

    <td><?php echo $row[phone];?></td>

  </tr>

  <tr>

    <td>私人訊息</td>

    <td><?php 

      if($row[msg_welcome]==1)

        {echo "歡迎私訊";} 

      if($row[msg_welcome]==2)

        {echo "不常用，以其他聯絡方式為主";}?></td>

    </tr>

    <tr>

      <td>上架日期</td>

      <td><?php echo $row[date];?></td>

    </tr>
  </tr>
</table>
</div>
</div>
</div>
</div>
<? include("footer.php");?>