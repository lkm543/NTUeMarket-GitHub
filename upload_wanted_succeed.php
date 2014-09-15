<?php include("header.php");?>
	<div id="main">

        <div id="procedure" class="row">
            <div class="col-md-1"></div>
            <div class="col-md-2" align="reft">
              <p>Step1. 註冊或登入</p>
              <p>Step2. 上傳需求</p>
              <p class="bg-success" style="font-weight:bold;">Step3. 靜候佳音</p>
              <p>Step4. 回報或下架</p>
            </div>
            <div class="col-md-2"></div>
                <center>
  			<div class="col-md-5">
<?php //已經登入,輸出表格





if (isset($_SESSION['MM_Username'])){?>
  <p align="left" style="font-size:24px;margin-top:80px;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;公開徵求成功!</strong></p>
      <div style="float:left;margin-right:20px;">
        <button type="button" class="btn btn-primary btn-lg" onclick="location.href='upload_wanted.php'">繼&nbsp;續&nbsp;&nbsp;徵&nbsp;求</button>
      </div>
      <div style="float:left">
        <button type="button" class="btn btn-success btn-lg" onclick="location.href='show_item_wanted.php'">至需求總覽</button>
      </div></div></center></div></div>
<?php }?>







<?php
if (!isset($_SESSION['MM_Username'])){
	echo '<center><p style="color:red">您尚未登入，請先註冊或登入。</p></center>';?>
	<center>
<form action="add_member_database.php" method="post" name="form1">
  <strong>註冊個人資料</strong>
  <table border="0">
      <tr>
      <td>用戶帳號</td>
      <td><input type="text" name="username" id="username" class="form-control"></td>
    </tr>
    <tr>
      <td>電子郵件信箱</td>
      <td><input type="email" name="email" id="email" class="form-control"></td>
    </tr>
    <tr>
      <td>用戶密碼</td>
      <td><input type="password" name="password" id="password" class="form-control"></td>
    </tr>
        <tr>
      <td>&nbsp;</td>
      <td><span class="General">
        <input type="submit" name="submit" id="submit" value="送出">
        <input type="reset" name="reload" id="reload" value="重設">
      </td>
    </tr>
</table>
</form>
</center>
<?php 
}
?></div>
            <div class="col-md-2"></div>
        </div>
    </center>
	</div>
</div>
<?php include("footer.php");?>