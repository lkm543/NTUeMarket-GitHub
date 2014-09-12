<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>NTUeMarket</title>
    <!-- Bootstrap!-->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap!-->
    <link href="bootstrap/css/style.css" rel="stylesheet" type="text/css" />	
	<link href="bootstrap/css/nivo-slider.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/style-ie.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="bootstrap/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/jquery.nivo.slider.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$('#slideshow').nivoSlider({
				directionNav: false
			});
		});
	</script>
</head>


<body>

<div id="wrapper">
	<div id="header">
		<div class="container">
			<h1><a href="/" title="CollegeBazaar">CollegeBazaar</a></h1>
		 	<ul class="menu fr">
                 <li><a href="upload_area.php">上傳商品</a></li>
                 <li><a href="upload_wanted.php">公開徵求</a></li>
                 <li><a href="show_item.php">商品總覽</a></li>
                 <li><a href="show_item_wanted.php">需求總覽</a></li>
                 <li class="dropdown" id="twohandedmenu"> 
				 <?php //已經登入
					if (isset($_SESSION['MM_Username'])){ ?>
				 <a class="dropdown-toggle" data-toggle="dropdown" href="#">會員專區</a>
                        <ul class="dropdown-menu">
                            <li><a href="modify.php">修改資料</a></li>
                            <li><a href="management.php">管理商品</a></li>
							<li><a href="message_area.php">私人訊息</a></li>
                            <li><a href="logout.php">登出</a></li>
                        </ul>
				<?php //尚未登入
				} else{ ?><a class="dropdown-toggle" data-toggle="dropdown" href="#">會員註冊/登入</a>
                        <ul class="dropdown-menu">
                        	<li><a href="registration.php">會員註冊</a></li>
                            <li><a href="login.php">會員登入</a></li> 
                            <?php }?>
                        </ul>
                </li>
                <li><a href="contact_us.php">聯絡我們</a></li>
			</ul>
		</div>
	</div><!-- // end #header -->

	<center>
	<div id="main">
    
		<div class="container">
			<div id="slideshow">
				<img src="images_index/slideshow/slideshow-1.jpg" alt="Slideshow Image" />
				<img src="images_index/slideshow/slideshow-2.jpg" alt="Slideshow Image" />
				<img src="images_index/slideshow/slideshow-3.jpg" alt="Slideshow Image" />
				<img src="images_index/slideshow/slideshow-4.jpg" alt="Slideshow Image" />
			</div><!-- // end #slideshow -->
			<div class="intro">
				<p>這是讓你和妳互通有無的網站</p>
			</div><!-- // end .intro -->      
            <table>
            <tr><td align="center">   
				<div class="column">
					<h2>二手書/教科書</h2>
					<div class="image"><img src="images_index/article/article-thumb-1.jpg" alt="Article Image" /></div>
					<p>二手書/教科書二手書/教科書二手書/教科書二手書/教科書二手書/教科書二手書/教科書二手書/教科書二手書/教科書</p>
				</div>
            </td><td align="center">
				<div class="column">
					<h2>穿的</h2>
					<div class="image"><img src="images_index/article/article-thumb-2.jpg" alt="Article Image" /></div>
					<p>穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿穿</p>
				</div>
            </td><td align="center">
                <div class="column">
					<h2>用的</h2>
					<div class="image"><img src="images_index/article/article-thumb-3.jpg" alt="Article Image" /></div>
					<p>用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用用</p>
				</div>
            </td></tr></table>
			
        </div>
	</div><!-- // end #main -->
    </center>
    </div>
<? include("footer.php");?>