<?php include("header.php");?>
	<div id="main">

        <div id="procedure" class="row" >
            <div class="col-md-1"></div>
            <div class="col-md-2" align="reft">
          	<?php //已經登入
        			if (isset($_SESSION['MM_Username'])){
                    echo '<p>Step1. 註冊或登入</p>';
                    echo '<p class="bg-success" style="font-weight:bold;">Step2. 上傳商品</p>';
                    echo '<p>Step3. 靜候佳音</p>';
                    echo '<p>Step4. 回報或下架</p>';
              }else{
                    echo '<p class="bg-success" style="font-weight:bold;">Step1. 註冊或登入</p>';
                    echo '<p>Step2. 上傳商品</p>';
                    echo '<p>Step3. 靜候佳音</p>';
                    echo '<p>Step4. 回報或下架</p>';
              }
            ?>
            </div>
  			    <div class="col-md-7"><center>
            <?php //已經登入,輸出表格

              if (isset($_SESSION['MM_Username'])){
                $username=$_SESSION['MM_Username'];
                include_once("mysql_info.php");
                $sql = "select * from member where username = '$username'"; //在資料表中選擇所有欄位
                $result = mysqli_query($link,$sql); // 執行SQL查詢
                $row = mysqli_fetch_array($result);
                if($row[active]==1){
                ?>
                  <form action="upload.php" method="post" enctype="multipart/form-data" name="form1">
                    <p class="center" style="font-size:20px;"><strong>商品資料</strong></p>
                    <table id="upload_table">
                      <tr>
                        <td>商品名稱</td>
                        <td width="300"><input type="text" name="name" id="name" class="form-control" pattern=".{3,20}"></td>
                        <td>(3-20字)</td>
                      </tr>
                      <tr>
                        <td>描述</td>
                        <td><textarea name="detail" id="detail" pattern=".{0,100}" class="form-control" rows="3"></textarea></td>
                        <td>(100字內)</td>
                      </tr>
                      <tr>
                        <td>價格</td>
                        <td><input type="text" name="price" id="price" class="form-control"></td>
                      </tr>
                      <tr>
                        <td style="vertical-align:middle;">商品類別</td>
                        <td><label for="sort"></label>
                          <select name="sort" id="sort" class="form-control">
                            <option value="life">生活用品</option>
                            <option value="stationary">文具</option>
                            <option value="clothes">衣物</option>
                            <option value="3c">3c產品</option>
                            <option value="bike">腳踏車</option>
                            <option value="book">課外讀物</option>
                            <option value="textbook">教科書</option>
                            <option value="else">其他</option>
                            </select>
                      </td>
                          <tr>
                        <td>交易/聯絡方式</td>
                        <td><input type="text" name="method" id="method" class="form-control" value="<?php echo $row[method];?>"></td>
                      </tr>
                      </tr>
                          <tr>
                        <td>手機(選填)</td>
                        <td><input type="phone" name="phone" class="form-control" value="<?php echo $row[phone];?>"></td>
                      </tr>
                      <tr>
                        <td>聯絡email(選填)</td>
                        <td><input type="email" name="contact_email" class="form-control" value="<?php echo $row[contact_email];?>"></td>
                      </tr>
                      <tr>
                  <td>私人訊息</td>
                  <td><input type="radio" name="message" value="1"<?php 
                      if($row[msg_welcome]==1)
                      {
                        echo " checked";
                      }
                  ?>>歡迎私訊   <input type="radio" name="message" value="2"<?php 
                      if($row[msg_welcome]==2)
                      {
                        echo " checked";
                      }
                  ?>>以其他聯絡方式為主</td>
                  <td></td>
                  </tr>
                      <tr>
                        <td>圖片</td>
                        <td><input id="input-1" name="files[]" type="file" multiple accept="image/*" >
                          <!-- add multiple="true" to input tag attribute for uploading more than 1 file-->

                           <script> 
                           $("#input-1").fileinput({
                            previewFileType: "image",
                            showUpload: false,
                            browseClass: "btn btn-success",
                            browseLabel: "瀏覽",
                            browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
                            removeClass: "btn btn-danger",
                            removeLabel: "刪除",
                            removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
                            overwriteInitial: false,
                            initialCaption: "選擇商品圖片"
                          });
                          </script>
                        </td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>
                          <input type="submit" name="submit" id="submit" value="上架" class="btn btn-success">
                          <input type="reset" name="reload" id="reload" value="重設" class="btn btn-warning">
                        </td>
                      </tr>
                  </table>
                  </form>          
                <?php
                }else{
                  echo "<center>您的帳號尚未啟用，請至信箱收取驗證信。</center>";
                }
            }else{?>
  <div class="col-md-5 col-md-offset-4" style="text-align:left;">
<?php  echo '<center><p style="color:#5f5f5f;font-size:20px;font-weight:bold;">您尚未登入，請先<a href="login.php">註冊</a>或登入。</p></center>';?>
<form action="login_check.php" method="post" name="registration" >
  <div class="form-group" style="margin-top:30px;">
    <label for="Account">帳戶名稱</label>
    <input type="text" class="form-control" name="username" placeholder="請輸入帳戶名稱">
  </div>
  <div class="form-group">
    <label for="password">用戶密碼</label>
    <input type="password" class="form-control" name="password" placeholder="請輸入用戶密碼">
  </div>
  <center><button type="submit" class="btn btn-default">Submit</button></center>
</form>
<div style="text-align:center;margin-top:20px;"><a href="fbconfig.php"><img src="images/fbsignin.png" width="90%"></a></div>
</div>
<?php 
}

?></div>
            <div class="col-md-2"></div>
        </div>
    </center>
  </div>
</div>
<?php include("footer.php");?>