<?php
include_once("mysql_info.php");
$value = $_GET['query'];
$formfield = $_GET['field'];
// 檢查帳號名稱長短、內容及是否已經被取用
if ($formfield == "user_alert") {
	if (strlen($value) < 5 || strlen($value) > 15) {
		echo "*Must be 5-15 characters";
	} elseif (!preg_match('/^[a-zA-Z0-9]{5,}$/', $value)){
		echo "*English letters or numbers only";
	} else {
		$search_username="select * from member where username='$value'";
		$result_username = mysqli_query($link,$search_username);
		if (!mysqli_num_rows($result_username) == 0){
			echo "*Username unavailable, please enter another";
		}
	}
}
// 檢查密碼長度
if ($formfield == "pass_alert") {
	if (strlen($value) < 8) {
		echo "*Password too short";
	}
}

// 檢查電子郵件正確姓及是否已經註冊過
if ($formfield == "email_alert") {
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
		echo "*Invalid email address";
	} else {
		$search_email="select * from member where email='$value'";
		$result_email = mysqli_query($link,$search_email);
		if (!mysqli_num_rows($result_email)== 0){
			echo "*This email has been registered";
		}
	}
}
?>