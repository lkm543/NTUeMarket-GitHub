<div>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#btn_reply").click(function(){
        $("#sendMsgDiv").slideDown();
      });
    }
    </script>
    <?php 
    if(isset($_GET['id'])){
      include_once("mysql_info.php");
      $user_id = $_GET['id'];
        //0 未讀 1已讀 2刪除
      $sql = "select active from member where id='$user_id'";
      $result = mysqli_query($link,$sql);
      $check_active = mysqli_fetch_array($result);

      $sql = "select ms.username as sender, mr.username as reciever, msg.* from member ms, member mr, message msg where mr.id = msg.to and ms.id = msg.from and mr.id='$user_id' and msg.receiver_status in (0,1) order by msg.id desc";

        $result = mysqli_query($link,$sql); // 執行SQL查詢引

        $id=$_GET["id"];

        if($check_active[active]==1){
          ?>

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
                <input id="btn_reply" type="button" value="回覆" class="btn btn-success" style="margin: 2px">
                <input id="btn_del_msg" type="button" value="刪除" class="btn btn-danger" style="margin: 2px">
                <input type="hidden" value="'.$row[id].'" name="id">
                <input type="hidden" value="'.$row[date].'" name="date">
                <input type="hidden" value="'.$row[sender].'" name="sender">
                <input type="hidden" value="'.$row[subject].'" name="reply_subject">
                <input type="hidden" value="'.$row[body].'" name="reply_content"></td>
              </form>
            </div>
            <div class="col-md-12" class="panel">.'.$row[body].'</div>
            </div>';

            }
          }
        }else{
          echo "<center>您的帳號尚未啟用，請至信箱收取驗證信。</center>";
        }

      }else{
          echo "<center>查無使用者。</center>";
        }?>

  <div class="col-md-1"></div>
</div>