<?php get_header(); $paged = get_query_var('paged'); ?>
<link rel="stylesheet" type="text/css" href="<?php  echo get_stylesheet_directory_uri()?>/css/animate.min.css">



<!-- 幻灯片 -->
<?php function mo_slider( $id='focusslide' ){
    $inner = '';
    $sort = _hui($id.'_sort') ? _hui($id.'_sort') : '1 2 3';
    $sort = array_unique(explode(' ', trim($sort)));
    $i = 0;
    foreach ($sort as $key => $value) {
        if( _hui($id.'_src_'.$value) && _hui($id.'_href_'.$value) && _hui($id.'_title_'.$value) ){

        	$inner .= '<div class="swiper-slide"><div class="focusbox" style="background-image: url('._hui($id.'_src_'.$value).')">
					    	

							<a'.( _hui($id.'_blank_'.$value) ? ' target="_blank"' : '' ).' href="'.home_url().'/go.php?'._hui($id.'_href_'.$value).'" class=" side-bar-a" ></a>

					    	
					    	
					    	<!--<div class="container">
					    		<h3 class="focusbox-title">'._hui($id.'_title_'.$value).'</h3>
					    		<div class="focusbox-text">'._hui($id.'_desc_'.$value).'</div>
					    		<a'.( _hui($id.'_blank_'.$value) ? ' target="_blank"' : '' ).' href="'._hui($id.'_href_'.$value).'" class="btn btn-wiht" style=" margin-bottom: 1rem; "><i class="iconfont">&#xe641;</i> 查看详情</a>
					    	</div>-->
					    </div></div>';
            $i++;
        }
    }
    echo ''.$inner.'';
}
?>

<?php  if (is_home() && _hui('home_header_style','style_0') =="style_0" ) { ?>
<section class="container-white  top-side-bar">
	<!--搜索器start-->
<div class="search-go">
<form class="search-form " method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">	
<input type="text" name="s" class="search-form__input" placeholder="输入关键词进行搜索..." value="">
<button type="submit" class="search-form-btn"><i class="iconfont">&#xe67a;</i></button>
</form>
<div class="hot-search-box"> 
   <ul> 
    <li>热门搜索：</li>
    <?php 
    $hot_search=explode('-',_hui('hot-search-box'));
    $hot_count=is_array($hot_search)?count($hot_search):'';
    for($i=0;$i<$hot_count;$i++){ ?>
    <li><a target="_blank" href="<?php echo home_url().'/?s='.$hot_search[$i]; ?>"><?php echo $hot_search[$i]; ?></a></li>
    <?php } ?>
   </ul> 
  </div>


</div>
<style>
	
	/*首页搜索下面的热门搜索词语*/

.top-side-bar .search-go .hot-search-box {
    color: #fff;
    text-align: center;
    position: absolute;
    top:63px;
    left: 0;
    right: 0;
    margin: 0 auto;
    font-size: 14px;
}
.top-side-bar .search-go .hot-search-box li {
    display: inline-block;
    margin-right: 18px;
}
 .top-side-bar .search-go .hot-search-box a {
    color: #fff;
}
	
</style>

<!--搜索器end-->
    <!-- Swiper -->

    <div class="swiper-container swiper-container-horizontal">
        <div class="swiper-wrapper">
            <?php mo_slider('focusslide'); ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-bullets swiper-pagination-bullets-dynamic"></div>
    </div>

	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/swiper.min.js"></script>
	<script type="text/javascript">
	    var swiper = new Swiper('.swiper-container', {
	      autoplay:true,
	      pagination: {
	        el: '.swiper-pagination',
	        dynamicBullets: true,
	      },
	    });
	</script>
</section>
<?php }elseif (is_home() && _hui('home_header_style') =="style_1" ) { ?>
	<div class="focusbox" id="focsbox-true" style="background-image: url(<?php echo _hui('focusslide_serachimg'); ?>)">
    	<div class="focusbox-image-overlay"></div>
    	<div class="container">
    		<h3 class="focusbox-title"><?php echo _hui('focusslide_seracht'); ?></h3>
				<form class="form-inline" id="fh5co-header-subscribe" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
					<div class="form-group">
						<input type="text" class="form-control" id="email" name="s" placeholder="输入要查找关键字">
						<button type="submit" class="btn btn-default">搜索</button>
					</div>
				</form>
    	</div>
    </div>
<?php } ?>


