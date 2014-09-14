<? include("header.php");
if (isset($_SESSION['MM_Username'])){
include("modify.php");
} else{
?>
<br>
<br>
<br>
<br>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <p style="margin:0px 0px 10px 0px;color:red"><?php echo $message;?></p>
<form action="login_check.php" method="post" name="registration" >
  <div class="form-group">
    <label for="Account">帳戶名稱</label>
    <input type="text" class="form-control" name="username" placeholder="請輸入帳戶名稱">
  </div>
  <div class="form-group">
    <label for="password">用戶密碼</label>
    <input type="password" class="form-control" name="password" placeholder="請輸入用戶密碼">
  </div>
  <button type="submit" class="btn btn-default">登入</button>
</form>
</div>
</div>
</div>
<?php }?>

<? include("footer.php");?>