

<?php 
/**
 * template name: 登录注册页面
 */
// 完整验证页面


//登录后返回前一页
if (!isset($_SESSION)) 
{
  session_start();             
  session_regenerate_id();
}

if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '' 
&& strpos($_SERVER['HTTP_REFERER'],'admin') == false
&& strpos($_SERVER['HTTP_REFERER'],'login') == false)
{
  // 登陆前的页面地址
  // 如果你想登陆后返回首页，请将 $_SERVER['HTTP_REFERER'] 改成 'http://你的首页网址'
  $_SESSION["REFERER"] = $_SERVER['HTTP_REFERER']; 
}
if(is_user_logged_in()){


	//header("Location:".home_url('/user'));
		header("Location:".$_SESSION["REFERER"]);
				echo '<script>
			location.reload();
						</script>';
	//exit();
}

get_header();
global $wpdb,$current_user;

?>


<div class="sign-bg" style="background-image:url(<?php echo _hui('login_bg_img') ?>)"></div>



<section class="sign-container">
	<header>
		<div class="logo"><a href="<?php echo home_url('/') ?>" ><img src="<?php echo _hui('login_logo_src'); ?>"></a></div>
	</header>
<?php if(isset($_GET['action']) == 'register'){ ?>
	<form class="sign-form register-start" name="registerform">
		<!-- <h1>新用户注册</h1> -->
        <div class="sign-tips"></div>
		
		<div class="item">
		    <label>用户名</label>
		    <input class="ipt" id="user_name" type="text" name="user_name" placeholder="输入英文用户名" required="" autocomplete="off" />
		</div>
		<div class="item">
		    <label>绑定邮箱</label>
		    <input class="ipt" id="user_email" type="email" name="user_email" placeholder="输入常用邮箱" required="" autocomplete="off" />
	    </div>
		<div class="item">
		    <label>设置密码</label>
		    <input class="ipt" id="user_pass" type="password" name="user_pass" placeholder="密码最小长度为6" required="" autocomplete="off" />
		</div>
		<div class="item">
		    <label>再次输入密码</label>
		    <input class="ipt" id="user_pass2" type="password" name="user_pass2" placeholder="密码最小长度为6" required="" autocomplete="off" />
		</div>
		<div class="item">
		    <input class="ipt" id="captcha" type="text" name="captcha" placeholder="输入验证码" required="" />
		    <span class="captcha-clk inline">发送邮箱验证码</span>
		</div>
		<div class="sign-submit">
		    <input type="hidden" name="action" value="WPAY_register">
		    <input class="btn btn-primary btn-block register-loader" type="button" name="submit" value="立即注册" />
	    </div>
		
		<?php if( _hui('is_oauth_qq',false)) { ?>
			<div class="sign-qq">
			    <a href="<?php echo get_stylesheet_directory_uri() . '/oauth/qq?rurl='.home_url(); ?>" title="使用QQ账户登录"></a>
		    </div>
		<?php } ?>

	
		<footer>已有账户，请直接 <a href="<?php echo home_url('/login') ?>">登录</a></footer>

	</form>
<?php }else{ ?>
	<form id="login" class="sign-form" action="" method="post" novalidate="novalidate"/>
	    <!-- <h1>登录</h1> -->
	    <div class="sign-tips"></div>
	    <div class="item">
	        <label>登录邮箱或用户名</label>
	        <input type="text" name="username" class="ipt" id="username" placeholder="输入登录邮箱或用户名"/>
	    </div>
	    <div class="item">
	        <label>
	        登录密码</label>
	        <input type="password" name="password" class="ipt" id="password" placeholder="输入登录密码"/>
	    </div>


		<!-- <div class="item">
	        <label>验证码</label>
	        <input style="width:150px;"  type="text" name="captchaNum" class="ipt  yanzminput" id="captchaNum" placeholder=""/>
	        <img class="yanzm" style="cursor: pointer;" title="点击刷新" src="<?php echo get_template_directory_uri() . '/inc/captcha/captcha.php';?>" align="absbottom" onclick="this.src='<?php echo get_stylesheet_directory_uri() . '/inc/captcha/captcha.php';?>?'+Math.random();" />
	    </div> -->

	
	    <div class="item">
	        <label>
		    <input type="checkbox" id="rememberme" checked="checked" value="forever"/>记住密码
	         <a href="<?php echo get_option('home'); ?>/findpass" class="sign-login-rp">忘记密码？</a>
	    	</label>

	    </div>

	    <div class="sign-submit">
			<input type="hidden" name="action" value="wpay_login"/>
	    	<input class="submit btn btn-primary btn-block login-loader" type="submit" value="登录" name="submit"/>
	    </div>
	    <?php if( _hui('is_oauth_qq',false)) { ?>
			<div class="sign-qq">
			    <a href="<?php echo get_stylesheet_directory_uri() . '/oauth/qq?rurl='.home_url(); ?>" title="使用QQ账户登录"></a>
		    </div>
		<?php } ?>
	</form>
	<footer>还没有账号？ <a href="<?php echo home_url('/login?action=register') ?>">新用户注册</a></footer>
<?php } ?>
</section>


<?php get_footer(); ?>