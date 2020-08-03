<?php 

/**
 * template name: VIP信息未登录
 */

get_header();
$target_url=is_user_logged_in()?home_url('/user?action=vip'):home_url('/login');
$text_btn=is_user_logged_in()?'立即购买':'立即登录';
 ?>
 
<section class="vipcontainered">
	<div class="vip-banner">

</div>
    <div class="vip-container">
      <div class="w1200">
        <div class="con-title">VIP套餐</div>
        <div class="clearfix">
          <div class="con-wrap contrast fl">
            <p class="tr-1">对比</p>
            <p class="tr-2"></p>
            <p class="tr-6">下载方式</p>
            <p class="tr-6">下载数量</p>
            <p class="tr-6">收藏数量</p>
            <p class="tr-6">下载速度</p>
            </div>
          <div class="con-wrap free fl">
            <p class="tr-1">普通用户</p>
            <p class="tr-2"  style="font-size: 12px;">
              <i></i>
              <em>---</em></p>
             <p class="tr-6">付费即可下载</p>  
            <p class="tr-6">无限制</p>
            <p class="tr-7">海量</p>
            <p class="tr-8">20M/s</p>
           
          </div>
          <div class="con-wrap gx fl">
            <p class="tr-1">
              <span>包月VIP</span></p>
            <p class="tr-2">
              <span>HOT</span>
              <i>¥</i>
              <em><?php echo _hui('vip_price_31'); ?></em>/月</p>
               <p class="tr-7">免费下载</p>
            <p class="tr-7">每天<?php echo _hui('vip_downtimeed_31'); ?>个(免费素材无限制)
              <span class="vip-warning"></span></p>
            <p class="tr-7">海量</p>
            <p class="tr-8">20M/s极速
              <span class="vip-warning"></span></p>
            
            <p class="tr-12">
              <span class="qt-btn btn-orange-linear">
                <a href="<?php echo $target_url; ?>" data-mark-header="h_v_t_c_1"><?php echo $text_btn; ?></a></span>
              </p>
          </div>
          <div class="con-wrap yc   fl">
            <p class="tr-1">
              <span>包年VIP</span></p>
            <p class="tr-2">
              <span>HOT</span>
              <i>¥</i>
              <em><?php echo _hui('vip_price_365'); ?></em>/年</p>
            <p class="tr-7">免费下载</p>
            <p class="tr-7">每天<?php echo _hui('vip_downtimeed_365'); ?>个(免费素材无限制)</p>
            <p class="tr-7">海量</p>
            <p class="tr-8">20M/s极速</p>
            
            <p class="tr-12">
              <span class="qt-btn btn-green-linear">
                <a href="<?php echo $target_url; ?>" data-mark-header="h_v_t_c_2"><?php echo $text_btn; ?></a></span>
             </p>
          </div>
          <div class="con-wrap bg   fl">
            <p class="tr-1">
              <span>终身VIP</span></p>
            <p class="tr-2">
              <span>HOT</span>
              <i>¥</i>
              <em><?php echo _hui('vip_price_3600'); ?></em>/年</p>
            <p class="tr-7">免费下载</p>
            <p class="tr-7"><?php echo _hui('vip_downtimeed_3600'); ?></p>
            <p class="tr-7">海量</p>
            <p class="tr-8">20M/s极速</p>
            
            <p class="tr-12">
              <span class="qt-btn btn-blue-linear">
                <a href="<?php echo $target_url; ?>" data-mark-header="h_v_t_c_3"><?php echo $text_btn; ?></a></span>
              </p>
          </div>
        </div>
      </div>
    </div>
  
</section >
		<style>


