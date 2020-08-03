<?php 

_the_ads('ad_list_header', 'list-header');

//_the_leadpager(); 

?>


<?php
if ($data_query->have_posts()):

    echo '<div class="excerpts-wrapper">';
	    echo '<div class="excerpts">';

	        while ($data_query->have_posts() ) :$data_query->the_post();
	            /*样式格子*/




	            $p_meta = _hui('post_plugin');
				$price = get_post_meta($post->ID,'wppay_price',true);
				$vip = get_post_meta($post->ID,'wppay_vip_auth',true);
				$cols = _hui('list_cols', 5);
				if( _hui('list_imagetext') ){
				    $cols .= ' excerpt-combine';
				}

				if( _hui('list_hover_plugin') ){
				    $cols .= ' excerpt-hoverplugin';
				}

				$p_like = _get_post_like_data(get_the_ID());


				echo '<article class="excerpt excerpt-c'.$cols.'">';
				    if($price!=0&&$vip==0){
				    echo '<a'. _target_blank() .' class="vipsign"  href="'.home_url('/user?action=vip').'"  title="VIP免费"><p>免费</p></a>';}
				    echo '<a'. _target_blank() .' class="thumbnail" href="'.get_permalink().'">'._get_post_thumbnail().'</a>';
				    
				    echo '<h2><a'. _target_blank() .' href="'.get_permalink().'">'.get_the_title().'</a></h2>';

				    echo '<footer>';
				        if( $vip && $vip != 0 ){
				            echo '<span class="post-price"><i class="iconfont">&#xe63f;</i></span>';
				        }
				        if( $price && $price != 0 ){
				            echo '<span class="post-price"><i class="iconfont">&#xe628;</i> '.$price.'</span>';
				        }

				        if( isset($is_hotposts) ){
				            echo '<time class="hot"><i class="iconfont">&#xe6f5;</i></time>';
				        }else{
				            echo '<time>'._get_post_time().'</time>';
				        }

				        if( $p_meta && $p_meta['view'] ){
				            echo '<span class="post-view"><i class="iconfont">&#xe611;</i> '._get_post_views().'</span>';
				        }

				        if( $p_meta && $p_meta['comm'] ){
				            echo '<span class="post-comm">'._get_post_comments().'</span>';
				        }

				    echo '</footer>';
				    
				echo '</article>';






	            /*样式格子end*/
	        endwhile; 

	        

	    echo '</div>';
    echo '</div>';
    _paging();
    //重置请求数据
wp_reset_postdata();
    //wp_reset_query();
else:

     get_template_part( 'excerpt', 'none' );

endif; 

_the_ads('ad_list_footer', 'list-footer');
