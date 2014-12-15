<?php
require_once('src/facebook.php');  // Include facebook SDK file
function checkuser($fuid,$funame,$ffname,$femail){
  include_once('mysql_info.php');
  $check = mysqli_query($link,"select * from member where username='$fuid'");
  $check = mysqli_num_rows($check);
  if ($check==0) { // if new user . Insert a new record   
  $query = "INSERT INTO member (username,email,nickname,active,contact_email) VALUES ('$fuid','$femail','$ffname',1,'$femail')";
  mysqli_query($link,$query); 
$count=file("counter.txt") ;

      $username=$fuid;
//後臺記錄
$currtimestr=date("Y-m-d H:i:s");
//取得使用者ip
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
   $ip = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
   $ip= $_SERVER['REMOTE_ADDR'];
}

include_once("mysql_info.php");
$log_now=$currtimestr.'['.$ip.']使用者'.$username."使用臉書註冊----瀏覽人次：".$count[0].'<br>';
mysqli_query ($link,"update Stastic set Log=CONCAT(Log,'$log_now'), Register=CONCAT(Register,'$log_now')");



  $success.="insert";
  } else {   // If Returned user . update the user record 
  //後臺記錄
$currtimestr=date("Y-m-d H:i:s");
//取得使用者ip
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
   $ip = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
   $ip= $_SERVER['REMOTE_ADDR'];
}
$count=file("counter.txt") ;
$log_now=$currtimestr.'['.$ip.']使用者'.$fuid."使用臉書登入----瀏覽人次：".$count[0].'<br>';

mysqli_query ($link,"update Stastic set Log=CONCAT(Log,'$log_now'), Login=CONCAT(Login,'$log_now')");  
  $query = "UPDATE member SET email='$femail' where username='$fuid'";
  $success=mysqli_query($link,$query);
  $success.="update";
  }
  $check = mysqli_query($link,"select id from member where username='$fuid'");
 $row = mysqli_fetch_array($check);
 $_SESSION['MM_UserID'] = $row[id];
  //echo $success,$check,$fuid,$funame,$ffname,$femail;
}

$facebook = new Facebook(array(
  'appId'  => '748381258544691',   // Facebook App ID 
  'secret' => 'b71c13dd5fd34972cf52108efa47e8ef',  // Facebook App Secret
  'cookie' => true,	
  'version' => 'v2.1'
));
$user = $facebook->getUser();

if ($user) {
  try {
      $user_profile = $facebook->api('/me');
  	  $fbid = $user_profile['id'];                 // To Get Facebook ID
 	    $fbuname = $user_profile['username'];  // To Get Facebook Username
 	    $fbfullname = $user_profile['name']; // To Get Facebook full name
	    $femail = $user_profile['email'];    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
	    $_SESSION['USERNAME'] = $fbuname;
      $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
      $_SESSION['MM_Username'] =  $fbid;

      $username=$fbuname;


      //echo "hahahahahahahahahahahahahahahahahahahahahaha-";
      checkuser($fbid,$funame,$fbfullname,$femail);    // To update local DB
      //echo "-hahahahahahahahahahahahahahahahahahahahahaha";
  } catch (FacebookApiException $e) {
    error_log($e);
   $user = null;
  }
}
if ($user) {
	header("Location: index.php");
} else {
 $loginUrl = $facebook->getLoginUrl(array(
		'scope'		=> 'email', // Permissions to request from the user
		));
 header("Location: ".$loginUrl);
}
?>
