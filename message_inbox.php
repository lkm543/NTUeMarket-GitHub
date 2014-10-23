<? include("header.php");


if (isset($_SESSION['MM_Username'])){

  ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#flip").click(function(){
        $("this.#panel").slideToggle("slow");
      });
    });
  </script>

  <div id="main">

    <center>

      <div class="row">
        <div class="col-md-1">

        </div>

        <div class="col-md-2" align="left">
          <div id="search">

            <table class="table table-hover">

              <tr><td onClick="location.href='send_message.php'"><center>撰寫新郵件</center></td></tr>

              <tr><td class="active" onClick="location.href='message_inbox.php'"><center>收&nbsp;&nbsp;&nbsp;件&nbsp;&nbsp;&nbsp;&nbsp;夾</center></td></tr>

              <tr><td onClick="location.href='sent_message_area.php'"><center>寄&nbsp;件&nbsp;備&nbsp;份</center></td></tr>

              <tr><td onClick="location.href='garbage_message_area.php'"><center>垃&nbsp;&nbsp;&nbsp;圾&nbsp;&nbsp;&nbsp;桶</center></td></tr>

            </table>
          </div>
        </div>

        <div class="col-md-8">

          <?php 

          include_once("mysql_info.php");  

            //0 未讀 1已讀 2刪除
          $sql = "select active from member where username='$username'";
          $result = mysqli_query($link,$sql);
          $check_active = mysqli_fetch_array($result);

          $sql = "select ms.username as sender, mr.username as reciever, msg.* from member ms, member mr, message msg where mr.id = msg.to and ms.id = msg.from and mr.id='$user_id' and msg.receiver_status in (0,1) order by msg.id desc";

            $result = mysqli_query($link,$sql); // 執行SQL查詢引

            $id=$_GET["id"];

            if($check_active[active]==1){
              ?>

              <!--<table class="table table-striped table table-hover" style="margin:15px 0px 15px 0px"> !-->

              <!--  <tr><th class="col-md-2">寄件人</th><th class="col-md-6">主旨</th><th class="col-md-2">日期/時間</th><th class="col-md-2">動作</th></tr>!-->
              <div class="row" align="left" style="font-size:16px;font-weight:bold;background-color: #ADD8E6">
                <div class="col-md-2">寄件人</div>
                <div class="col-md-5">主旨</div>
                <div class="col-md-3">日期/時間</div>
                <div class="col-md-2">動作</div>
              </div>
              <?php

              $number_of_row=mysqli_num_rows($result);

              for($k = 0; $k < $number_of_row; $k ++) {

               if($row = mysqli_fetch_array($result)){
                if($k%2==0){
                  echo '<div class="row" align="left" style="font-size:14px;background-color: #FAF0E6" id="flip">';
                }
                else{
                  echo '<div class="row" align="left" style="font-size:14px;background-color: #FFEFD5">';
                }

                echo '<div class="col-md-2">'.$row[sender].'</div>
                <div class="col-md-5">'.$row[subject].'</div>
                <div class="col-md-3">'.$row[date].'</div>
                <div class="col-md-2">
                  <form action="delete_message_re.php" method="post">
                    <input type="submit" value="回覆" class="btn btn-success" style="margin: 2px" formaction="send_message.php">
                    <input type="submit" value="刪除" class="btn btn-danger" style="margin: 2px">
                    <input type="hidden" value="'.$row[id].'" name="id">
                    <input type="hidden" value="'.$row[date].'" name="date">
                    <input type="hidden" value="'.$row[sender].'" name="sender">
                    <input type="hidden" value="'.$row[subject].'" name="reply_subject">
                    <input type="hidden" value="'.$row[body].'" name="reply_content"></td>
                  </form>
                </div>
                <div class="col-md-12" class="panel">.'.$row[body].'</div>
              </div>';
                /*
                echo '<div id="flip"><tr ';
                $class = "";

                if($id==$row[id]){
                 $class='class="info" ';
               }

                    if($row[receiver_status]==0){//未讀
                      $class='class="success" ';
                      echo $class.'style="font-weight: bold; font-size:16px;" ';
                    }
                    
                    echo $class.'onClick="location.href=\'message_inbox.php?id='.$row[id].'\'">
                    <form action="delete_message_re.php" method="post">
                      <td class="col-md-2">'.$row[sender].'</td>
                      <td class="col-md-6">'.$row[subject].'</td>
                      <td class="col-md-2">'.$row[date].'</td>
                      <td class="col-md-2">
                        <input type="submit" value="回覆" class="btn btn-success" style="margin: 2px" formaction="send_message.php">
                        <input type="submit" value="刪除" class="btn btn-danger" style="margin: 2px">
                        <input type="hidden" value="'.$row[id].'" name="id">
                        <input type="hidden" value="'.$row[date].'" name="date">
                        <input type="hidden" value="'.$row[sender].'" name="sender">
                        <input type="hidden" value="'.$row[subject].'" name="reply_subject">
                        <input type="hidden" value="'.$row[body].'" name="reply_content"></td>
                      </form><tr></div>';
                      echo '<div id="panel"><tr><td colspan="1"></td><td class="info" colspan="3">'.nl2br($row[body]).'</td></tr></div>';    

                    if($id==$row[id]){//開啟訊息
                      mysqli_query ($link,"update message set receiver_status= 1 where id='$id'");

                    }
                    */
                  }
                }
              }else{
                echo "<center>您的帳號尚未啟用，請至信箱收取驗證信。</center>";
              }?></table>

              <div class="col-md-1"></div>
            </div>
          </center>
        </div><!-- // end #main -->


        <?php
      }else{
        echo '請先登入！';
      }

      include("footer.php");?>

