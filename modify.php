<? include("header.php");

if (isset($_SESSION['MM_Username'])){

$username=$_SESSION['MM_Username'];

include_once("mysql_info.php");

$sql = "select * from member where username = '$username'"; //在資料表中選擇所有欄位

$result = mysqli_query($link,$sql); // 執行SQL查詢

$row = mysqli_fetch_array($result);

?>

<div class="row">

<div class="col-md-6">

<center><div style="margin:20px 0px 5px 0px"><font color="#FF0000" size="5"><?php echo $notice;?></font></div></center>

<form action="modify_database.php" method="post">

<table class="table table-striped" style="margin:25px 0px 5px 0px">

<tr><th colspan="2">帳戶基本資料</th></tr>

<tr>

<td width="240">帳號</td>

<td><?php echo $username;?></td>

</tr>

<tr>

<td>啟用</td>

<td><?php 

if($row[active]!=1){echo '<font color="red">尚未啟用，請收取驗證信以啟用帳號</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="resend_email.php"><button type="button" class="btn btn-default">重寄驗證信</button></a>';} 

else {echo "已啟用";}

?></td>

</tr>

<tr>

<td>註冊email</td>

<td><?php echo $row[email];?></td>

</tr>

<tr>

<tr>

<td>暱稱</td>

<td><input type="text" value="<?php echo $row[nickname];?>" name="nickname"/></td>

</tr>

<tr>

<td>

重設新密碼(5-15字)

</td>

<td>

<input type="password" name="password1" pattern=".{5,15}" value="" /> 

</td>

</tr>

<tr>

<td>

新密碼確認(5-15字)

</td>

<td>

<input type="password" name="password2" pattern=".{5,15}" value=""/> 

</td>

</tr>

</table>

<table class="table table-striped" style="margin:15px 0px 25px 0px">

<tr><th colspan="2">使用者偏好設定  (選填,填入後將於每次上傳商品自動帶入)</th></tr>

<tr>

<td width="240">慣用交易方式/地點</td>

<td><input type="method" value="<?php echo $row[method];?>" name="method"/></td>

</tr>

<tr>

<td>手機</td>

<td><input type="text" value="<?php echo $row[phone];?>" name="phone"/></td>

<td></td>

</tr>

<tr>

<td>聯絡email</td>

<td><input type="email" value="<?php echo $row[contact_email];?>" name="contact_email"/></td>

<td></td>

</tr>

<tr>

<td>私人訊息</td>

<td><input type="radio" name="message" value="1"<?php 

if($row[message]==1)

{

	echo " checked";

	}

?>>歡迎私訊   <input type="radio" name="message" value="2"<?php 

if($row[message]==2)

{

	echo " checked";

	}

?>>以其他聯絡方式為主</td>

<td></td>

</tr>

<tr>

<td colspan="2"> <center>

<input type="submit" class="btn btn-default" value="確認修改" /></center>

</td>

</tr>

</table>

</form>

</div>

</div>



<?php

}
else{

	echo "您尚未登入，請登入後啟用此功能！";
}
?>





<? include("footer.php");?>