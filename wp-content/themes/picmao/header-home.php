<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="360-site-verification" content="4e7c94695ee1affc5c6c5669abc753df" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="cache-control" content="no-siteapp">
<meta name="baidu-site-verification" content="o4T8Fj4CuH" />
 <meta name="shenma-site-verification" content="82585c15644c40d5295ec3d5dec098f9_1562470351"> 
  <meta name="sogou_site_verification" content="CwLzAuomDQ"/>
  <meta baidu-gxt-verify-token="475f65a73add70f06a993fdef98da639">

<title><?php echo _title() ?></title>
<?php wp_head(); ?>
<!--[if lt IE 9]><script src="<?php echo get_stylesheet_directory_uri(); ?>/js/html5.js"></script><![endif]-->

</head>


<body <?php body_class(_bodyclass()) ?>>

	<header class="header white touming">
	<div class="container_header">
		<h1 class="logo"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img src="<?php echo _hui('logo_src'); ?>"></a></h1>
		
		
				<div class="wel">
                  	<!--<div class="url-upload-work">
						<a class="upload-text"  href="<?php echo esc_url(home_url('/upwork'));  ?>"  target="_blank">上传赚钱</a>
						<a class="iconfontupload" href="<?php echo esc_url(home_url('/upwork'));  ?>"  target="_blank">&#xe661;</a> 
					</div>-->
                  	<?php if( is_user_logged_in() ){
						global $current_user;
					?>	
					
					<div class="wel-item viplogin">
							<a href="<?php echo home_url('/user?action=vip') ?>"  <?php 

							if(vip_type() =='0') {echo 'class="vip_type_imged_none"  title="开通VIP,尊享全站免费下"'; } 
							if(vip_type() == '31') {echo 'class="vip_type_imged_month"  title="包月VIP会员"'; } 
							if(vip_type() == '365') {echo 'class="vip_type_imged_year"  title="包年VIP会员"'; } 
							if(vip_type() == '3600') {echo 'class="vip_type_imged_all"  title="终身VIP会员"'; } 
						?>
						></a>
						</div>
				
					
					<div class="wel-item has-sub-menu">
						<a href="<?php echo home_url('/user') ?>">
							<?php echo _get_user_avatar( $current_user->user_email, true, 50); ?><span class="wel-name"><?php echo $current_user->display_name ?></span>
						</a>
						<div class="sub-menu">
							<ul>
								<!--新增-->
								<li><a  target="_blank" style="height:70px;border-radius:6px 6px 0 0;padding-top:0;background-image:;background-image: -webkit-linear-gradient(left,#ff9000 0,#fb3415 100%);
								    background-image: -o-linear-gradient(left,#ff9000 0,#fb3415 100%);
								    background-image: linear-gradient(to right,#ff9000 0,#fb3415 100%);
								    background-repeat: repeat-x;
								    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffff9000', endColorstr='#ffff5000', GradientType=1);
								    color: #fff;"  href="<?php echo home_url('/user') ?>">
									
								
									<span class="wel-name" style="font-size:18px;text-align:center;line-height:70px;" >
									<?php 

									if(vip_type() =='0') {echo '普通用户'; } 
									if(vip_type() == '31') {echo '包月VIP'; } 
									if(vip_type() == '365') {echo '包年VIP'; } 
									if(vip_type() == '3600') {echo '终身VIP';  } 
									?>
									</span>
									
								</a>
								</li>
								<li><a  target="_blank" style="height:118px;background:url(<?php echo _hui('header_vip_img'); ?>) center center no-repeat;"  href="<?php echo home_url('/user?action=vip') ?>">
									
								</a>
								</li>
								<?php if( $current_user->roles[0] == 'administrator'|| $current_user->roles[0] == 'editor') { ?>
								<li><a target="_blank" href="<?php echo home_url('/wp-admin/edit.php') ?>">后台管理</a></li>
					          	<?php } ?>
								<li><a  target="_blank"   href="<?php echo home_url('/user?action=order') ?>">我的订单</a></li>
								<li><a  target="_blank"    href="<?php echo home_url('/user?action=shouc') ?>">我的收藏</a></li>
                              	<li><a href="<?php echo home_url('/author/').$current_user->ID  ?>" >我的作品</a></li>
                              <?php if(current_user_can('administrator')|| current_user_can('sjoneadminer') ) { ?>
      								<li><a  target="_blank"   href="<?php echo home_url('/user?action=seller') ?>">我的销售</a></li>
      							<?php  } ?>
								<li><a  target="_blank"    href="<?php echo home_url('/user?action=vip') ?>">会员特权</a></li>
								<li><a  target="_blank"   href="<?php echo home_url('/user?action=info') ?>">修改资料</a></li>
								<li><a target="_blank"  href="<?php echo wp_logout_url(home_url()); ?>">退出</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="m-wel">
					<header>
						<?php echo _get_user_avatar( $current_user->user_email, true, 50); ?><h4><?php echo $current_user->display_name ?></h4>
						<h5><?php echo $current_user->user_email ?></h5>
					</header>
					<div class="m-wel-content">
						<ul>
							<li><a  target="_blank"   href="<?php echo home_url('/user?action=order') ?>">我的订单</a></li>
								<li><a  target="_blank"    href="<?php echo home_url('/user?action=shouc') ?>">我的收藏</a></li>
                          		<li><a href="<?php echo home_url('/author/').$current_user->ID  ?>">我的作品</a></li>
                          <?php if(current_user_can('administrator')|| current_user_can('sjoneadminer') ) { ?>
      								<li><a  target="_blank"   href="<?php echo home_url('/user?action=seller') ?>">我的销售</a></li>
      							<?php  } ?>
								<li><a  target="_blank"    href="<?php echo home_url('/user?action=vip') ?>">会员特权</a></li>
								<li><a  target="_blank"   href="<?php echo home_url('/user?action=info') ?>">修改资料</a></li>
						</ul>
					</div>
					<footer>
						<a href="<?php echo wp_logout_url(home_url()); ?>">退出当前账户</a>
					</footer>
				</div>
				<!-- <div class="signuser-welcome">
					<a class="signuser-info" href="<?php echo home_url('/user') ?>"><?php echo _get_user_avatar( $current_user->user_email, true, 50); ?><strong><?php echo $current_user->display_name ?></strong></a>
					<a class="signuser-logout" href="<?php echo wp_logout_url(home_url()); ?>">退出</a>
				</div> -->
		<?php }else{ ?>
			<div class="wel">
					<div class="wel-item wel-item-common">
						<a target="_blank" href="<?php echo home_url('/vipinfo') ?>" class="new_vipedname" >开通VIP
                      
                      <img src="<?php echo  get_stylesheet_directory_uri(); ?>/img/hot-header.png">
                      </a>
					</div>
					
				<div class="wel-item  wel-item-login "><a href="<?php echo home_url('login') ?>">登录</a></div>
				<div class="wel-item wel-item-btn  wel-item-reg"><a href="<?php echo home_url('/login?action=register') ?>">注册</a></div>
				<!-- <div class="wel-item"><a href="javascript:;" id="search"><i class="iconfont">&#xe67a;</i></a></div> -->
			</div>

			<div class="m-wel">
				<div class="m-wel-login">
					<img class="avatar" src="<?php echo get_stylesheet_directory_uri() . '/img/avatar.png';?>">
					<a class="m-wel-login" href="<?php echo home_url('login') ?>">登录</a>
					<a class="m-wel-register" href="<?php echo home_url('/login?action=register') ?>">注册</a>
				</div>
			</div>
      	</div>  <!-- 这里添加了div -->
		<?php } ?>

		<div class="site-navbar">
			<?php _the_menu('nav-home'); ?>
		</div>

		<div class="m-navbar-start"><i class="iconfont">&#xe648;</i></div>
		<div class="m-wel-start"><i class="iconfont">&#xe66b;</i></div>
		<div class="m-mask"></div>
	</div>
<!-- <div id="header-search-dropdown" class="header-search-dropdown ajax-search is-in-navbar js-ajax-search">
		<div class="container container--narrow">
			<form class="search-form search-form--horizontal" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
				<div class="search-form__input-wrap">
					<input type="text" name="s" class="search-form__input" placeholder="输入关键词进行搜索..." value="">
				</div>
				<div class="search-form__submit-wrap">
					<button type="submit" class="search-form__submit btn btn-primary">搜索一下</button>
				</div>
			</form>
			<div class="search-results">
				<div class="typing-loader"></div>
				<div class="search-results__inner"></div>
			</div>
		</div>
	</div> -->
</header>
<!-- 加载右下边客服 -->
	<?php   get_template_part('index','sidebar'); ?>
<?php  if(is_home()) { ?>
<script >
$(function(){
var home_tm=$('.header'); 

$(window).scroll(function(){
//console.log($(document).scrollTop());
if($(document).scrollTop()>=288){

home_tm.removeClass('touming').css('position','fixed');
}else{home_tm.addClass('touming').css('position','absolute');
        		}});	});
</script>
<?php   } ?>
<?php  is_move_os();  ?>
