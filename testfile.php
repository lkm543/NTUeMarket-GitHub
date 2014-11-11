<?php
session_start();
$username=$_SESSION['MM_Username'];
$user_id=$_SESSION['MM_UserID'];
if(isset($_SESSION['FBID'])){
    $fbid=$_SESSION['FBID'];
}
if($_GET['graph']!=null){
  $graph = $_GET['graph'];
}

$fb_user = "";
if(isset($_POST['fb_user'])){
    $fb_user=$_POST['fb_user'];
}elseif($_GET['fb_user']!=null){
    $fb_user=$_GET['fb_user'];
}
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="我們建立一個屬於台大人的二手交換電子商務平台，你可能會有想要買/賣/贈送的二手教科書，要搬家出清的家具、用不到的衣服雜物。你可以藉由社群成員具有需求同質性高、地利之便的優勢，很快找到買/賣家、很方便遞交/接收物品，最重要的是能讓物盡其用，每一分資源都不被浪費。" />
    <meta name="keywords" content="台大,二手物,交換平台,電子商務" />

    <title>CollegeBazaar</title>

    <link href="bootstrap/css/nivo-slider.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/style-ie.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/style.css" rel="stylesheet" type="text/css" />  
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />  

    <!-- Bootstrap!-->

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Nivo Slider plugin!-->    

    <script type="text/javascript" src="bootstrap/js/jquery.nivo.slider.js"></script>
    <script src="bootstrap/js/jquery.nivo.slider.pack.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(window).load(function() {

            $('#slideshow').nivoSlider({
                controlNav: false, 
                directionNav: false
            });
        });
    </script>   

    <!-- Nivo Lightbox plugin! -->

    <link rel="stylesheet" href="bootstrap/css/nivo-lightbox.css" type="text/css" />
    <link rel="stylesheet" href="bootstrap/themes/nivo-lightbox/default/default.css" type="text/css" />
    <script src="bootstrap/js/nivo-lightbox.min.js"></script>

    <script>
        $(document).ready(function(){
            $('a').nivoLightbox();
        });
    </script>

    <!-- Fileinput plugin !-->

    <link href="bootstrap/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <script src="bootstrap/js/fileinput.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">

    <!-- Other plugin !-->
    <script src="js/signup_validator.js" type="text/javascript"></script>
    <!-- Facebook api!-->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '350560391785344',
      secret     : '6b3d7c2c1e10b872d68a99e7b296dfef',
      xfbml      : true,
      version    : 'v2.1'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

</head>

<body>
<!-- facebook分享-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=748381258544691&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Facebook留言-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=748381258544691&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <div id="wrapper">

       <div id="header">

          <div class="container">

             <h1>

                <a href="/" title="CollegeBazaar">CollegeBazaar</a><div style="margin-left:25px;" class="fb-like" data-href="http://collegebazaar.tw/" data-width="200" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>

            </h1>

            <ul class="menu fr">

               <li><a href="upload_area.php" <?php if($current_page=="upload_area.php"||$current_page=="upload_item_succeed.php") echo 'class="menu_item_selected"';?>>上傳商品</a></li>

               <li><a href="upload_wanted.php" <?php if($current_page=="upload_wanted.php"||$current_page=="upload_wanted_succeed.php") echo 'class="menu_item_selected"';?>>公開徵求</a></li>

               <li><a href="show_item.php" <?php if($current_page=="show_item.php"||$current_page=="show_item_detail.php") echo 'class="menu_item_selected"';?>>商品總覽</a></li>

               <li><a href="show_item_wanted.php" <?php if($current_page=="show_item_wanted.php"||$current_page=="show_wanted_detail.php") echo 'class="menu_item_selected"';?>>需求總覽</a></li>



<?php //已經登入

if (isset($_SESSION['MM_Username'])){

    include_once("mysql_info.php");
    $result= mysqli_query($link,"select * from member where username='$username'");
    $row = mysqli_fetch_array($result);
    $sql="select count(id) as rows from message where `to`='$user_id' and receiver_status='0'";
    $result = mysqli_query($link,$sql); // 執行SQL查詢引
    $num_notice = mysqli_fetch_array($result);
    ?>
    <li class="dropdown" id="twohandedmenu">
    <a <?php if($current_page=="modify.php"||$current_page=="management_interested.php"||$current_page=="management_wanted.php"||$current_page=="management_idle.php"||$current_page=="management_removed.php"||$current_page=="management.php"||$current_page=="message_area.php"||$current_page=="garbage_message_area.php"||$current_page=="sent_message_area.php"||$current_page=="send_message.php") echo 'class="dropdown-toggle menu_item_selected"'; else echo 'class="dropdown-toggle"';?> data-toggle="dropdown" href="show_item.php"><?php if ($row[nickname]!=NULL) {echo $row[nickname];} else {echo $username;}?><?php if($num_notice[rows]!=0) echo '<span style="vertical-align:top; display:inline-block;"><img src="images/message.jpg" width=20px></span>' ?><b class="caret"></b></a>

    <ul class="dropdown-menu">

        <li><a href="modify.php">修改資料</a></li>

        <li><a href="management_interested.php">興趣清單</a></li>

        <li><a href="management.php">管理商品</a></li>

        <li><a href="message_inbox.php">私人訊息<?php if($num_notice[rows]!=0) echo '<span id="notification" style="background-color:#FF0000; vertical-align:top; font-size:14px; border-radius:10px; padding:1px 6px; color:#FFFFFF; -webkit-box-shadow:0 1px 1px rgba(0, 0, 0, .7)">'.$num_notice[rows].'</span>'?></a></li>

        <li><a href="logout.php">登出</a></li></ul>

<?php //尚未登入

} else{ ?>

    <li><a href="login.php"     <?php 
    if($current_page=="login.php") 
        echo 'class="menu_item_selected"'; 
    ?> >會員註冊/登入</a></li>

<?php }?>
</div>

    </div><!-- // end #header -->
