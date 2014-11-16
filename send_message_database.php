<?php


session_start();
$username=$_SESSION['MM_Username'];
$user_id=$_SESSION['MM_UserID'];

$receiver=trim($_POST['receiver2']);
$subject=($_POST['subject2']);
$content=($_POST['content2']);
$currtimestr=date("Y-m-d H:i:s");

include_once("mysql_info.php");

$query = "select id as receiver_id , email as email ,nickname as nickname from member where username='$receiver'";
	//檢查收件人是否存在
	$result = mysqli_query($link,$query); // 執行SQL查詢引
	$row = mysqli_fetch_array($result);
	$number= mysqli_num_rows($result);
	//echo "here".$username."id".$user_id."re".$receiver."sub".$subject."con".$content."number".$number;
	if($result){
		if($number==1){
			$sql = "insert into `message` (`from`,`to`,`subject`,`body`,`date`) values('$user_id','".$row[receiver_id]."','$subject','$content','$currtimestr')";
			if($success=mysqli_query ($link,$sql)){
				//寄通知信
$email=$row['email'];
$nickname=$row['nickname'];
$inputime=date("Y-m-d H:i:s");
//echo $email.$nickname."test";
$message .="***************************************************<br>";
$message .="請注意︰此郵件是系統自動傳送，請勿直接回覆此郵件。 <br>";
$message .="***************************************************<br>";
$message .="這封信是由『CollegeBazaar』發出，用以通知您在CollegeBazaar有新訊息。<br>";
$message .="<br>";
$message .="訊息內容： $content<br>";
$message .="<br>";
$message .="請點以下連結讀取該訊息";
$message .="<br>";
$message .="http://collegebazaar.tw/message_inbox.php";

require 'PHPMailer/PHPMailerAutoload.php';
			require_once("PHPMailer/class.phpmailer.php"); //匯入PHPMailer類別 
			$mail= new PHPMailer(); //建立新物件 
			$mail->IsSMTP(); //設定使用SMTP方式寄信 
			$mail->SMTPAuth = true; //設定SMTP需要驗證 
			$mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線 
			$mail->Host = "box990.bluehost.com"; //寄信主機
			$mail->Port = 465; //Gamil的SMTP主機的SMTP埠位為465埠。 
			$mail->CharSet = "UTF-8"; //設定郵件編碼 

			$mail->Username = "customer_service@collegebazaar.tw"; //設定驗證帳號 
			$mail->Password = "cs@collegebazaar.tw"; //設定驗證密碼 

			$mail->From = "customer_service@collegebazaar.tw"; //設定寄件者信箱 
			$mail->FromName = "CollegeBazaar"; //設定寄件者姓名 

			$mail->Subject = "CollegeBazaar新訊息通知--$inputime"; //設定郵件標題 
			$mail->Body = "$message"; //設定郵件內容 
			$mail->IsHTML(true); //設定郵件內容為HTML 
			$mail->AddAddress("$email", "$nickname"); //設定收件者郵件及名稱 
			if($mail->Send()){
			header("Location: sent_message_area.php");}
		}else{
			?><script type="text/javascript" text="javascript">
			alert("Error sending message to ".<?php echo $receiver; ?>.", please try again later.");
		</script><?php
	}}
	else{

		$notice="查無此收件者";

		include_once("send_message.php");
	}		
}else{
	?><script type="text/javascript" text="javascript">
	alert("Could not run query.");
</script><?php
}

?>