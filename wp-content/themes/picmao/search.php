<?php get_header();
$res_search=htmlspecialchars($s);
$res_search=!empty($res_search)?$res_search:'全部';
 ?>




<section class="container" style="top:50px;">
	
	<p style="font-size: 16px;color:#555;"><?php  echo '当前是&nbsp;<span style="color:#ff5000;">'.$res_search.'&nbsp;</span>的搜索结果'; ?></p>
	<?php
		$categories=top_cat_();
	 if($categories){
	if ( !have_posts() ) : ?>
		<?php 

			$empty_html='

				<div style="margin:0 auto  100px;width:315px;text-align:center;">
				<img style="margin-top:150px;height:222px;" src="'.get_template_directory_uri().'/img/empty-box.png">
				<h3>当前分类没有相关内容</h3>
				</div>



				';
				echo $empty_html ;

		 ?>

		
	<?php else: ?>

		<?php 

		
		get_template_part( 'category','search' );
		
		 get_template_part( 'excerpt' ); 
		




		  ?> 
	<?php endif;

	}else{

					exit('<i style="color:red;">error:分类不能为空</i>');
				}

	 ?>

</section>

<?php get_footer(); ?>
<script>
  /////////////////////新增
  $(".excerpt").each(function(){

	$(this).hover(function(){

    $(this).find(".heise-zhezhao-down").css("display","block");
		},function(){
			$(this).find(".heise-zhezhao-down").css("display","none");});});

  
  
  </script>
