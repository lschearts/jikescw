<footer class="footer">
	<h2 class="logos"><img src="<?php echo get_template_directory_uri(); ?>/img/logo_foot.png"></h2>
	<?php if( _hui('bomnav_s') ){ ?>
		<div class="bomnav">
			<ul><?php _the_menu('bomnav'); ?></ul>
		</div>
	<?php } ?>
	<!-- 二维码 -->
<!-- <div class="right-bar" >
<img src="<?php  echo get_template_directory_uri(); ?>/img/qrcode.png"><i class=""></i><span>扫描二维码,关注我们</span>	
</div> -->
<div class="safe-sign" style="position: absolute;top:120px;left: 0;right: 0;margin: 0 auto;">
	
<a href="http://hao.360.cn/" target="_blank"><img src="http://p8.qhimg.com/d/inn/ff2ee078/zodiac/logo_def.png"/></a>

</div>
<div class="site-copyed">

		<a style="display:inline-block;width:20px;height:20px;background: url(http://up-picd.sjoneone.com/TB1..50QpXXXXX7XpXXXXXXXXXX-40-40.png) no-repeat center center;background-size:20px 20px;"> </a>
		<a style="display:inline-block;width:20px;height:20px;background: url(http://up-picd.sjoneone.com/TB1GxwdSXXXXXa.aXXXXXXXXXXX-65-70.gif) no-repeat center center;background-size:20px 20px;"  > </a>
	备案证号：<?php echo _hui('beianhao'); ?>&nbsp;&nbsp; Copyright&copy;<?php echo date('Y'); ?> &nbsp; <?php echo $_SERVER['SERVER_NAME']; ?> 版权所有
  
    <?php echo get_option('zh_cn_l10n_icp_num') ? get_option('zh_cn_l10n_icp_num').' &nbsp; ' : ''; ?>
    <?php echo _hui('themecopyright') ? _hui('themecopyright').' &nbsp; ' : ''; ?>
    <?php echo _hui('trackcode') ?>
  </div>
</footer>

<!-- <?php get_template_part( 'module/content', 'module-rewards' ); ?>  -->

<script>
	<?php  
		$ajaxpager = '0';
		if( ((!wp_is_mobile() &&_hui('ajaxpager_s')) || (wp_is_mobile() && _hui('ajaxpager_s_m'))) && _hui('ajaxpager') ){
			$ajaxpager = _hui('ajaxpager');
		}

		$shareimage = _hui('share_base_image') ? _hui('share_base_image') : '';
		if( is_single() || is_page() ){
			$thumburl = _get_post_thumbnail_url(false, '');
			if( $thumburl ){
				$shareimage = $thumburl; 
			}
		}
		$shareimagethumb = _hui('share_post_image_thumb') ? 1 : 0;
		if (is_home() && _hui('iscustomnote') ==1 ) {
			$iscustomnote 	= 1;
			$customnotehtml  = _hui('customnotehtml');
		}else{
			$iscustomnote 	= 0;
			$customnotehtml  = '';
		}

	?>
  		
	window.TBUI = {
		uri             : '<?php echo get_stylesheet_directory_uri() ?>',
		ajaxpager       : '<?php echo $ajaxpager ?>',
		pagenum         : '<?php echo get_option('posts_per_page', 20) ?>',
		shareimage      : '<?php echo $shareimage ?>',
		shareimagethumb : '<?php echo $shareimagethumb ?>',
		iscustomnote 	: '<?php echo $iscustomnote ?>',
		customnotehtml 	: '<?php echo $customnotehtml ?>'
	}
     

</script>
<?php  if ( has_post_format( 'video' )) {     ?>
<script >
           $(function(){

           $('iframe').css({'width':'1280px','height':'720px'});
                $('.article-focusbox').append($('iframe'));
                
			      

           });
                
           
        </script>
<?php } ?>
<?php wp_footer(); ?>

<?php if( _hui('footcode') ) echo _hui('footcode') ?>

</body>
</html>