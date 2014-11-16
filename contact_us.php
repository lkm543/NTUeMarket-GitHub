<? include("header.php");?>
	<div id="main">
    <center>
    <br>
    <br>
    <form method="post" action="contact_us_database.php">
    <table border="0">
    <tr>
    <td valign="top"><p>稱呼：</p></td>
    <td><input type="text" class="form-control" placeholder="請輸入姓名" name="name" pattern="{1,50}"></td>
    </tr>
    <tr>    
    <td valign="top"><p>e-mail：</p></td>
    <td><input type="email" class="form-control" placeholder="請輸入電子郵件信箱" size="40" name="email"></td>
    </tr>
    <tr>
    <td valign="top"><p>意見:</p></td>
    <td><textarea class="form-control" rows="7" name="content"></textarea></td>
    </tr>
    <tr align="center">
    <td></td>
    <td><input type="submit" /></td>
    </tr></table>
    </form>

    <p>或者直接聯繫我們：customer_service@collegebazaar.tw</p>

</center>
	</div>
</div>
<? include("footer.php");?>