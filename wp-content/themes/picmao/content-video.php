
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


<?php while (have_posts()) : the_post(); ?>
<section class="article-focusbox" style="background-image: url(<?php echo _get_post_thumbnail_url() ?>);">
    
</section>

<section class="container">
<div class="content-wrap">
        <div class="content">
            
	<article class="article-content">

        <header class="article-header">
        <h1 class="article-title"><?php the_title(); ?></h1>
        <div class="article-meta">
            <span class="item item-3"><?php content_breadcrumbs(); ?></span>
            <span class="item item-1"><?php echo get_the_date().' '.get_the_time(); ?></span>
            <?php if( _hui('post_from_s') ){ ?>
                <span class="item item-6"><?php echo _get_post_from() ?></span>
            <?php } ?>
           
           
            <?php if( _hui('post_post_views') ){ ?>
                <span class="item item-4"><i class="iconfont"></i><?php echo _get_post_views() ?></span>
            <?php } ?>
            <span class="item item-5"><?php edit_post_link('[编辑]'); ?></span>
        </div>
    </header>
        <?php the_content(); ?>
		
       <?php wp_link_pages('link_before=<span>&link_after=</span>&before=<div class="article-paging">&after=</div>&next_or_number=number'); ?>

		<?php endwhile; ?>
	    
	    <?php get_template_part( 'module/content', 'module-share' ); ?> 
	</article>
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


        
            
       
