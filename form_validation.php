<?php
$value = $_GET['query'];
$formfield = $_GET['field'];
// Check Valid or Invalid user name when user enters user name in username input field.
if ($formfield == "username") {
	if (strlen($value) < 5 || strlen($value) > 15) {
		echo "長度不符(請輸入5-15個字元)";
	} elseif (!preg_match('/^[a-zA-Z0-9]{5,}$/', $value)){
		echo "請輸入大小寫英文或數字";
	} else {
		echo "<span>Valid</span>";
	}
}
// Check Valid or Invalid password when user enters password in password input field.
if ($formfield == "password") {
	if (strlen($value) < 8) {
		echo "長度不符(至少8個字元)";
	} else {
		echo "<span>Strong</span>";
	}
}
// Check Valid or Invalid email when user enters email in email input field.
if ($formfield == "email") {
	if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value)) {
		echo "Invalid email";
	} else {
		echo "<span>Valid</span>";
	}
}
// Check Valid or Invalid website address when user enters website address in website input field.
if ($formfield == "website") {
	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $value)) {
		echo "Invalid website";
	} else {
		echo "<span>Valid</span>";
	}
}
?>