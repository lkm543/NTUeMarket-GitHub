<?php 
$mysql_host="https://gator4012.hostgator.com:2083";
$mysql_user="bazaar";
$mysql_password="20140912";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"bazaar_ntuemarket"); 
mysqli_query($link,"SET NAMES 'utf8'"); 
?>