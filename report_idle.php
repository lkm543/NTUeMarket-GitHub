<?php
// mySQL資料庫
if(isset($_POST['id'])&&isset($_POST['item_type'])){
    session_start(); 
    $username=$_SESSION['MM_Username'];
    $user_id=$_SESSION['MM_UserID'];

    $id=$_POST['id'];
    $type=$_POST['item_type'];

    include_once("mysql_info.php");

    //檢查登入
    if($username!=NULL){
        if($type=="sell")
        {$result2=mysqli_query($link,"select * from item_forsell where id='$id'");}
            
        elseif($type=="wanted")
        {$result2=mysqli_query($link,"select * from item_wanted where id='$id'");}
            
        
        $row = mysqli_fetch_array($result2);
        //初始
        if($row[idle]==NULL){
            $tempt=array();
            array_push($tempt,$user_id);
            $tempt=serialize($tempt);
            if($type=="sell")
            {mysqli_query ($link,"update item_forsell set idle='$tempt' where id='$id'");}
            
            elseif($type=="wanted")
            {mysqli_query ($link,"update item_wanted set idle='$tempt' where id='$id'");}
            
        }else{  
            //興趣清單裡已有值
            $tempt=unserialize($row[idle]);
            //檢查是否已經加入
            if(!in_array($user_id,$tempt)){  
                array_push($tempt,$user_id);//增加
                $tempt=serialize($tempt);
            if($type=="sell")
            {mysqli_query ($link,"update item_forsell set idle='$tempt' where id='$id'");}
            
            elseif($type=="wanted")
            {mysqli_query ($link,"update item_wanted set idle='$tempt' where id='$id'");}
            }
        }

        $notice='已回報閒置/已成交，待審核中，謝謝您的熱心協助';

        if($type=="sell"){
            //商品
            include_once("show_item.php");
        }else{
            //徵求    
            include_once("show_item_wanted.php");
        }
    }else{ 
        //尚未登入
        $notice="請登入以啟用此功能";
        include_once("login.php");
    }
}?>  