<?
session_start();
$license_code_email=$_GET['license_code'];
$email=$_GET['email'];
include_once("mysql_info.php");
$sql = "select * from member where email = '$email'"; //在資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
//mail("b98502030@ntu.edu.tw", "test" , $content);  
//header('Content-type: text/html; charset=utf-8');
//printf("<b style='color:red;'>"+$username+"email"+$email+"password"+$password+"</b>");
//printf($_POST[name].$_POST[detail].$_POST[price].$_POST[method].$_POST[sort].$file_name$currtimestr);
$license_code_database=$row['license_code'];
$username=$row['username'];
if($license_code_email==$license_code_database){
mysqli_query ($link,"update member set active=1 where email = '$email'");
$_SESSION['MM_Username']=$username;?>
<script type="text/javascript" language="javascript">
alert("<?php echo $username;?>Actived succeed!");
</script>
<?php
echo '<meta http-equiv=REFRESH CONTENT=2;url=../default.php>';
}
else{
	echo 'The license code is wrong!';
	echo '<meta http-equiv=REFRESH CONTENT=2;url=../default.php>';
	}
?>