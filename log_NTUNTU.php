<?php
session_start();
$username=$_SESSION['MM_Username'];
$user_id=$_SESSION['MM_UserID'];
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="我們建立一個屬於台大人的二手交換電子商務平台，你可能會有想要買/賣/贈送的二手教科書，要搬家出清的家具、用不到的衣服雜物。你可以藉由社群成員具有需求同質性高、地利之便的優勢，很快找到買/賣家、很方便遞交/接收物品，最重要的是能讓物盡其用，每一分資源都不被浪費。" />
    <meta name="keywords" content="台大,二手物,交換平台,電子商務" />

    <title>CollegeBazaar</title>

</head>

<body>
<?php
include_once("mysql_info.php");
$sql = "select * from Stastic";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_array($result);
echo $row['Log'];
?>
</body>
</HTML>