<?php
ob_start();

    /**
     * This is the link to my page graph
     * I've included it here so i can copy an paste for quick reference
     *
     * Copying and pasting this into the browser url bar gives you a full graph of the feed
     * which is very handy for browsing and seeing what exists in the array
     *
     * Change the values to suit your own needs, and when your script is final, remove this
     * comment block
     *
     * Typing this into the url will get you the super array (graph) to analyze
     * https://graph.facebook.com/YOUR_PAGE_ID/feed?access_token=APP_ACCESS_TOKEN
     */

    // include the facebook sdk
    require_once('src/facebook.php');
    // require_once('src/Facebook/FacebookRequest.php');

    // connect to app
    $config = array();
    $config['appId'] = '350560391785344';
    $config['secret'] = '6b3d7c2c1e10b872d68a99e7b296dfef';
    $config['xfbml'] = true;

    // instantiate
    $facebook = new Facebook($config);

    // set page id
    $pageid = "698433983507035";
    $access_token = 'CAAEZB1TOf64ABAGXhJifGN9GAFfrztoSHsWZBJdLGrhTCVDtHgdMIM1BQ53awof0f8hAWL1diEBZBbtoH8VLbuzAZBbZAiC8ZCF6GeukslANYxdzZBEHrE4QMB3PTUZCuH3wjwSdAukp1xa8ZChVUmbuwQEZBPz6Nah2w3qMAx1BInSxbWuutlHej9qk1ZCqHxYcstGLMnXGk7bwnnk1DL8nNoF';

    // now we can access various parts of the graph, starting with the feed
    if($graph){
      $pagefeed = $facebook->api("/".$pageid."/feed?limit=10&".$graph."&access_token=".$access_token);
    }else{
      $pagefeed = $facebook->api("/".$pageid."/feed?limit=10&access_token=".$access_token);
    }
    
    // $pagefeed = $facebook->api("/".$pageid."/feed?access_token=".$access_token);
?>


<div id="wrapper">

