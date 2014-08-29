<?php
//測試檔案
/*echo "<pre>";
print_r($_FILES); 
echo "</pre>";*/

if (!$_FILES['file']['error']=="4") {

	$file_name = $_FILES['file']['name']; //取得檔名
	$file_size = number_format(($_FILES['file']['size']/1024), 1, '.', ''); //取得檔案大小
	$allowsubName ="jpg,png,gif"; //可上傳副檔名
	define($allowmaxSize,1024);
	$subn_array = explode(",",$allowsubName);//分割允許上傳副檔名
	$checkSubName = "";
	$checkSize = "";
	$checkmsg = "";
	//$upFloder = "Img";
//	$prevImg = "preUpLoadImg";
	$fn_array=explode(".",$file_name);//分割檔名
	$mainName = $fn_array[0];//檔名
	$subName = $fn_array[1];//副檔名	

	//判斷檔案格式
	foreach($subn_array as $value){
		if($subName == $value){			
			$checkSubName ="ok";
			break;
		}else{
			$checkSubName ="檔案格式不符(jpg,gif,png)";
		
		}
	}
	
	//判斷上傳檔案--------------------------------1024
	if($file_size <= 1024){		
		$checkSize = "ok";
	}else{
		$checkSize = "檔案大小過大";
	}
    //開始上傳
	if($checkSize == "ok" && $checkSubName == "ok")
	{   //設定上傳路徑
		$upFloder = "Picture";
		if($upFloder != ""){
			$upload_dir = $upFloder.'/';
		}
			
		//中文檔名處理
		if (mb_strlen($mainName,"Big5") != strlen($mainName))
		{
			$mainName = "undefine".date("ymdHi");//重新命名=檔名+日期
			$file_name = sprintf("%s.%s",$mainName,$subName);//組合檔名
		}
		//上傳路徑	
		$upload_file = $upload_dir . basename($file_name);
		
		
		//檔名重覆處理
		$x=1;
		while(file_exists($upload_file)){
			$file_name = sprintf("%s_%d.%s",$mainName ,$x++ ,$subName);//組合檔名
			$upload_file = $upload_dir . basename($file_name);
		}
		
		$temploadfile = $_FILES['file']['tmp_name'];
		$result = move_uploaded_file($temploadfile,$upload_file);
// mySQL資料庫
session_start();
$username=$_SESSION['MM_Username'];
$currtimestr=date("Y-m-d h:i:s"); 
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
//mysqli_query($link, "SET collation_connection ='utf8_general_ci'");
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"a4904409_goods"); 
mysqli_query($link,"SET NAMES 'utf8'");  
$sql="select * from backend";
$result = mysqli_query($link,$sql); // 執行SQL查詢
$row = mysqli_fetch_array($result);
$id_old=$row['id'];
$id=$row['id']+1;
mysqli_query ($link,"insert into goods_test(goods_name,detail,price,method,sort,filename,date,owner,id,message,phone,contact_email)
values('$_POST[name]','$_POST[detail]','$_POST[price]','$_POST[method]','$_POST[sort]','$file_name','$currtimestr','$username','$id','$_POST[message]','$_POST[phone]','$_POST[contact_email]')");
mysqli_query ($link,"update backend set id='$id' where id='$id_old'");
include_once('show_item.php');
  
	}
	//錯誤,無法上傳
	else{
		$checkmsg = sprintf("1.檔案格式：%s<hr>2.檔案大小：%s",$checkSubName,$checkSize);
    header('Content-type: text/html; charset=utf-8');
printf("<b style='color:red;'>上傳失敗:</b><hr>%s",$checkmsg);

	}
	
?>  
<?php }

//沒有選取檔案
else{ ?>
    <?php header('Content-type: text/html; charset=utf-8');
printf("<b style='color:red;'>錯誤,沒有選取檔案</b>");?>
<?php }?>