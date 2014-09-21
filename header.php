<?php
session_start();
$username=$_SESSION['MM_Username'];
$user_id=$_SESSION['MM_UserID'];
$current_page = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="我們試圖建立一個屬於台大人的二手交換電子商務平台，你可能會有想要買/賣/贈送的二手教科書，要搬家出清的家具、用不到的衣服雜物。你可以藉由社群成員具有需求同質性高、地利之便的優勢，很快找到買/賣家、很方便遞交/接收物品，最重要的是能讓物盡其用，每一分資源都不被浪費。" />
    <meta name="keywords" content="台大,二手物,交換平台,電子商務" />

    <title>CollegeBazaar</title>

	<link href="bootstrap/css/nivo-slider.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/style-ie.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/style.css" rel="stylesheet" type="text/css" />  
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />  

    <!-- Bootstrap!-->

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Nivo Slider plugin!-->    

    <script type="text/javascript" src="bootstrap/js/jquery.nivo.slider.js"></script>
    <script src="bootstrap/js/jquery.nivo.slider.pack.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#slideshow').nivoSlider({
                controlNav: false, 
                directionNav: false
            });
        });
    </script>   

    <!-- Nivo Lightbox plugin! -->

    <link rel="stylesheet" href="bootstrap/css/nivo-lightbox.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/themes/nivo-lightbox/default/default.css" type="text/css" />
    <script src="bootstrap/js/nivo-lightbox.min.js"></script>

    <script>
        $(document).ready(function(){
            $('a').nivoLightbox();
        });
    </script>

    <!-- Fileinput plugin !-->

    <link href="bootstrap/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="bootstrap/js/fileinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">

    <!-- Other plugin !-->
    <script src="js/signup_validator.js" type="text/javascript"></script>


</head>

<body>

<div id="wrapper">

	<div id="header">

		<div class="container">

			<h1>

				<a href="/" title="CollegeBazaar">CollegeBazaar</a>

		  </h1>

		  <ul class="menu fr">

                 <li><a href="upload_area.php" <?php if($current_page=="upload_area.php"||$current_page=="upload_item_succeed.php") echo 'class="menu_item_selected"';?>>上傳商品</a></li>

                 <li><a href="upload_wanted.php" <?php if($current_page=="upload_wanted.php"||$current_page=="upload_wanted_succeed.php") echo 'class="menu_item_selected"';?>>公開徵求</a></li>

                 <li><a href="show_item.php" <?php if($current_page=="show_item.php"||$current_page=="show_item_detail.php") echo 'class="menu_item_selected"';?>>商品總覽</a></li>

                 <li><a href="show_item_wanted.php" <?php if($current_page=="show_item_wanted.php"||$current_page=="show_wanted_detail.php") echo 'class="menu_item_selected"';?>>需求總覽</a></li>

                 <li class="dropdown" id="twohandedmenu">

<?php //已經登入

if (isset($_SESSION['MM_Username'])){

    include_once("mysql_info.php");

    $sql="select count(id) as rows from message where `to`='$user_id' and receiver_status='0'";
    $result = mysqli_query($link,$sql); // 執行SQL查詢引
    $num_notice = mysqli_fetch_array($result);

?>
<a <?php if($current_page=="modify.php"||$current_page=="management_interested.php"||$current_page=="management_wanted.php"||$current_page=="management_idle.php"||$current_page=="management_removed.php"||$current_page=="management.php"||$current_page=="message_area.php"||$current_page=="garbage_message_area.php"||$current_page=="sent_message_area.php"||$current_page=="send_message.php") echo 'class="dropdown-toggle menu_item_selected"'; else echo 'class="dropdown-toggle"';?> data-toggle="dropdown" href="show_item.php"><?php echo $username;?><?php if($num_notice[rows]!=0) echo '<span style="vertical-align:top; display:inline-block;"><img src="images/message.jpg" width=20px></span>' ?><b class="caret"></b></a>

    <ul class="dropdown-menu">

        <li><a href="modify.php">修改資料</a></li>

        <li><a href="management_interested.php">興趣清單</a></li>

        <li><a href="management.php">管理商品</a></li>

		<li><a href="message_inbox.php">私人訊息<?php if($num_notice[rows]!=0) echo '<span id="notification" style="background-color:#FF0000; vertical-align:top; font-size:14px; border-radius:10px; padding:1px 6px; color:#FFFFFF; -webkit-box-shadow:0 1px 1px rgba(0, 0, 0, .7)">'.$num_notice[rows].'</span>'?></a></li>

        <li><a href="logout.php">登出</a></li>

<?php //尚未登入

} else{ ?><a <?php if($current_page=="registration.php"||$current_page=="login.php") echo 'class="dropdown-toggle menu_item_selected"'; else echo 'class="dropdown-toggle"';?> data-toggle="dropdown" href="show_item.php">會員註冊/登入<b class="caret"></b></a>

                        <ul class="dropdown-menu">

                        	<li><a href="registration.php">會員註冊</a></li>

                            <li><a href="login.php">會員登入</a></li> 

                            <?php }?>

                        </ul>

                </li>

		  </ul>

		</div>

	</div><!-- // end #header -->

