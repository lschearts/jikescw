<?php

/*
Template Name: 下载跳转
*/ 



?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri().'/layui/css/layui.css' ?>">
<script src="<?php echo get_stylesheet_directory_uri().'/layui/layui.js' ?>"></script>
<?php    

date_default_timezone_set('Asia/Shanghai');
if(!is_user_logged_in()){
    header("Location:".home_url('login'));
    exit();
}
global $post;

$parse_query=_sjone_code($_SERVER["QUERY_STRING"],'DECODE');
parse_str($parse_query);
$prev_url     = $url;
$prev_id      = $ppid;
$used_id      = $uuid;
$allow_down_time_=3;//允许下载的次数
$post_down_count=get_post_meta($prev_id, 'post_download_count', true);
$user_down_count=get_user_meta($used_id, 'user_download_count', true);
$now_time=get_user_meta($used_id, 'user_download_time', true);

//检测某篇文章下载次数
if(!$post_down_count){
    add_post_meta($prev_id, 'post_download_count',1, true);
}elseif($post_down_count=='-3'){  //开始给每篇文章加的字段好方便排序
   update_post_meta($prev_id, 'post_download_count',1);
   
}else{

    update_post_meta($prev_id, 'post_download_count',$post_down_count+1);
}

//检测某用户下载次数

switch(intval(vip_type())){
  case 31:
  $allow_down_time_=_hui('vip_downtimeed_31');
  break;
  case 365:
  $allow_down_time_=_hui('vip_downtimeed_365');
  break;
 }
if(intval(vip_type())!=0  && intval(vip_type())!=3600 && get_post_meta($prev_id,'wppay_type',true)!=4){
if(empty($user_down_count)){
    add_user_meta($used_id, 'user_download_count',1, true);
    add_user_meta($used_id, 'user_download_time',time(), true);
}else{  
     if(date('Ymd',time())==date('Ymd',$now_time)){

         if($user_down_count>=$allow_down_time_){

             echo '<script>layui.use(["layer","jquery"],function(){var layer=layui.layer;
                var $= layui.jquery;
           layer.open({
          closeBtn: 2
          ,anim:6
          ,title: false
          
          ,shade: [0.8, "#393D49"]
  ,content: "<h3 style=\'text-align:center;\'>今天下载次数已用完</h3>"
  ,btn: ["立即升级VIP", "残忍拒绝"]
  ,yes: function(index, layero){
   window.location.href="http://www.sjoneone.com/user?action=vip"
  }
  ,btn2: function(index, layero){
    window.close();
    
    //return false 开启该代码可禁止点击该按钮关闭
  }
 
  ,cancel: function(){ 
    window.close();
    
    //return false 开启该代码可禁止点击该按钮关闭
  }
});
                });</script>';
           

            exit();
          }

           if(get_post_meta($prev_id,'wppay_type',true)!=4){
         update_user_meta($used_id, 'user_download_count',$user_down_count+1);
       }

        }else{

              update_user_meta($used_id, 'user_download_count',1);
          update_user_meta($used_id, 'user_download_time',time()); 

        }
        
         
}

    
}   
    

















//分析下载地址
if(!empty($prev_url)) {
  preg_match('/(http|https):\/\//',$prev_url,$matches);
  if($matches){
    
    $title='智能为你选择高速下载通道,请稍候...';
  } else {
    $title='加载中...';
    echo "<script>setTimeout(function(){window.opener=null;window.close();}, 3000);</script>";
  }
}

