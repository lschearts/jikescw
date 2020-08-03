
<script>/*百度推送代码*/
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<script>/*360推送代码*/
(function(){
var src = "https://jspassport.ssl.qhimg.com/11.0.1.js?d182b3f28525f2db83acfaaf6e696dba";
document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
</script>

<?php 

/*require( ABSPATH.'/wp-load.php' );
global $wpdb;
$wpdb->query();*/
while (have_posts()) : the_post(); ?>


<section class="container">
    <div class="content-wrap">
    	<div class="content">
    		
            <?php _the_ads('ad_post_header', 'single-header') ?>

    		<article class="article-content">

                

             <header class="article-header">
        <h1 class="article-title">
        <?php the_title(); ?>
        </h1>
        <div class="article-meta">
            <span class="item item-3"><?php content_breadcrumbs(); ?></span>
            <span class="item item-1"><?php echo Bing_filter_time().'发布'/*get_the_date().' '.get_the_time();*/ ?></span>
            <?php if( _hui('post_from_s') ){ ?>
                <span class="item item-6"><?php echo _get_post_from() ?></span>
            <?php } ?>
            <!-- <span class="item item-2">作者：<?php echo get_the_author() ?></span> -->
           
            
            <?php if( _hui('post_post_views') ){ ?>
                <span class="item item-4"><i class="iconfont"></i><?php echo _get_post_views() ?></span>
            <?php } ?>
            <span class="item item-5"><?php edit_post_link('[编辑]'); ?></span>
        </div>
    </header>






           
        		<?php the_content(); ?>
                   
            
            
            
                <?php wp_link_pages('link_before=<span>&link_after=</span>&before=<div class="article-paging">&after=</div>&next_or_number=number'); ?>

                <?php if( _hui('post_copyright_s') ){
                    echo '<div class="article-copyright">'._hui('post_copyright').'</div>';
                } ?>

                <?php endwhile;  ?>
                
                <?php if( _hui('post_tags_s') ){ ?>
                    <?php the_tags('<div class="article-tags">','','</div>'); ?>
                <?php } ?>
               
               <?php get_template_part( 'module/content', 'module-wechats' ); ?> 
                  <?php get_template_part( 'module/content', 'module-rewards' ); ?> 
                <?php get_template_part( 'module/content', 'module-share' ); ?> 

            </article>
                
                <!--阅读全文按钮-->
                <?php        

                    if(!is_user_logged_in()) {
                        get_template_part( 'content','readmore' );
                    }
                  


                ?>

                     
            
            
            <?php if( _hui('post_prevnext_s') ){ ?>
                <nav class="article-nav">
                    <span class="article-nav-prev"><?php previous_post_link('上一篇<br>%link'); ?></span>
                    <span class="article-nav-next"><?php next_post_link('下一篇<br>%link'); ?></span>
                </nav>
            <?php } ?>
            
            <?php _the_ads('ad_post_footer', 'single-footer') ?>
            
            <?php if( _hui('post_related_s') ){ ?>
                <div class="postitems">
                    <h3><?php echo _hui('related_title', '相关推荐') ?></h3>
                    <ul>
                        <?php _posts_related( _hui('post_related_n') ) ?>
                    </ul>
                </div>
            <?php } ?>

            <?php _the_ads('ad_post_comment', 'single-comment') ?>
            <?php 
  
  				 	$category = get_the_category();
                    $cate_id= $category[0]->cat_ID;
                    $top_cate_id=category_top_parent_id($cate_id);//当前分类的顶级分类
                    if(!in_array($top_cate_id,array(3,4))){
  					comments_template('', true);
          
                    }
          
          ?>
            
    	</div>
    </div>
	<?php get_sidebar(); ?>
</section>
<script >
           
                $('iframe').css({'width':'820px','height':'440px'});
                $('.article-focusbox').append($('iframe'));
          
        </script> 