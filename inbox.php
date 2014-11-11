<? include("header.php");

if (isset($_SESSION['MM_Username'])){

  $username = $_SESSION['MM_Username'];
  $user_id = $_SESSION['MM_UserID'];

  ?>
  <script type="text/javascript">
    $(document).ready(function(){
      load_message('load_inbox.php', 'btn_inbox');
      $('#sendMsgDiv').hide();

      $('#btn_newMsg').click(function() {
		new_message(false, '', '', '');
	  });

	  $('#sendMsg').click(function(){
	  	send_message();
	  });

	  $('#cancelMsg').click(function() {
	  	var response = confirm('Do you want to discard the message?');
	  	if(response){
	  		clear_msg_box();
			$("#sendMsgDiv").slideUp();
		}
      });

	  $('#btn_reply').click(function(){
	  	$('#sendMsgDiv').slideDown();
	  });
	});
  </script>

  <script>
	function load_message(page, element)
	{
	var xmlhttp;
	var url = page;
	var elementID = element;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    document.getElementById("mailbox").innerHTML=xmlhttp.responseText;
	    $("td").removeClass("active");
	    $("#"+elementID).addClass("active");
	    }
	  }
	xmlhttp.open("GET",url+"?id=<?php echo $user_id; ?>",true);
	xmlhttp.send();
	}

	function new_message (isReply, receiver, subject, content) {
		var recieverBox = document.getElementById('receiver2');
		var subjectBox = document.getElementById('subject2');
		var contentBox = document.getElementById('content2');
		if(isReply==true){
			clear_msg_box();
		}else{
			recieverBox.value = receiver;
			subjectBox.value = subject;
			contentBox.value = content;
		}
		$('#sendMsgDiv').slideDown();
	}

	function clear_msg_box () {
		var recieverBox = document.getElementById('receiver2');
		var subjectBox = document.getElementById('subject2');
		var contentBox = document.getElementById('content2');
		recieverBox.value = "";
		subjectBox.value = "";
		contentBox.value = "";
	}

	function send_message()
	{
		$('#sendMsgDiv').slideUp();
	}
  </script>

  <div id="main">

    <center>

      <div class="row">
        <div class="col-md-1">

        </div>

        <div class="col-md-2" align="left">
          <div id="search">

            <table class="table table-hover">

              <tr><td id="btn_newMsg"><center>撰寫新郵件</center></td></tr>

              <tr><td id="btn_inbox" class="active" onClick="load_message('load_inbox.php', 'btn_inbox')"><center>收&nbsp;&nbsp;&nbsp;件&nbsp;&nbsp;&nbsp;&nbsp;夾</center></td></tr>

              <tr><td id="btn_sent" onClick="load_message('load_sent.php', 'btn_sent')"><center>寄&nbsp;件&nbsp;備&nbsp;份</center></td></tr>

              <tr><td id="btn_garbage" onClick="load_message('load_garbage.php', 'btn_garbage')"><center>垃&nbsp;&nbsp;&nbsp;圾&nbsp;&nbsp;&nbsp;桶</center></td></tr>

            </table>
          </div>
        </div>


	    <div id="sendMsgDiv">

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
	          ?>

	          <form id="messageBox" action="send_message_database.php"  class="col-xs-12 col-md-5 col-md-offset-3" method="POST">
			    <fieldset>
			      <label for="name">收件人</label>
			      <input type="text" id="receiver2" name="receiver2" class="form-control" value="<?php echo $Receiver;?>"/>
			      <label for="email">主旨</label>
				  <input type="text" id="subject2" name="subject2" class="form-control" value="<?php echo $Subject;?>"/>			      
				  <label for="password">內容</label>
			      <textarea class="form-control" rows="10" id="content2" name="content2" value=""/><?php echo $Content;?></textarea>
			 
			      <!-- Allow form submission with keyboard without duplicating the dialog button -->
			      <div style="padding-top:10px; text-align:center"><input id="sendMsg" type="button" value="寄送" class="btn btn-success" style="margin: 2px; width:45%" formaction="send_message.php">
                  <input id="cancelMsg" type="button" value="放棄" class="btn btn-danger" style="margin: 2px;  width:45%"></div>
			    </fieldset>
			  </form>

	     </div>

        <div id="mailbox" class="col-md-8"></div>
    </center>
  </div><!-- // end #main -->


        <?php
      }else{
        echo '請先登入！';
      }

include("footer.php");?>