<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="我們試圖建立一個屬於台大人的二手交換電子商務平台，你可能會有想要買/賣/贈送的二手教科書，要搬家出清的家具、用不到的衣服雜物。你可以藉由社群成員具有需求同質性高、地利之便的優勢，很快找到買/賣家、很方便遞交/接收物品，最重要的是能讓物盡其用，每一分資源都不被浪費。" />
    <meta name="keywords" content="台大,二手物,交換平台,電子商務" />
    <title>NTUeMarket</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" />	
	<link href="css/nivo-slider.css" rel="stylesheet" type="text/css" />
    <!--[if IE]><link href="css/style-sie.css" rel="stylesheet" type="text/css" /><![endif]-->
    <!-- jQuery (使用Bootstrap的JavaScript外掛) -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- jQuery (使用Bootstrap的JavaScript外掛) -->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$('#slideshow').nivoSlider({
				directionNav: false
			});
		});
	</script>
        <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style-ie.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 shim 和 Respond.js 讓IE8支援HTML5元素和媒體查詢 -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    <!-- 在下面加入所有已編譯外掛，或是當需要時加入獨立檔案 -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

<div id="wrapper">
<? include("header.php");
session_start();
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
			if($Subject!=NULL){
				$Subject="Re-".$Subject;
				}
			$Receiver=$_POST['receiver'];
			$Content=$_POST['content'];
			echo $Message;?>
			<form action="send_message_database.php" method="POST">
            <table>
            <tr><td>收件人</td><td width="90%"><input type="text" name="receiver" class="form-control" value="<?php echo $Receiver;?>"/></td></tr>
            <tr><td>主旨</td><td><input type="text" name="subject" class="form-control" value="<?php echo $Subject;?>"/></td></tr>
            <tr><td>內容</td><td><textarea class="form-control" rows="10" name="content" value=><?php 
			if ($Content!=NULL){
			echo "\nRe:\n-------------------------------------------------------------------\n".$Content;
			}?></textarea></td></tr>
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

