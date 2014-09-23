<? include("header.php"); ?>
<div id="main">

<?php
if (isset($_SESSION['MM_Username'])){
  ?>
    <center>
      <div class="row">

          <div class="col-md-1"></div>

          <div class="col-md-2" align="left">
               <div id="search">

                <table class="table table-hover">

                  <tr><td class="active" onClick="location.href='send_message.php'"><center>撰寫新郵件</center></td></tr>

                  <tr><td onClick="location.href='message_inbox.php'"><center>收&nbsp;&nbsp;&nbsp;件&nbsp;&nbsp;&nbsp;&nbsp;夾</center></td></tr>

                  <tr><td onClick="location.href='sent_message_area.php'"><center>寄&nbsp;件&nbsp;備&nbsp;份</center></td></tr>

                  <tr><td onClick="location.href='garbage_message_area.php'"><center>垃&nbsp;&nbsp;&nbsp;圾&nbsp;&nbsp;&nbsp;桶</center></td></tr>

                </table>
              </div>
          </div>

          <div class="col-md-7">

            <?php 

            $Receiver = "";
            $Subject = "";
            $Content = "";

            if(isset($_POST['receiver'])&&isset($_POST['subject'])&&isset($_POST['content'])){
                $Receiver=trim($_POST['receiver']);
                $Subject=$_POST['subject'];
                $Content=$_POST['content'];

              if($Subject!=""){
                 $Subject="您好，關於您的商品: ".$Subject;
              }

              if($Content!=""){
                $Content = "\n請在這輸入您的訊息內容...\n\n-------------------------------------------------------------------\n".$Content;
              }
            }elseif(isset($_POST['sender'])&&isset($_POST['reply_subject'])&&isset($_POST['reply_content'])&&isset($_POST['date'])){
                $Receiver=trim($_POST['sender']);
                $Subject=$_POST['reply_subject'];
                $Content=$_POST['reply_content'];
                $Date=$_POST['date'];

              if($Subject!=""){
                if(strpos($Subject,'Re: ')===false){
                  $Subject="Re: ".$Subject;
                }
              }

              if($Content!=""){
                $Content = "\n請在這輸入您要回覆的內容...\n\n-------------------------------------------------------------------\n".$Receiver." <".$Date."> :\n\n".$Content;
              }
            }

            $username=$_SESSION['MM_Username'];
            include_once("mysql_info.php");

            $sql = "select active from member where username = '$username'"; //在資料表中選擇所有欄位
            $result = mysqli_query($link,$sql); // 執行SQL查詢
            $row = mysqli_fetch_array($result);
            if($row[active]==1){
              ?>

                <form action="send_message_database.php" method="POST">

                  <center><div style="margin:20px 0px 5px 0px"><font color="#FF0000" size="5"><?php echo $notice;?></font></div></center>

                  <table id="upload_table">

                    <tr><td>收件人</td><td width="90%"><input type="text" id="receiver2" name="receiver2" class="form-control" value="<?php echo $Receiver;?>"/></td></tr>

                    <tr><td>主旨</td><td><input type="text" id="subject2" name="subject2" class="form-control" value="<?php echo $Subject;?>"/></td></tr>

                    <tr><td>內容</td><td><textarea class="form-control" rows="10" id="content2" name="content2" value=""/><?php echo $Content;?></textarea></td></tr>

                     <tr><td></td><td><center><input type="submit" name="submit" class="form-control" value="寄送" /></center></td></tr>

                   </table>

                   </form>
                 <?php
            }else{
              echo "<center>您的帳號尚未啟用，請至信箱收取驗證信。</center>";
            }?>

          </div>
          <div class="col-md-2"></div>

      </div></center>
</div><!-- // end #main -->

  <?php

}else{  
$notice="您尚未登入，請註冊或登入以啟用此功能。";
include_once("login.php");
} ?>

<?php include("footer.php");?>