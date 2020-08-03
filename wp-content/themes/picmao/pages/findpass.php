<?php
/**
 * template name: 忘记密码
 */
session_start();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>注册</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="fly,layui,前端社区">
  <meta name="description" content="Fly社区是模块化前端UI框架Layui的官网社区，致力于为web开发提供强劲动力">
  <link rel="stylesheet" href="<?php  echo get_stylesheet_directory_uri().'/layui/css/layui.css'; ?>">
 
</head>
<body>

<div class="fly-header layui-bg-black">
  <div class="layui-container">
    <a class="fly-logo" href="/">
      <img src="../../res/images/logo.png" alt="layui">
    </a>
    <ul class="layui-nav fly-nav layui-hide-xs">
      <li class="layui-nav-item layui-this">
        <a href="/"><i class="iconfont icon-jiaoliu"></i>忘记密码</a>
      </li>
      
    </ul>
    
    
  </div>
</div>

<div class="layui-container fly-marginTop">
  <div class="fly-panel fly-panel-user" pad20>
    <div class="layui-tab layui-tab-brief" lay-filter="user">
      <ul class="layui-tab-title">
       
        <li class="layui-this">邮箱找回密码</li>
      </ul>
      <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
        <div class="layui-tab-item layui-show">
          <div class="layui-form layui-form-pane">
            <form class="form-date"  action=""   method="post">
              <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_email" name="email" required lay-verify="email" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">已在本站注册的邮箱</div>
              </div>

              <!--  <div class="layui-form-item">
               <label for="L_vercode" class="layui-form-label">邮箱验证码</label>
               <div class="layui-input-inline">
                 <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
               </div>
               <div class="layui-form-mid">
                 <span style="color: #c00;">{{d.vercode}}</span>
               </div>
                            </div> -->
              <!-- <div class="layui-form-item">
                <label for="L_username" class="layui-form-label">昵称</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_username" name="username" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
              </div> -->
              <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">新密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="pass" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">6到16个字符</div>
              </div>
              <div class="layui-form-item">
                <label for="L_repass" class="layui-form-label">确认密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_repass" name="repass" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
              </div>
             
              <div class="layui-form-item">
                <button class="layui-btn  send-date  layui-btn-disabled"  disabled lay-filter="*" lay-submit >立即登录</button>
              </div>
             
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



<script src="<?php  echo get_stylesheet_directory_uri().'/layui/layui.js'; ?>"></script>
<script>
layui.use(['jquery','form','layer'],function(){

  var $=layui.jquery;
  var form= layui.form;
  var layer=layui.layer;
   
 $('#L_email').blur(function(){
    var val_text=$(this).val();
    if(val_text=="" || val_text==undefined || val_text==null  ){
     
    }else{

      $.post("<?php  echo get_stylesheet_directory_uri().'/action/findpass.php'; ?>",{useremail:val_text},function(res){


          var _res=JSON.parse(res);
          if(_res.code==2){

            layer.msg(_res.msg);

          }
           if(_res.code==1){
            $(".send-date").removeClass('layui-btn-disabled');
            $(".send-date").removeAttr("disabled");
          }
         

      })
    }


 });

   

});
</script>
<?php
if(isset($_POST)){
 if(!empty(esc_sql($_POST['email'])) && !empty(esc_sql($_POST['pass'])) && !empty(esc_sql($_POST['repass'])))
{   

    if(esc_sql($_POST['pass'])==esc_sql($_POST['repass'])){
   

$user_data=get_user_by('email',esc_sql($_POST['email']));
$uid=$user_data->ID;
$is_update_pass=wp_update_user(array('ID' =>$uid,'user_pass' => esc_sql($_POST['pass']),));
if($is_update_pass){


 echo '<script>window.history.back();</script>';
}
}
    
}

}









 ?>
</body>
</html>