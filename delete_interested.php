<?php
// mySQL資料庫
if(isset($_POST['id'])&&isset($_POST['item_type'])){

	session_start(); 
	$currtimestr=date("Y-m-d h:i:s"); 

	include_once("mysql_info.php");
	$username=$_SESSION['MM_Username'];
	$id=$_POST['id'];
	$type=$_POST['item_type'];
	$table="";

	if($type=="sell")
		$table="s";
	elseif($type=="wanted")
		$table="w";

	$result=mysqli_query($link,"select interested from member where username='$username'");
	$row = mysqli_fetch_array($result);

	$interest_array=array();
	$interest_array=unserialize($row[interested]);
	//echo implode(",",$interest_array);
	$number=sizeof($interest_array);
	//echo sizeof($interest_array)."<br>";
	for( $i=0; $i < $number; $i++){
		//echo $i."<br>";
		//echo implode(",",$interest_array)."<br>";
		if( $interest_array[$i] == $table.'_'.$id) 
		{
			unset($interest_array[$i]);
			//重新整理迴圈
			for ($i;$i < $number-1;$i++){
				$interest_array[$i]=$interest_array[$i+1];
				break;
			}	
		}
	}
	$tempt=serialize($interest_array);
	mysqli_query ($link,"update member set interested='$tempt' where username='$username'");
	header("Location: management_interested.php");

}
?>  