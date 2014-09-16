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

$status = $row['active'];

if($license_code_email==$license_code_database){

	if(!$status==1){

		$sucess = mysqli_query ($link,"update member set active=1 where email = '$email'");

		if($sucess){

			$_SESSION['MM_Username']=$username;?>

			<script type="text/javascript" language="javascript">

			alert("Verification sucess! Account activated.");

			</script>

			<?php

			echo '<meta http-equiv=REFRESH CONTENT=2;url=/modify.php>';

		}

	}else{?>

		<script type="text/javascript" language="javascript">

		alert("Your account has been already activated!");

		</script>

		<?php

		echo '<meta http-equiv=REFRESH CONTENT=2;url=/>';

	}



}else{?>

	<script type="text/javascript" language="javascript">

	alert("驗證碼錯誤!\n請確認認證信中之驗證碼是否正確，或聯絡網站管理員請求協助。");

	</script>

	<?php

	echo '<meta http-equiv=REFRESH CONTENT=2;url=/contact_us.php>';

}

?>