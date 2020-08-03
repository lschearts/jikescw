<style type="text/css">
 .excerpts-right-next-paged{
    width:48%;height:329px;background:red;display:inline-block;border-radius: 8px;margin-top: 10px;

    }

.excerpts-right-next-paged  .rightblock-next-page{

font-size:39px;display:block;width:100%;height:100%;background:url(http://img-bg.sjoneone.com/backgprundimge600.jpg)  center center ;overflow:hidden;text-align:center;line-height:329px;cursor: pointer;border-radius: 8px;
}
.excerpts-right-next-paged  .rightblock-next-page  a{
	display: block;
	width:100%;
	height: 100%;
    color:rgb(255,255,255);

}

@media(max-width: 544px){

    .excerpts-right-next-paged{
        display: none;
    }
}

@media(max-width: 768px){

    .excerpts-right-next-paged{
        display: none;
    }
}
</style>
<?php 

_the_ads('ad_list_header', 'list-header');

//_the_leadpager(); 

?>


<?php
if ( have_posts() ):

    echo '<div class="excerpts-wrapper">';
	    echo '<div class="excerpts">';

	        while ( have_posts() ) : the_post();
	            get_template_part( 'excerpt', 'item' );
	        endwhile; 

	       //增加下一页更精彩
		echo '<div class="excerpts-right-next-paged" >';
		echo '<li class="rightblock-next-page" >'; next_posts_link(__('下一页更精彩 >', 'haoui')); echo '</li>';
		echo  '</div>';
	 

	    echo '</div>';
    echo '</div>';
    _paging();
    wp_reset_query();
else:

     get_template_part( 'excerpt', 'none' );

endif; 

_the_ads('ad_list_footer', 'list-footer');
?>
<script type="text/javascript">
	var li_nexted=$('.excerpts-right-next-paged  .rightblock-next-page');
	var li_nexted_all=$('.excerpts-right-next-paged');
	if(li_nexted.text()==''  ){
	
		li_nexted_all.css('display','none');

	}
</script>
