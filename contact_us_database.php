<?
$name=$_POST[name];
$email=$_POST[email];
$content=$_POST[content];
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
mysqli_query ($link,"insert into feedback(`From`,`Email`,`Content`,`Date`) values('$name','$email','$content','$currtimestr')");
echo '<meta http-equiv=REFRESH CONTENT=2;url=index.php>';
?>