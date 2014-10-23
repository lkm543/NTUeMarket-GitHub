<?php
$name=$_POST[name];
$email=$_POST[email];
$content=$_POST[content];
$currtimestr=date("Y-m-d h:i:s"); 


$inputime=date("Y-m-d H:i:s");

$message .="***************************************************<br>";
$message .="請注意︰此郵件是系統自動傳送，請勿直接回覆此郵件。 <br>";
$message .="***************************************************<br>";
$message .="這封信是由『CollegeBazaar』發出，用以通知CollegeBazaar有新訊息。<br>";
$message .="<br>";
$message .="稱謂： $name<br>";
$message .="e-mail： $email<br>";
$message .="反應內容： $content<br>";
$message .="<br>";

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

			$mail->Subject = "CollegeBazaar客戶聯絡--$inputime"; //設定郵件標題 
			$mail->Body = "$message"; //設定郵件內容 
			$mail->IsHTML(true); //設定郵件內容為HTML 
			$mail->AddAddress("customer_service@collegebazaar.tw", "CollegeBazaar"); //設定收件者郵件及名稱 
			if($mail->Send()){
				header("Location: index.php");
				?>
				<script type="text/javascript" language="javascript">
					alert("Thank you,we will contact you as soon as possible.");
				</script>
				<?php
			}
			else{
				?>
				<script type="text/javascript" language="javascript">
					alert("Failed,please try it again.");
				</script>
				<?php
				header("Location: index.php");
			}
			?>