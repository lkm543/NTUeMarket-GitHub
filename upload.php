<?php
//測試檔案
/*echo "<pre>";
print_r($_FILES); 
echo "</pre>";*/
$valid_formats = array("jpg", "png", "gif");
$max_file_size = 1024*100; //100 kb
$resized_img_width = 700; //700px
$folderPath = "Picture/"; // Upload directory
$count = 0;
$checkExt = "";
$checkSize = "";
$checkmsg = "";
$file_name = "";
$fileRenamed = "";
$sucessUpload = false;
$errorFiles = "";


		//echo '<pre>';
		//	print_r($_FILES); 
		//echo '</pre>';

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){

	foreach ($_FILES['files']['name'] as $f => $file_name) { 

		if ($_FILES['files']['error'][$f] == 4) {
			$sucessUpload = false;
			$errorFiles .= $_FILES['files']['name'][$f].",";
		        continue; // Skip file if any error found
		}

	    if ($_FILES['files']['error'][$f] == 0) {

			//判斷檔案格式
	    	if(!in_array(pathinfo($file_name, PATHINFO_EXTENSION), $valid_formats)){
	    		$checkExt ="檔案格式不符(jpg,gif,png)";
	    		$errorFiles .= $_FILES['files']['name'][$f].",";
	    		continue;	
	    	}else{
	    		$checkExt = "ok";
	    		$fn_array=explode(".",$file_name);//分割檔名
				$mainName = $fn_array[0];//檔名
				$ext = $fn_array[1];//副檔名
				
				if($count==0){
					//重新命名檔案
					$fileRenamed = md5($_SESSION['MM_Username'].date("ymdHis"));
				}

				$file_name = sprintf("%s_%d.%s",$fileRenamed,$count+1,$ext);

				//檔名重覆處理
				while(file_exists($folderPath . basename(sprintf("%s",$file_name)))){
					$fileRenamed = md5($_SESSION['MM_Username'].date("ymdHis"));
					$file_name = sprintf("%s_%d.%s",$fileRenamed,$count+1,$ext);
				}

				//判斷檔大小    
				if ($_FILES['files']['size'][$f] > $max_file_size) {

					$image_info = getimagesize($_FILES['files']['tmp_name'][$f]);
					$image_type = $image_info[2];
					$image;

					switch($image_type){
						case IMAGETYPE_JPEG:
						$image = imagecreatefromjpeg($_FILES['files']['tmp_name'][$f]); 
						break;
						case IMAGETYPE_GIF:
						$image = imagecreatefromgif($_FILES['files']['tmp_name'][$f]); 
						break;
						case IMAGETYPE_PNG:
						$image = imagecreatefrompng($_FILES['files']['tmp_name'][$f]); 
						break;
					}

					//重設檔案大小
					$ratio = $resized_img_width / imagesx($image);
					$height = imagesy($image) * $ratio; 
					$new_image = imagecreatetruecolor($resized_img_width, $height);
					imagecopyresampled($new_image, $image, 0, 0, 0, 0, $resized_img_width, $height, imagesx($image), imagesy($image));
					$sucessUpload = imagejpeg($new_image,$folderPath.$file_name);
					$checkSize = "ok";
				}else{
					$temploadfile = $_FILES['files']['tmp_name'][$f];
					//上傳路徑
					$upload_file = $folderPath . basename($file_name);
					$sucessUpload = move_uploaded_file($temploadfile,$upload_file);
					$checkSize = "ok";
				}

				if($sucessUpload)
					$count++;	

				// echo '<pre>';
				// 	print("Uploaded file ".$count.": ".$file_name);
				// echo '</pre>';
			}
		}
	}

	if($sucessUpload && $count>=1){

		// mySQL資料庫
		session_start();
		$username=$_SESSION['MM_Username'];
		$currtimestr=date("Y-m-d h:i:s"); 
		include_once("mysql_info.php");
		$sql="select * from backend";
		$result = mysqli_query($link,$sql); // 執行SQL查詢
		$row = mysqli_fetch_array($result);
		$id_old=$row['id'];
		$id=$row['id']+1;
		mysqli_query ($link,"update backend set id='$id' where id='$id_old'");
		$sucess = mysqli_query ($link,"insert into item_forsell(name,detail,price,method,sort,filename,img_count,date,owner,message,phone,contact_email,id)
			values('$_POST[name]','$_POST[detail]','$_POST[price]','$_POST[method]','$_POST[sort]','$file_name','$count','$currtimestr','$username','$_POST[message]','$_POST[phone]','$_POST[contact_email]','$id')");

		if(!$sucess){
			echo '<pre>';
			printf("Failed to insert into database.");
			echo '</pre>';
		}

		include_once("upload_item_succeed.php");
	}
	//錯誤,無法上傳
	else{
		$checkmsg = sprintf("1.檔案格式：%s<hr>2.檔案大小：%s<hr>3.上傳檔案：%s",$checkExt,$checkSize,$errorFiles);
		header('Content-type: text/html; charset=utf-8');
		printf("<b style='color:red;'>上傳失敗:</b><hr>%s",$checkmsg);

	}

}
//沒有選取檔案
else {
	header('Content-type: text/html; charset=utf-8');
	printf("<b style='color:red;'>錯誤,沒有選取檔案</b>");
}?>