.vipcontainered .vip-banner {
    height: 460px;
    background:url(http://img-bg.sjoneone.com/viprcn_top.png) center no-repeat;
    font-size: 0;
    text-align: center;
}			
			

.vipcontainered .vip-container {
	height: 1024px;
	background: #fff;
	padding-bottom: 20px;
	position: relative
}



.vipcontainered .vip-container .con-title {
	padding: 40px 0 60px;
	text-align: center;
	font-size: 44px;
	font-weight: 300;
	color: #666
}

.vipcontainered .vip-container .con-wrap {
	position: relative;
	width: 231px;
	border: solid 1px #e5e5e5;
	border-bottom: 0;
	margin-left: -1px;
	-webkit-border-radius: 2px;
	border-radius: 2px;
	-webkit-transition: all .28s;
	-moz-transition: all .28s;
	transition: all .28s
}

.vipcontainered .vip-container .con-wrap:hover,.vip-container .con-wrap.on {
	-webkit-box-shadow: 0 1px 20px 0 rgba(3,3,3,.17);
	box-shadow: 0 1px 20px 0 rgba(3,3,3,.17);
	z-index: 10;
	/* -webkit-transform: scale(1.05,1);
	-moz-transform: scale(1.05,1);
	-ms-transform: scale(1.05,1); */
	transform: scale(1.09,1)
}



.vipcontainered .vip-container .con-wrap:hover .tr-12,.vip-container .con-wrap.on .tr-12 {
	height: 106px
}

.vipcontainered .vip-container .con-wrap:first-child {
	width: 260px;
	margin-left: 0
}

.vipcontainered .vip-container .con-wrap p {
	position: relative;
	border-bottom: solid 1px #e5e5e5;
	text-align: center;
	background: #fff
}

.vipcontainered .vip-container .con-wrap .tr-1 {
	padding-top: 16px;
	font-size: 24px;
	height: 65px;
	font-weight: 300;
	color: #fff
}

.vipcontainered .vip-container .con-wrap .tr-2 {
	padding-top: 14px;
	height: 122px;
	font-size: 16px;
	color: #999
}

.vipcontainered .vip-container .con-wrap .tr-2 em {
	font-size: 60px;
	color: #666;
	font-weight: 300;
	font-family: SanFranciscoDisplay
}

.vip-container .con-wrap .tr-2 i {
	position: relative;
	font-weight: 300;
	top: -34px;
	color: #666;
	font-size: 20px
}

.vipcontainered .vip-container .con-wrap .tr-2 span {
	left: 107px;
	top: -54px;
	position: relative;
	background: #ff8b2e;
	-webkit-border-radius: 10.5px 10.5px 10.5px 0;
	border-radius: 10.5px 10.5px 10.5px 0;
	width: 38px;
	height: 22px;
	font-size: 14px;
	line-height: 22px;
	color: #fff;
	text-align: center;
	display: inline-block
}

.vip-container .con-wrap .tr-3,.vip-container .con-wrap .tr-4,.vip-container .con-wrap .tr-5 {
	height: 60px;
	font-size: 14px;
	color: #666
}

.vip-container .con-wrap .tr-6,.vip-container .con-wrap .tr-7,.vip-container .con-wrap .tr-8,.vip-container .con-wrap .tr-9,.vip-container .con-wrap .tr-10,.vip-container .con-wrap .tr-11 {
	height: 70px;
	line-height: 50px;
	font-size: 14px;
	color: #666
}

.vip-container .con-wrap .tr-12 {
	height: 0;
	overflow: hidden;
	text-align: center;
	-webkit-transition: height .28s;
	-moz-transition: height .28s;
	transition: height .28s
}

.vip-container .con-wrap .tr-12 .qt-btn {
	width: 132px;
	height: 46px;
	line-height: 46px;
	margin-top: 18px
}

.vip-container .con-wrap .tr-12 .qt-btn a {
	font-size: 18px;
	font-weight: 300
}

.vip-container .con-wrap .tr-12 em {
	display: block;
	text-align: center;
	font-size: 14px;
	color: #666;
	margin-top: 6px
}

.vip-container .con-wrap.contrast {
	-webkit-box-shadow: 0 1px 10px 0 rgba(3,3,3,.17);
	box-shadow: 0 1px 10px 0 rgba(3,3,3,.17)
}

.vip-container .con-wrap.contrast * {
	color: #333;
	font-size: 16px
}

.vip-container .con-wrap.contrast .tr-1 {
	font-size: 24px
}

.vip-container .con-wrap.contrast .tr-3,.vip-container .con-wrap.contrast .tr-4,.vip-container .con-wrap.contrast .tr-5 {
	padding: 8px 15px;
	text-align: left
}





.vip-container .con-wrap.contrast .tr-5 {
	color: #4ea1f8
}

.vip-container .con-wrap.contrast .tr-5 .vip-tag {
	background-position: -130px 0
}

.vip-container .con-wrap.free .tr-1 {
	background-color: #ececec;
	color: #666
}

.vip-container .con-wrap.free .tr-3,.vip-container .con-wrap.free .tr-5 {
	padding-top: 12px
}

.vip-container .con-wrap.free .tr-4 {
	line-height: 60px
}

.vip-container .con-wrap.yc {
	border: 1px #ff8b2e solid
}

.vip-container .con-wrap.yc .vip-ok {
	background-position-x: -82px;
}

.vip-container .con-wrap.yc .tr-1 {
	background-color: #e66f0f;
}

.vip-container .con-wrap.yc .tr-2 {
	padding-right: 31px;
}

.vip-container .con-wrap.yc .tr-2 span {
	background:#ff8b2e;
	left: 116px;
}

.vip-container .con-wrap.yc .tr-3,.vip-container .con-wrap.yc .tr-4,.vip-container .con-wrap.yc .tr-5 {
	line-height: 60px
}

.vip-container .con-wrap.yc .tr-6 {
	color: #ff8b2e;
}

.vip-container .con-wrap.yc .tr-11 .icon-shangyongbiaoshi {
	vertical-align: -1px;
	display: inline-block
}

.vip-container .con-wrap.gx {
	border: 1px #ff8b2e solid
}

.vip-container .con-wrap.gx .vip-ok {
	background-position-x: -57px
}

.vip-container .con-wrap.gx .tr-1 {
	background-color: #fa9a35
}

.vip-container .con-wrap.gx .tr-2 {
	padding-right: 31px
}

.vip-container .con-wrap.gx .tr-3,.vip-container .con-wrap.gx .tr-4,.vip-container .con-wrap.gx .tr-5 {
	line-height: 60px
}

.vip-container .con-wrap.gx .tr-6 {
	color: #fa9a35
}

.vip-container .con-wrap.bg {
	border: 1px #ff8b2e solid
}

.vip-container .con-wrap.bg .vip-ok {
	background-position-x: -107px
}

.vip-container .con-wrap.bg .tr-1 {
	background-color: #ca5d05
}

.vip-container .con-wrap.bg .tr-2 {
	padding-right: 31px
}

.vip-container .con-wrap.bg .tr-2 span {
	background: #ff8b2e;
	left: 117px
}

.vip-container .con-wrap.bg .tr-3,.vip-container .con-wrap.bg .tr-4,.vip-container .con-wrap.bg .tr-5 {
	line-height: 60px
}

.vip-container .con-wrap.bg .tr-6 {
	color: #4ea1f8
}

.vip-container .con-wrap.gx .tr-1,.vip-container .con-wrap.bg .tr-1,.vip-container .con-wrap.yc .tr-1 {
	padding-top: 0
}

.vip-container .con-wrap.gx .tr-1 span,.vip-container .con-wrap.bg .tr-1 span,.vip-container .con-wrap.yc .tr-1 span {
	position: absolute;
	bottom: -1px;
	left: -1px;
	width: 231px;
	height: 65px;
	padding-top: 16px;
	background-color: inherit;
	-webkit-border-radius: 2px 2px 0 0;
	border-radius: 2px 2px 0 0;
	-webkit-transition: height .28s;
	-moz-transition: height .28s;
	transition: height .28s
}

.vip-container .con-wrap.gx .tr-1 span,.vip-container .con-wrap.gx .tr-1 em,.vip-container .con-wrap.bg .tr-1 span,.vip-container .con-wrap.bg .tr-1 em,.vip-container .con-wrap.yc .tr-1 span,.vip-container .con-wrap.yc .tr-1 em {
	color: #fff;
	text-align: center
}

.vip-container .con-wrap.gx .tr-1 em,.vip-container .con-wrap.bg .tr-1 em,.vip-container .con-wrap.yc .tr-1 em {
	display: none;
	font-size: 14px;
	margin-top: 7px
}

.vip-container .con-wrap.gx .tr-12,.vip-container .con-wrap.bg .tr-12,.vip-container .con-wrap.yc .tr-12 {
	border: 0
}





* {
	
	
	font-family: PingFangSC-Regular,sans-serif,PingFangSC-Light,sans-serif,"Microsoft YaHei",arial;
	
}



.fl {
	float: left
}

.fr {
	float: right
}



.w1200 {
	width: 1200px;
	margin: 0 auto
}

.w1440 {
	width: 1440px;
	margin: 0 auto
}

.qt-btn:hover,.qt-model .model-btn>a:hover,.qt-model .model-content {
	-webkit-box-shadow: 0 2px 8px 0 rgba(0,0,0,.15);
	box-shadow: 0 2px 8px 0 rgba(0,0,0,.15)
}

.qt-btn {
	display: inline-block;
	vertical-align: middle
}

.qt-btn,.qt-footer-other {
	height: 56px;
	line-height: 56px;
	text-align: center
}



.btn-blue-linear a,.btn-green-linear a,.btn-orange-linear a {
	color: #fff!important
}

.qt-btn {
	width: 200px;
	border-radius: 4px;
	border: 1px solid #ccc;
	cursor: pointer
}

.qt-btn a {
	display: block;
	height: 100%;
	text-align: center
}

.qt-btn:hover {
	-webkit-transition: all .2s;
	transition: all .2s;
	opacity: .9
}

.btn-green-linear {
	background-image: -webkit-gradient(linear,left top,right top,from(#fda233),to(#fd8320));
    background-image: -webkit-linear-gradient(left,#fda233,#fd8320);
    /* background-image: linear-gradient(to right,#fda233,#fd8320); */
    FILTER: progid:DXImageTransform . Microsoft . Gradient(gradientType=1, startColorStr=#fda233, endColorStr=#fd8320);
    border: 0;
}

.btn-green-linear:hover {
	background-image: -webkit-gradient(linear,left top,right top,from(#fda233),to(#fd8320));
    background-image: -webkit-linear-gradient(left,#fda233,#fd8320);
    /* background-image: linear-gradient(to right,#fda233,#fd8320); */
    FILTER: progid:DXImageTransform . Microsoft . Gradient(gradientType=1, startColorStr=#fda233, endColorStr=#fd8320);
    border: 0;
}

.btn-orange-linear {
	background-image: -webkit-gradient(linear,left top,right top,from(#fda233),to(#fd8320));
    background-image: -webkit-linear-gradient(left,#fda233,#fd8320);
    /* background-image: linear-gradient(to right,#fda233,#fd8320); */
    FILTER: progid:DXImageTransform . Microsoft . Gradient(gradientType=1, startColorStr=#fda233, endColorStr=#fd8320);
    border: 0;
}

.btn-orange-linear:hover {
	background-image: -webkit-gradient(linear,left top,right top,from(#fda233),to(#fd8320));
    background-image: -webkit-linear-gradient(left,#fda233,#fd8320);
    /* background-image: linear-gradient(to right,#fda233,#fd8320); */
    FILTER: progid:DXImageTransform . Microsoft . Gradient(gradientType=1, startColorStr=#fda233, endColorStr=#fd8320);
    border: 0;
}

.btn-blue-linear,.btn-blue-linear:hover {
	background-image: -webkit-gradient(linear,left top,right top,from(#fda233),to(#fd8320));
    background-image: -webkit-linear-gradient(left,#fda233,#fd8320);
    /* background-image: linear-gradient(to right,#fda233,#fd8320); */
    FILTER: progid:DXImageTransform . Microsoft . Gradient(gradientType=1, startColorStr=#fda233, endColorStr=#fd8320);
    border: 0;
}

.btn-blue-linear {
	background-image: -webkit-gradient(linear,left top,right top,from(#fda233),to(#fd8320));
    background-image: -webkit-linear-gradient(left,#fda233,#fd8320);
    /* background-image: linear-gradient(to right,#fda233,#fd8320); */
    FILTER: progid:DXImageTransform . Microsoft . Gradient(gradientType=1, startColorStr=#fda233, endColorStr=#fd8320);
    border: 0;
}

.btn-blue-linear:hover {
	background-image: -webkit-gradient(linear,left top,right top,from(#fda233),to(#fd8320));
    background-image: -webkit-linear-gradient(left,#fda233,#fd8320);
    /* background-image: linear-gradient(to right,#fda233,#fd8320); */
    FILTER: progid:DXImageTransform . Microsoft . Gradient(gradientType=1, startColorStr=#fda233, endColorStr=#fd8320);
    border: 0;
}

.btn-blue-linear:hover {
	background-image: -webkit-gradient(linear,left top,right top,from(#fda233),to(#fd8320));
    background-image: -webkit-linear-gradient(left,#fda233,#fd8320);
    /* background-image: linear-gradient(to right,#fda233,#fd8320); */
    FILTER: progid:DXImageTransform . Microsoft . Gradient(gradientType=1, startColorStr=#fda233, endColorStr=#fd8320);
    border: 0;
}



		</style>

		<?php get_footer(); ?>