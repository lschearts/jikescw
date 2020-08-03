<?php
//session_start();
get_header();
/*if(isset($_GET['s'])) {
	
   	$_SESSION['search_keyed']=$_GET['s'];
}

if(isset($_SESSION['search_keyed'])){

	$key_worded=$_SESSION['search_keyed']==''?'全部':$_SESSION['search_keyed'];
	echo '<p style="margin:30px auto 10px;width:1200px;">当前搜索：<strong>'.$key_worded.'</strong>的结果</p>';
}*/

?>

<!-- <?php _the_focusbox( '', single_cat_title('', false) ); ?> -->


<section class="container">
	
	<?php if (_hui('is_filters_cat') == 1) { ?>
		<div class="filters">
			<?php if (_hui('filters_cat_is')) { ?>
				<?php category_breadcrumbs();?>
			<div class="filter-item">
			 	<span>&nbsp;&nbsp;分&nbsp;&nbsp;&nbsp;类&nbsp;&nbsp;</span>
			 	<ul class="filter-catnav">
				<?php

				$variable = wp_list_categories( array(
				    'echo' => false,
				    'show_count' => false,
				    'title_li' => '',
				    'hide_empty'           => 0,
				    'child_of'            =>get_current_category_id(),
				    'depth'=>1,
				) );
				echo $variable;
				?>
				</ul>
			</div>
			<?php } ?>
			<script type="text/javascript">
				if($('.cat-item-none').text()=='没有分类目录'){
					$('.filter-item').first().css('display','none');		
				}
			
					
				
			</script>
			

				<?php 
				$is_cat_= single_cat_title('', false);
					
					$_is_top_cate_id_=category_top_parent_id(get_cat_ID($is_cat_));//当前分类的顶级分类 
				if (_hui('is_filters_tag_is')) { 
					$category = get_the_category();
					$cate_id= $category[0]->cat_ID;
					$top_cate_id=category_top_parent_id($cate_id);//当前分类的顶级分类
					
				//如果顶级分类是素材的id	
				for ($i=1; $i<4;$i++) {
					
				if($_is_top_cate_id_==_hui('designates_cate_'.$i)){ 
					
				?> 
				<?php //if(_hui('is_cate_img'.$i)){ ?>
				<div class="filter-item">
			 	<span>&nbsp;&nbsp;格&nbsp;&nbsp;&nbsp;式&nbsp;&nbsp;</span>
				<a href="<?php echo add_query_arg("infodtype",'all')?>" class="<?php if(_get('infodtype') == 'all') echo 'on';?>">全部</a>
				<?php 
					$cat_type=_hui('cate_type_'.$i);
					$cat_types=explode('-',$cat_type);
					$count_cat=is_array($cat_types)?count($cat_types):null;
					if($count_cat){
					for ($i=0; $i<$count_cat ; $i++) { 
				?>

				<a href="<?php echo add_query_arg("infodtype",$cat_types[$i]); ?>" class="<?php if(_get('infodtype') ==$cat_types[$i] ) echo 'on';?>"><?php echo $cat_types[$i]; ?>
					
				</a> 
				<?php  }}?>
			</div>
          		<?php  //} ?>
          			<!-- 颜色 -->
				
				<div class="filter-item colorworded-selected-info">
			 	<span>&nbsp;&nbsp;色&nbsp;&nbsp;&nbsp;系&nbsp;&nbsp;</span>
				<a href="<?php echo add_query_arg("colorworded",'all')?>" style="width:30px;line-height:30px;">全部</a>
				<a href="<?php echo add_query_arg("colorworded",'hong')?>" class="<?php if(_get('colorworded') == 'hong') echo 'colorworded-selected-on';?>" style="background:#CF0000;" title="红色"></a>
				<a href="<?php echo add_query_arg("colorworded",'cheng')?>" class="<?php if(_get('colorworded') == 'cheng') echo 'colorworded-selected-on';?>" style="background:#F58F00;" title="橙色"></a>
				<a href="<?php echo add_query_arg("colorworded",'huang')?>" class="<?php if(_get('colorworded') == 'huang') echo 'colorworded-selected-on';?>" style="background:#F2E200;" title="黄色"></a>
				<a href="<?php echo add_query_arg("colorworded",'lv')?>" class="<?php if(_get('colorworded') == 'lv') echo 'colorworded-selected-on';?>" style="background:#58CA00;" title="绿色"></a>
				
				<a href="<?php echo add_query_arg("colorworded",'lan')?>" class="<?php if(_get('colorworded') == 'lan') echo 'colorworded-selected-on';?>" style="background:#4496EE;" title="蓝色"></a>
				
				<a href="<?php echo add_query_arg("colorworded",'zi')?>" class="<?php if(_get('colorworded') == 'zi') echo 'colorworded-selected-on';?>" style="background:#6E2CDF;" title="紫色"></a>
				
				<a href="<?php echo add_query_arg("colorworded",'zihong')?>" class="<?php if(_get('colorworded') == 'zihong') echo 'colorworded-selected-on';?>" style="background:#D51AD3;" title="紫红色"></a>
				
				<a href="<?php echo add_query_arg("colorworded",'zhong')?>" class="<?php if(_get('colorworded') == 'zhong') echo 'colorworded-selected-on';?>" style="background:#8D5412;" title="棕色"></a>
				
				<a href="<?php echo add_query_arg("colorworded",'hei')?>" class="<?php if(_get('colorworded') == 'hei') echo 'colorworded-selected-on';?>" style="background:#000000;" title="黑色"></a>
				
				<a href="<?php echo add_query_arg("colorworded",'hui')?>" class="<?php if(_get('colorworded') == 'hui') echo 'colorworded-selected-on';?>" style="background:#989898;" title="灰色"></a>
				
				<a href="<?php echo add_query_arg("colorworded",'bai')?>" style="background:#f5f3f3;" class="<?php if(_get('colorworded') == 'bai') echo 'colorworded-selected-on';?>"  title="白色"></a>
				

			</div>
	
				




			<div class="filter-item filter-item-signd">
			 	<span>推荐标签</span>
				<?php
					$this_cat_arg = array( 'categories' => $cat);
					$tags = _get_category_tags($this_cat_arg);
					$content = '<ul class="filter-tag">';
					if(!empty($tags)) {
					  foreach ($tags as $tag) {
					    $content .= '<li><a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a></li>';
					  }
					}else{$content .= '<li>暂无相关标签</li>';}
					$content .= "</ul>";
					echo $content;
				?>
			</div>
			
			<script type="text/javascript">
				if($('.filter-item-signd ul').text()=='暂无相关标签'){
					$('.filter-item-signd').css('display','none');		
				}
			
			</script> <?php } ?><?php  }
		
		  ?>
         
          			<!--  <div class="filter-item">
          				<span>资源类型</span>
          			          				<a href="<?php echo add_query_arg("price","all")?>" class="<?php if(_get('price') == 'all') echo 'on';?>">全部</a>
          			          				<a href="<?php echo add_query_arg("price","1")?>" class="<?php if(_get('price') == '1') echo 'on';?>">付费全文</a>
          			              <a href="<?php echo add_query_arg("price","2")?>" class="<?php if(_get('price') == '2') echo 'on';?>">VIP教程</a>
          			          				<a href="<?php echo add_query_arg("price","2")?>" class="<?php if(_get('price') == '2') echo 'on';?>">付费隐藏内容</a>
          			          				<a href="<?php echo add_query_arg("price","3")?>" class="<?php if(_get('price') == '3') echo 'on';?>">付费下载</a>
          			               
          			</div>  -->
          			 
			 


			 <div class="filter-item">
			 	<span>会员权限</span>
			 	<a href="<?php echo add_query_arg("vip","all")?>" class="<?php if(_get('vip') == 'all') echo 'on';?>">全部</a>
				<a href="<?php echo add_query_arg("vip","1")?>" class="<?php if(_get('vip') == '1') echo 'on';?>">月费会员</a>
				<a href="<?php echo add_query_arg("vip","2")?>" class="<?php if(_get('vip') == '2') echo 'on';?>">年费会员</a>
				<a href="<?php echo add_query_arg("vip","3")?>" class="<?php if(_get('vip') == '3') echo 'on';?>">终身会员</a>
				<a href="<?php echo add_query_arg("vip","0")?>" class="<?php if(_get('vip') == '0') echo 'on';?>">免费</a>
			 </div>
			<?php // } 
			?>
			 <!-- 排序 -->
 			<div class="filter-item">
 					 	<span>&nbsp;&nbsp;排&nbsp;&nbsp;&nbsp;序&nbsp;&nbsp;</span>
 					 	<a href="<?php echo add_query_arg("ordered","defaulted")?>" class="<?php if(_get('ordered') == 'defaultes') echo 'on';?>">默认</a>
 						<a href="<?php echo add_query_arg("ordered","1")?>" class="<?php if(_get('ordered') == '1') echo 'on';?>">最新上传</a>
 						<!--<a href="<?php echo add_query_arg("ordered","2")?>" class="<?php if(_get('ordered') == '2') echo 'on';?>">收藏最多</a>-->
 						
 						<a href="<?php echo add_query_arg("ordered","3")?>" class="<?php if(_get('ordered') == '3') echo 'on';?>">下载最多</a>
 						<a href="<?php echo add_query_arg("ordered","4")?>" class="<?php if(_get('ordered') == '4') echo 'on';?>">浏览最多</a>
 					
 					 </div> 
		</div>
		
		<?php }  ?>

		<?php 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	 		$metaArray = array(); //自定义字段数组
	 		if(isset($_GET['price'])){
			 	if($_GET['price'] == 'all'){
				 	// array_push($metaArray,array('key' => 'wppay_type', 'value'=>'0', 'compare'=>'>'));
				 }elseif ($_GET['price'] == '1') {
				 	array_push($metaArray,array('key' => 'wppay_type', 'value'=>'1', 'compare'=>'='));
				 }elseif ($_GET['price'] == '2') {
				 	array_push($metaArray,array('key' => 'wppay_type', 'value'=>'2', 'compare'=>'='));
				 }elseif ($_GET['price'] == '3') {
				 	array_push($metaArray,array('key' => 'wppay_type', 'value'=>'3', 'compare'=>'='));
				 }
			 }
			 if(isset($_GET['vip'])){
			 	if($_GET['vip'] == '1'){
				 	array_push($metaArray,array('key' => 'wppay_vip_auth', 'value'=>'1', 'compare'=>'='));
				 }elseif ($_GET['vip'] == '2') {
				 	array_push($metaArray,array('key' => 'wppay_vip_auth', 'value'=>'2', 'compare'=>'<='));
				 }elseif ($_GET['vip'] == '3') {
				 	array_push($metaArray,array('key' => 'wppay_vip_auth', 'value'=>'3', 'compare'=>'<='));
				 }elseif ($_GET['vip'] == '0') {
				 	array_push($metaArray,array('key' => 'wppay_type', 'value'=>'4', 'compare'=>'='));
				 }
			 }

			 //根据格式选择
			 if(isset($_GET['infodtype'])){
			 	if($_GET['infodtype'] == 'all'){
				 	//array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'1', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'PSD') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'PSD', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'AI') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'AI', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'CDR') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'CDR', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'EPS') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'EPS', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'PNG') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'PNG', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'JPG') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'JPG', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'MAX') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'MAX', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'DWG') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'DWG', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'C4D') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'C4D', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'SKP') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'SKP', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'AEP') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'AEP', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'PPTX') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'PPTX', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'DOCX') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'DOCX', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'XLS') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'XLS', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'MP4') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'MP4', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'MOV') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'MOV', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'AVI') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'AVI', 'compare'=>'='));
				 }elseif ($_GET['infodtype'] == 'WMF') {
				 	array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'WMF', 'compare'=>'='));
				 }
			 }
                                            
                                            
                                             //根据色系选择
				if(isset($_GET['colorworded'])){
			 	if($_GET['colorworded'] == 'all'){
				 	//array_push($metaArray,array('key' => 'wppay_info_g', 'value'=>'1', 'compare'=>'='));
				 }elseif ($_GET['colorworded'] == 'hong') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'1', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'cheng') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'2', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'huang') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'3', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'lv') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'4', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'lan') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'5', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'zi') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'6', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'zihong') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'7', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'zhong') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'8', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'hei') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'9', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'hui') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'11', 'compare'=>'='));

				 }elseif ($_GET['colorworded'] == 'bai') {

				 	array_push($metaArray,array('key' => 'wppay_demourl', 'value'=>'12', 'compare'=>'='));

				 }
				}
				
				
				/*根据排序*/
				$ordered='date';
				$_meta_key='';

				if(isset($_GET['ordered'])){

					if($_GET['ordered']=='defaulted'){
						
					
					}elseif($_GET['ordered']=='1'){
						
						
					}elseif($_GET['ordered']=='2'){
						$_meta_key='postshouceddd';
						$ordered=array('meta_value_num' => 'DESC');//收藏
						
					}
					elseif($_GET['ordered']=='3'){
						$_meta_key='post_download_count';
						$ordered=array('meta_value_num' => 'DESC');//下载
						
					}elseif($_GET['ordered']=='4'){
						
						$_meta_key='views';
						$ordered=array('meta_value_num' => 'DESC');//浏览
					}
					

				}



$args = array(
			 'meta_key' => $_meta_key, 
				'orderby' => $ordered,
				'order'   => 'DESC',
			 'cat'      => $cat,
			 'ignore_sticky_posts' => 1,
			 'meta_query' => $metaArray,
			 'paged' => $paged,
  			'posts_per_page'=>22
  			
			 );
			query_posts($args);
		} 
	get_template_part( 'excerpt' );






			
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