<!-- 幻灯片下面的专题 -->
<?php if ((!$paged || $paged===1) && _hui('home_special')) { ?>

<section class="container-white home1">
	<div class="container">
		<div class="row block-wrapper">
			<?php

			


			?>
			    <?php
			    $go_str=home_url().'/go.php?';
			    
			     for ($i=1; $i <= 4; $i++) { ?>
			    <div class="cms-category">
			    	<div class="category-tile">
			    		<div class="category-tile__wrap">
			    	
	                <div class="background-img" style="background-image:url(<?php 

	                	echo _hui('home_special_img_'.$i);
	                	?>);">
	                </div>
	               <a target="_blank" class="category-tile__inner"  href="<?php  echo $go_str._hui('home_special_cat_'.$i); ?>" >
	                   
	                    
	                    
	               </a> 
			    </div></div></div>
			<?php }?>

		</div>

	</div>
</section>
<?php } ?>
<?php  if(_hui('home_jiaocheng_pic')) { ?>
<div class="jiaocheng-top-blocked" style="background:#f6f6f6;width:100%;height:200px;margin-top: 40px;">
	<section class="container">
		<ul class="jiaocheng-top">
			<?php   for($i=1;$i<10;$i++) {  ?>
			<li>
				<a href="<?php echo  _hui('home_jiaocheng_jump_urled'.$i); ?>" target="_blank" class="" href="" style="background:url(<?php echo _hui('home_jiaocheng_pic_pathed_'.$i);  ?>) center center no-repeat;"><p><?php echo _hui('home_jiaocheng_desed_'.$i); ?></p>
				</a>
				
			</li>
				<?php  } ?>


		</ul>
		
		
	</section>
</div>
<?php }  ?>
<style>
	.jiaocheng-top li{

		display: inline-block;
		width:90px;
		height:90px;
		margin-top: 55px;
		margin-right: 45px;
		border-radius: 6px;

		
	}

	.jiaocheng-top li a{
		display:block;
		width:90px;
		height:90px;
		border-radius: 6px;
		overflow: hidden;
		transition: all 0.6s;
		background-size: 90px 90px;
		
	}
	.jiaocheng-top li a:hover{
		transform: scale(1.2);
	}
	.jiaocheng-top li a p{
		display: none;
	}
.jiaocheng-top li a:hover  p{
		display: block;
		line-height: 140px;
		text-align: center;
		color: #ffffff;
}
	@media (max-width:768px){
 .jiaocheng-top-blocked{
    display: none;
  }
}
@media (max-width:544px){
  .jiaocheng-top-blocked{
    display: none;
  }
}
</style>
<!-- 最新文章 -->
<section class="container">
	<?php if ((!$paged || $paged===1)) { ?>
	<div class="section-info top-select"> 
		<h2 class="postmodettitle  ">最新推荐</h2>
      	<span class="sign-top-select-hot"></span> 
		<!-- <a target="_blank" class="top-select-right"  href="<?php echo home_url('likes'); ?>">最多收藏</a> -->
      <?php $_get_data_=isset($_GET['hot-selected'])?sanitize_text_field($_GET['hot-selected']):null;for($i=1;$i<7;$i++){ ?>
		<a  class="top-select-right <?php if($_get_data_==_hui('hot-selected-field'.$i) && !empty(sanitize_text_field($_GET['hot-selected']))){echo 'top-select-right-on'; } ?>"  href="<?php echo home_url().'?hot-selected='._hui('hot-selected-field'.$i); ?>"><?php echo  _hui('hot-selected-cat-name'.$i); ?></a>
		<?php  } ?>
		
		<div class="postmode-description">关注前沿设计风格，紧跟行业趋势，精选优质好资源！</div> 
		
	</div>
	<?php } ?>

	<?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 0;

		$args = array(
            'ignore_sticky_posts' => 1,
            'paged'               => $paged,
          	'posts_per_page'      => 8,
		);

		if( _hui('notinhome') ){
			$pool = array();
			foreach (_hui('notinhome') as $key => $value) {
				if( $value ) $pool[] = $key;
			}
			$args['cat'] = '-'.implode($pool, ',-');
		}
  		//推荐处的按钮
		if(isset($_GET)&&!empty($_get_data_)){
			echo '<script>
				 $("html,body").animate({scrollTop:"630px"},400);
				 </script>';
			switch($_get_data_){
				
				case _hui('hot-selected-field1'):
				$args['cat'] =_hui('hot-selected-id1');
				break;
				case _hui('hot-selected-field2'):
				$args['cat'] =_hui('hot-selected-id2');
				break;
				case _hui('hot-selected-field3'):
				$args['cat'] =_hui('hot-selected-id3');
				break;
				case _hui('hot-selected-field4'):
				$args['cat'] =_hui('hot-selected-id4');
				break;
				case _hui('hot-selected-field5'):
				$args['cat'] =_hui('hot-selected-id5');
				break;
				case _hui('hot-selected-field6'):
				$args['cat'] =_hui('hot-selected-id6');
				break;
				case _hui('hot-selected-field7'):
				$args['cat'] =_hui('hot-selected-id7');
				break;
				

			}
		}

		query_posts($args);
		
		get_template_part( 'excerpt', 'home-tuijian' );
	?>
