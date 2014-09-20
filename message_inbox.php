<? include("header.php");

if (isset($_SESSION['MM_Username'])){

?>

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

            $username=$_SESSION['MM_Username'];
            $user_id=$_SESSION['MM_UserID'];

            include_once("mysql_info.php");  

            //0 未讀 1已讀 2刪除
            $sql = "select active from member where id='$user_id'";
            $result = mysqli_query($link,$sql);
            $check_active = mysqli_fetch_array($result);

            $sql = "select ms.username as sender, mr.username as reciever, msg.* from member ms, member mr, message msg where mr.id = msg.to and ms.id = msg.from and mr.id='$user_id' and msg.receiver_status in (0,1) order by msg.id desc";

            $result = mysqli_query($link,$sql); // 執行SQL查詢引

            $id=$_GET["id"];

            if($check_active[active]==1){
            ?>

      			<table class="table table-striped table table-hover" style="margin:15px 0px 15px 0px">

              <tr><th class="col-md-2">寄件人</th><th class="col-md-6">主旨</th><th class="col-md-2">日期/時間</th><th class="col-md-2">動作</th></tr>

                <?php

                $number_of_row=mysqli_num_rows($result);

                for($k = 0; $k < $number_of_row; $k ++) {

                	if($row = mysqli_fetch_array($result)){

                    echo '<tr ';
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
                    </form><tr>';
                    
                    if($id==$row[id]){//開啟訊息
                        mysqli_query ($link,"update message set receiver_status= 1 where id='$id'");
                    		echo '<tr><td colspan="1"></td><td class="info" colspan="3">'.nl2br($row[body]).'</td></tr>';    		
        	          }
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

