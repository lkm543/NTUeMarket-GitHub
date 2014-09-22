<?php
$mysql_host="localhost";
$mysql_user="colleig4_ntuuser";
$mysql_password="20140916";
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_select_db ($link,"colleig4_ntuemarket"); 
mysqli_query($link,"SET NAMES 'utf8'"); 
?>