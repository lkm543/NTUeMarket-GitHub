<? include("header.php");
if (isset($_SESSION['MM_Username'])){
?>
<div id="main">
    <center>
        <div class="row">
            <div class="col-md-1">
       		   </div>
            <div class="col-md-2" align="left">
               <div id=search>
<table class="table table-hover">
<tr><td class="success" onClick="location.href='send_message.php'"><center>撰寫新郵件</center></td></tr>
<tr><td onClick="location.href='message_area.php'"><center>收&nbsp;&nbsp;&nbsp;件&nbsp;&nbsp;&nbsp;&nbsp;夾</center></td></tr>
<tr><td onClick="location.href='sent_message_area.php'"><center>寄&nbsp;件&nbsp;備&nbsp;份</center></td></tr>
<tr><td onClick="location.href='garbage_message_area.php'"><center>垃&nbsp;&nbsp;&nbsp;圾&nbsp;&nbsp;&nbsp;桶</center></td></tr>
</table>       		   ></div>
            </div>
  			<div class="col-md-7">
            <?php 
			$Subject=$_POST['subject'];
			$Subject2=$_POST['subject2'];
			$Receiver2=$_POST['receiver2'];
			$Content2=$_POST['content2'];
			if($Subject!=NULL){
				$Subject="Re-".$Subject;
				}
			$Receiver=$_POST['receiver'];
			$Content=$_POST['content'];
			echo $Message;?>
			<form action="send_message_database.php" method="POST">
            <center><div style="margin:20px 0px 5px 0px"><font color="#FF0000" size="5"><?php echo $notice;?></font></div></center>
            <table>
            <tr><td>收件人</td><td width="90%"><input type="text" name="receiver2" class="form-control" value="<?php echo $Receiver.$Receiver2;?>"/></td></tr>
            <tr><td>主旨</td><td><input type="text" name="subject2" class="form-control" value="<?php echo $Subject.$Subject2;?>"/></td></tr>
            <tr><td>內容</td><td><textarea class="form-control" rows="10" name="content2" value=><?php 
			if ($Content!=NULL){
			echo "\nRe:\n-------------------------------------------------------------------\n".$Content;
			} echo $Content2;?></textarea></td></tr>
            <tr><td></td><td><center><input type="submit" name="submit" class="form-control"/></center></td></tr>
            </table>
            </form>
			</div><div class="col-md-2"></div>
        </div>
       </center>
	</div><!-- // end #main -->

<?php
}
else{echo '請先登入！';}
?>


<? include("footer.php");?>
</body>
</html>

