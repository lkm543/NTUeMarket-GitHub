	<div id="header">
		<div class="container">
			<h1>
				<a href="default.php" title="NTUeMarket">NTUeMarket</a>
		  </h1>
		  <ul class="menu fr">
                 <li><a href="upload_area.php">上傳商品</a></li>
                 <li><a href="upload_wanted.php">公開徵求</a></li>
                 <li><a href="show_item.php">商品總覽</a></li>
                 <li><a href="show_item_wanted.php">需求總覽</a></li>
                 <li class="dropdown" id="twohandedmenu">
                        
                       
<?php //已經登入
session_start();
if (isset($_SESSION['MM_Username'])){ ?>
<a class="dropdown-toggle" data-toggle="dropdown" href="show_item.php">會員專區<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="modify.php">修改資料</a></li>
                            <li><a href="management.php">管理商品</a></li>
							<li><a href="message_area.php">私人訊息</a></li>
                            <li><a href="logout.php">登出</a></li>
<?php //尚未登入
} else{ ?><a class="dropdown-toggle" data-toggle="dropdown" href="show_item.php">會員註冊/登入<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        	<li><a href="registration.php">會員註冊</a></li>
                            <li><a href="login.php">會員登入</a></li> 
                            <?php }?>
                                                    </ul>
                    </li>
				<!--<li><a href="contact-us.php">聯絡我們</a></li>!-->
                <li><a href="contact_us.php">聯絡我們</a></li>
		  </ul>
		</div>
	</div><!-- // end #header -->
