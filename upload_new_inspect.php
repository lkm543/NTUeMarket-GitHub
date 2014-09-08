<?php
session_start(); 
if (isset($_SESSION['MM_Username'])){
$username=$_SESSION['MM_Username'];
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
mysqli_select_db ($link,"a4904409_goods");  
$sql = "select * from member where username = '$username'"; //在資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
?>
<form action="upload.php" method="post" enctype="multipart/form-data" name="form1">
  <p class="center"><strong>商品資料</strong></p>
  <table border="0">
    <tr>
      <td>商品名稱</td>
      <td><input type="text" pattern=".{3,15}" name="name" id="name" class="form-control"></td>
      <td>(3-15字)</td>
    </tr>
    <tr>
      <td>描述</td>
      <td><textarea name="detail" id="detail" pattern=".{0,100}" class="form-control" rows="5"></textarea></td>
      <td>(100字內)</td>
    </tr>
    <tr>
      <td>價格</td>
      <td><input type="text" name="price" id="price" class="form-control"></td>
    </tr>
    <tr>
      <td>商品類別</td>
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
      <td>圖片</td>
      <td><input id="input-1" name="files[]" type="file" multiple="true" accept="image/*" >
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
          maxFileSize: 1024,
          initialCaption: "選擇商品圖片"
        });
        </script>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
        <input type="submit" name="submit" id="submit" value="送出">
        <input type="reset" name="reload" id="reload" value="重設">
      </td>
    </tr>
</table>
</form>
<?php }?>
