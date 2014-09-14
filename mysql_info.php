<?php 
$mysql_host="localhost";
$mysql_user="bazaar_ntuuser";
$mysql_password="20140912";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"bazaar_ntuemarket"); 
mysqli_query($link,"SET NAMES 'utf8'"); 
?>