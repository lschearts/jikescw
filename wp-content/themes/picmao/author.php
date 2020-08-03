<?php get_header(); ?>
<div style="margin-top:50px;"></div>
<?php _the_focusbox( '', '作品', get_the_author_meta('user_description') ); ?>

<section class="container">
	<?php get_template_part( 'excerpt' ); ?>
</section>

<?php get_footer(); ?>
<script type="text/javascript">
	
	  /////////////////////新增遮盖
  $(".excerpt").each(function(){

	$(this).hover(function(){

    $(this).find(".heise-zhezhao-down").css("display","block");
		},function(){
			$(this).find(".heise-zhezhao-down").css("display","none");});});

</script>