<div id="main">
    <div class="container">
        
        
        
        <h1>Facebook Feed</h1>
        <div style="width:300px; display:inline">
        <form action="testfile.php" method="post" name="find_by_user">
            <input type="text" class="form-control" name="fb_user" style="width:200px; float:left" <?php if($fb_user) echo "value='".$fb_user."'"; ?>>
            <button type="submit" class="btn btn-default">搜尋</button>
        </form>
        </div>
        
        
        <?php
            
            echo "<div class=\"fb-feed\">";

            // $json_output = json_decode($pagefeed);
            // if($json_output==null) echo "JSON NULL";
            // foreach($json_output as $data){
            //   echo "Name: ".$data['name']."\n";
            // }

            // set counter to 0, because we only want to display 10 posts
            // if($graph) echo "Graph set: ".$graph; else echo "Graph not set!";
            $i = 0;
            $next_until = "";
            $loop = true;
                echo "/".$pageid."/feed?access_token=".$access_token;
            if($pagefeed['error']){
              echo "Error message: ".$pagefeed['error']['message']."<br>";
              echo "Type: ".$pagefeed['error']['type']."<br>";
              echo "Code: ".$pagefeed['error']['code']."<br>";
            }

            while($loop && sizeof($pagefeed['data'])>1){
              foreach($pagefeed['data'] as $post) {
                if ($post['type'] == 'status' || $post['type'] == 'link' || $post['type'] == 'photo') {
                
                    
                    // open up an fb-update div
                    echo "<div class=\"fb-update\">";
                        
                        // post the time
                        
                      if(strpos(strtolower($post['from']['name']),strtolower($fb_user))!==false || $fb_user==""){
                            // check if post type is a status

                            echo "<h2><p>From: ".$post['from']['name']."</p></h2>";

                            if ($post['type'] == 'status') {
                                echo "<h3>Status updated: " . date("jS M, Y", (strtotime($post['created_time']))) . "</h3>";
                                if (empty($post['story']) === false) {
                                    echo "<p>" . $post['story'] . "</p>";
                                } elseif (empty($post['message']) === false) {
                                    echo "<p>商品名稱：". substr($post['message'], strpos($post['message'], '商品：')+9, 
                                        strpos($post['message'], '2.',strpos($post['message'], '商品：')+9)-strpos($post['message'], '商品：')-9)."</p>";
                                    echo "<p>說明：". substr($post['message'], strpos($post['message'], '容量：')+9, 
                                        strpos($post['message'], '3.',strpos($post['message'], '容量：')+9)-strpos($post['message'], '容量：')-9)."</p>";
                                    if(strpos($post['message'],'定價金額')!==false){
                                      echo "<p>定價：". substr($post['message'], strpos($post['message'], '金額：')+9, 
                                        strpos($post['message'], '4.',strpos($post['message'], '金額：')+9)-strpos($post['message'], '金額：')-9)."</p>";
                                    }

                                    // echo "<p>" . $post['message'] . "</p>";
                                }
                            }
                            
                            // check if post type is a link
                            if ($post['type'] == 'link') {
                                echo "<h3>Link posted on: " . date("jS M, Y", (strtotime($post['created_time']))) . "</h3>";
                                echo "<p>" . $post['name'] . "</p>";
                                echo "<p><a href=\"" . $post['link'] . "\" target=\"_blank\">" . $post['link'] . "</a></p>";
                                echo "<p>商品名稱：". substr($post['message'], strpos($post['message'], '商品：')+9, 
                                        strpos($post['message'], '2.',strpos($post['message'], '商品：')+9)-strpos($post['message'], '商品：')-9)."</p>";
                                echo "<p>說明：". substr($post['message'], strpos($post['message'], '容量：')+9, 
                                        strpos($post['message'], '3.',strpos($post['message'], '容量：')+9)-strpos($post['message'], '容量：')-9)."</p>";
                                if(strpos($post['message'],'定價金額')!==false){
                                      echo "<p>定價：". substr($post['message'], strpos($post['message'], '金額：')+9, 
                                        strpos($post['message'], '4.',strpos($post['message'], '金額：')+9)-strpos($post['message'], '金額：')-9)."</p>";
                                }
                            }
                            
                            // check if post type is a photo
                            if ($post['type'] == 'photo') {
                                echo "<h3>Photo posted on: " . date("jS M, Y", (strtotime($post['created_time']))) . "</h3>";
                                if (empty($post['story']) === false) {
                                    echo "<p>" . $post['story'] . "</p>";
                                } elseif (empty($post['message']) === false) {
                                    echo "<p>商品名稱：". substr($post['message'], strpos($post['message'], '商品：')+9, 
                                        strpos($post['message'], '2.',strpos($post['message'], '商品：')+9)-strpos($post['message'], '商品：')-9)."</p>";
                                    echo "<p>說明：". substr($post['message'], strpos($post['message'], '容量：')+9, 
                                        strpos($post['message'], '3.',strpos($post['message'], '容量：')+9)-strpos($post['message'], '容量：')-9)."</p>";
                                    if(strpos($post['message'],'定價金額')!==false){
                                      echo "<p>定價：". substr($post['message'], strpos($post['message'], '金額：')+9, 
                                        strpos($post['message'], '4.',strpos($post['message'], '金額：')+9)-strpos($post['message'], '金額：')-9)."</p>";
                                    }

                                    // echo "<p>" . $post['message'] . "</p>";
                                }
                                // echo "<p><a href=\"" . $post['link'] . "\" target=\"_blank\">View photo &rarr;</a></p>";
                                echo "<p><a href='".$post['picture']."'><img src='".$post['picture']."' /></a></p>";
                            }

                        }
                    
                    echo "</div>"; // close fb-update div
                    
                }
              } // end the foreach statement
                $i++;
                // if($i>5) break;
                echo "Looped page: ".$i."<br>";
                echo $next_until."<br>";
                echo substr($next,strpos($next,"until=")+6,10)."<br>";
                $next = $pagefeed['paging']['next'];
                if(strcmp($next_until,substr($next,strpos($next,"until=")+6,10))==0){
                  echo "Match!!!!";
                  $loop = false;
                }else{
                  echo "Doesn't match!!!";
                  $next_until = substr($next,strpos($next,"until=")+6,10);
                  $pagefeed = $facebook->api("/".$pageid."/feed?limit=10&".substr($next,strpos($next,"until"),strpos($next,"&__paging_token")-strpos($previous,"until")));
                }
            } // end of while loop

            echo "</div>";
        ?>
        
        
    </div>
</div>

</div>
</div>
<?php
ob_flush();
include('footer.php');
?>
</html>