?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="refresh" content="1;url=<?php echo $prev_url; ?>" />
   <!-- <script>
       window.location.href="<?php echo $prev_url;  ?>";
    </script>-->
    <title>
         <?php echo $title;?>
       
    </title>
    <style>
        body{background:#999;margin:0;}.loader{-webkit-animation:fadein 2s;-moz-animation:fadein 2s;-o-animation:fadein 2s;animation:fadein 2s;position:absolute;top:0;left:0;right:0;bottom:0;background-color:#fff;}@-moz-keyframes fadein{from{opacity:0}to{opacity:1}}@-webkit-keyframes fadein{from{opacity:0}to{opacity:1}}@-o-keyframes fadein{from{opacity:0}to{opacity:1}}@keyframes fadein{from{opacity:0}to{opacity:1}}.loader-inner{position:absolute;z-index:300;top:40%;left:50%;-webkit-transform:translate(-50%,-50%);-moz-transform:translate(-50%,-50%);-ms-transform:translate(-50%,-50%);-o-transform:translate(-50%,-50%);transform:translate(-50%,-50%);}@-webkit-keyframes rotate_pacman_half_up{0%{-webkit-transform:rotate(270deg);transform:rotate(270deg);}50%{-webkit-transform:rotate(360deg);transform:rotate(360deg);}100%{-webkit-transform:rotate(270deg);transform:rotate(270deg);}}@keyframes rotate_pacman_half_up{0%{-webkit-transform:rotate(270deg);transform:rotate(270deg);}50%{-webkit-transform:rotate(360deg);transform:rotate(360deg);}100%{-webkit-transform:rotate(270deg);transform:rotate(270deg);}}@-webkit-keyframes rotate_pacman_half_down{0%{-webkit-transform:rotate(90deg);transform:rotate(90deg);}50%{-webkit-transform:rotate(0deg);transform:rotate(0deg);}100%{-webkit-transform:rotate(90deg);transform:rotate(90deg);}}@keyframes rotate_pacman_half_down{0%{-webkit-transform:rotate(90deg);transform:rotate(90deg);}50%{-webkit-transform:rotate(0deg);transform:rotate(0deg);}100%{-webkit-transform:rotate(90deg);transform:rotate(90deg);}}@-webkit-keyframes pacman-balls{75%{opacity:0.7;}100%{-webkit-transform:translate(-100px,-6.25px);transform:translate(-100px,-6.25px);}}@keyframes pacman-balls{75%{opacity:0.7;}100%{-webkit-transform:translate(-100px,-6.25px);transform:translate(-100px,-6.25px);}}.pacman > div:nth-child(2){-webkit-animation:pacman-balls 1s 0s infinite linear;animation:pacman-balls 1s 0s infinite linear;}.pacman > div:nth-child(3){-webkit-animation:pacman-balls 1s 0.33s infinite linear;animation:pacman-balls 1s 0.33s infinite linear;}.pacman > div:nth-child(4){-webkit-animation:pacman-balls 1s 0.66s infinite linear;animation:pacman-balls 1s 0.66s infinite linear;}.pacman > div:nth-child(5){-webkit-animation:pacman-balls 1s 0.99s infinite linear;animation:pacman-balls 1s 0.99s infinite linear;}.pacman > div:first-of-type{width:0px;height:0px;border-right:25px solid transparent;border-top:25px solid #e1244e;border-left:25px solid #e1244e;border-bottom:25px solid #e1244e;border-radius:25px;-webkit-animation:rotate_pacman_half_up 0.5s 0s infinite;animation:rotate_pacman_half_up 0.5s 0s infinite;}.pacman > div:nth-child(2){width:0px;height:0px;border-right:25px solid transparent;border-top:25px solid #e1244e;border-left:25px solid #e1244e;border-bottom:25px solid #e1244e;border-radius:25px;-webkit-animation:rotate_pacman_half_down 0.5s 0s infinite;animation:rotate_pacman_half_down 0.5s 0s infinite;margin-top:-50px;}.pacman > div:nth-child(3),.pacman > div:nth-child(4),.pacman > div:nth-child(5),.pacman > div:nth-child(6){background-color:#e1244e;width:15px;height:15px;border-radius:100%;margin:2px;width:10px;height:10px;position:absolute;-webkit-transform:translate(0,-6.25px);-ms-transform:translate(0,-6.25px);transform:translate(0,-6.25px);top:25px;left:100px;}.loader-text{margin:20px 0 0 -16px;display:block;font-size: 18px;}
    </style>
</head>

<body>
    <div class="loader">
        <div class="loader-inner pacman">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <span class="loader-text">智能为你选择高速下载通道,请稍候...</span>
        </div>
    </div>
   
</body>

<script>
//禁止F12和右键查看
document.oncontextmenu = function () { return false; };
document.onkeydown = function () {
if (window.event && window.event.keyCode == 123) {
event.keyCode = 0;
event.returnValue = false;
return false;
}
};
</script>
</html>