</section>

<!-- 最新文章end -->
<!-- 中间的广告 -->
<!-- <?php  get_template_part('index','midadv'); ?> -->
<!-- 分类楼层CMS一 -->
<?php 
if ((!$paged || $paged===1)) { 
	for ($i=1; $i <=_hui('home_cms_cat_count'); $i++){
		  if (_hui('home_cms_'.$i)) {?>
			<section class="container cms ">
				<div class="section-info"> 
					<h2  style="float:left;" class="postmodettitle"><span><?php echo _hui('home_cms_title_'.$i) ?></span>&nbsp;推荐 ></h2> 
					
					
					<div class="postmode-description"><?php echo _hui('home_cms_desc_'.$i) ?></div> 
				</div>
				
				<?php 
				 	$category_id= _hui('home_cms_cat_'.$i);
   					$category_link = get_category_link( $category_id );
					$cms_args = array(
						 'cat'      => $category_id,
						 'ignore_sticky_posts' => 1,
						 'showposts' => _hui('home_cms_num_'.$i)
						 );

					query_posts($cms_args);

					// get_template_part( 'excerpt');
					echo '<div class="excerpts-wrapper"><div class="excerpts">';
				        while ( have_posts() ) : the_post();
				            get_template_part( 'excerpt', 'item' );
				        endwhile; 
				    echo '</div></div>';
				    echo'<div class="pagination"><a class="btn btn-primary" href="'.$category_link.'">查看更多</a></div>';
				    wp_reset_query();
				?>
			</section>
			<script >

					
					$(".block-three-select-right li").each(function(){
						var old_text=$(this).children().text();
						$(this).hover(function(){

							$(this).children().text('进入专辑');
						},function(){

							$(this).children().text(old_text);
						});

					});
				</script>
<?php } } } ?>



<!-- 分类楼层一end -->





<!--漂浮物-->
<div class="vip-ad-float" style="display: block">
	
	<a class="vip-ad-float-a" href="<?php echo home_url('/user?action=vip') ?>"  target="_blank_">
		

	</a>	
<div class="closebtn" > </div>

</div>
<!--漂浮物end-->

<!--漂浮大广告-->
<div class="adv-footer-float"  >
	
	<a  href="<?php echo home_url(); ?>/user?action=vip"  target="_blank_">
	<img src="<?php echo get_template_directory_uri() . '/img/index-adv.png';?>" alt="" />   	

	</a>	
<div class="adv-footer-closebtn" > </div>

</div>
<!--漂浮大广告end-->

<script   src="<?php  echo  get_template_directory_uri(); ?>/js/cookie/jquery.cookie.js">
	
</script>
<!-- 关闭漂浮物 -->
<script>
	$(function(){

	var closebtn=$('.closebtn');
	var piaofuwu=$('.vip-ad-float');

	closebtn.click(function(){

		piaofuwu.css('display','none');
});	

	//刷新后显示
	if(window.name){
	piaofuwu.css('display','');
	}


//漂浮大广告
//设置cookie


//关闭按钮后

$('.adv-footer-closebtn').click(function(){
	$.cookie('close_adv_float','closed',{expires:1/24*6,path:'/',});
	$('.adv-footer-float').css('display','none');

		
});//click
console.log($.cookie('close_adv_float'));
if($.cookie('close_adv_float')=='closed'){
	$('.adv-footer-float').css('display','none');	
}else{

	$('.adv-footer-float').css('display','');
}




	//关闭时候css动画
/*$(this).addClass('animated bounce');
	setTimeout(function(){
        $('#dowebok').removeClass('bounce');
    }, 1000);*/


});


  /////////////////////新增
  $(".excerpt").each(function(){

	$(this).hover(function(){

    $(this).find(".heise-zhezhao-down").css("display","block");
		},function(){
			$(this).find(".heise-zhezhao-down").css("display","none");});});




</script>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?511baf6dfe3d9f0998fa71b256932b96";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>


<?php get_footer(); ?>