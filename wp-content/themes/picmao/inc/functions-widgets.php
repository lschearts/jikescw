<?php 


function unregister_d_widget(){
    unregister_widget('WP_Widget_Recent_Comments');
}
add_action('widgets_init','unregister_d_widget');



$widgets = array( 'download','asst', 'comments', 'postlist', 'textasst','author','collect');

function widget_ui_loader() {
	global $widgets;
	foreach ($widgets as $widget) {
		register_widget( 'widget_'.$widget );
	}
}
add_action( 'widgets_init', 'widget_ui_loader' );



class widget_download extends WP_Widget {

	function __construct(){
		parent::__construct( 'widget_download', 'Picmore: 资源下载信息', array( 'classname' => 'widget-download' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		global $post;
		$post_number=1800000000+intval(get_the_ID());
		$type = get_post_meta($post->ID,'wppay_type',true);
		$price = (get_post_meta($post->ID,'wppay_price',true)) ? get_post_meta($post->ID,'wppay_price',true) : 0 ;
		if($price==0){$price="免费";}else{
			$price=intval($price)."元";
		}
		$down = get_post_meta($post->ID,'wppay_down',true);
		$info = get_post_meta($post->ID,'wppay_down_info',true);
		$post_auth = get_post_meta($post->ID,'wppay_vip_auth',true);
		
		if($type >= 3){
			$user_id = is_user_logged_in() ? wp_get_current_user()->ID : 0;
			$wppay = new WPAY($post->ID, $user_id);
			// 检测当前用户是否已购买
			
			if($wppay->is_paid()  ){
			$content_pay='<a href="javascript:;" target="_blank" id="download-popup" data-url="'.home_url().'/gohref?'._sjone_code('url='.$down.'&ppid='.$post->ID.'&uuid='.$user_id,'ENCODE').'" data-info="'.$info.'" data-downtime="0"  class="btn btn-primary download-popup-time"><i class="iconfont">&#xe69d;</i> 立即下载</a>';
				
			}
			else if($type==4){
				if(!is_user_logged_in()){
					$content_pay='<a href="'.home_url('login').'" class="btn btn-primary"><i class="iconfont">&#xe66b;</i> 登录下载</a>';
				}else{
					$content_pay='<a href="javascript:;" target="_blank" id="download-popup" data-url="'.home_url().'/gohref?'._sjone_code('url='.$down.'&ppid='.$post->ID.'&uuid='.$user_id,'ENCODE').'" data-info="'.$info.'" data-downtime="0"  class="btn btn-primary download-popup-time"><i class="iconfont">&#xe69d;</i> 立即下载</a>';
				}

			}else{
				
				if (_hui('no_loginpay') == 0 && !is_user_logged_in()) {
					$content_pay='<a href="'.home_url('login').'" class="btn btn-primary"><i class="iconfont">&#xe66b;</i> 登录购买</a>';

				}else{
					$content_pay='<a href="javascript:;" id="pay-loader" data-post="'.$post->ID.'" class="btn btn-primary"><i class="iconfont">&#xe762;</i> 立即购买</a>';
				}
			}
			/*if (intval($post_auth) == 1) {
	        	$vip_infotext= 'VIP会员免费';
	        }elseif (intval($post_auth) == 2) {
	        	$vip_infotext= 'VIP会员免费';
	        }elseif (intval($post_auth) == 3) {
	        	$vip_infotext= 'VIP会员免费';
	        }elseif ($type == 4) {
	        	$vip_infotext= '';
	        }else{
	        	$vip_infotext= '';
	        }
            */
          	if (intval($post_auth) == 1 && $type!=4) {
	        	$vip_infotext= 'VIP会员免费';
	        }elseif (intval($post_auth) == 2 && $type!=4) {
	        	$vip_infotext= 'VIP会员免费';
	        }elseif (intval($post_auth) == 3 && $type!=4) {
	        	$vip_infotext= 'VIP会员免费';
	        }elseif ($type == 4) {
	        	$vip_infotext= '';
	        }else{
	        	$vip_infotext= '';
	        }
	        $infoArr = array('wppay_demourl' => get_post_meta($post->ID,'wppay_demourl',true), 'wppay_info_v' => get_post_meta($post->ID,'wppay_info_v',true),'wppay_info_g' =>get_post_meta($post->ID,'wppay_info_g',true) ,'wppay_info_d' =>get_post_meta($post->ID,'wppay_info_d',true));
	        if($infoArr['wppay_demourl']){
	        	//$wppay_demourl= '<a href="'.$infoArr['wppay_demourl'].'" target="_blank" id="post-demo" class="btn btn-default"><i class="iconfont">&#xe63e;</i> 演示地址</a>';
              $wppay_demourl='';
	        }else{
	        	$wppay_demourl='';
	        }

	        if($infoArr['wppay_info_v']){
	        	$wppay_info_v= '<tr> <td> <font>当前软件及版本：</font></td> <td> <font>'.$infoArr['wppay_info_v'].'</font></td> </tr>';
	        }else{
	        	$wppay_info_v='';
	        }

	        if($infoArr['wppay_info_g']){
	        	$wppay_info_g= '<tr> <td> <font>文件格式：</font></td> <td> <font>'.$infoArr['wppay_info_g'].'</font></td> </tr>';
	        }else{
	        	$wppay_info_g='';
	        }

	        if($infoArr['wppay_info_d']){
	        	$wppay_info_d= '<tr> <td> <font>文件大小：</font></td> <td> <font>'.$infoArr['wppay_info_d'].'</font></td> </tr>';
	        }else{
	        	$wppay_info_d='';
	        }

			$content = '<div class="down-info">
						<div class="price">
							<font>'.$price.'</font>
							
						</div>
							<p class="vipinfo">'.$vip_infotext.'</p>'.$content_pay.$wppay_demourl.'


							


							<table>
								<tbody>
								<tr>
								<td>
								<font>更新时间：</font>
								</td>

								<td>
								<font>'.get_the_modified_time('Y-m-d').'</font>
								</td>



								</tr>
								<tr>
								<td>
								<font>编号：</font>
								</td>

								<td>
								<font>'.$post_number.'</font>
								</td>
								
								
								
								</tr>

								'.$wppay_info_v.$wppay_info_g.$wppay_info_d.'</tbody>
								</table>
								<a class="ac_qqhao"  style="color:#8B8B8C;font-size:15px;"  target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='._hui('ac_qqhao').'&site=qq&menu=yes"><i class="iconfont2" style="font-size:12pt;color:#8B8B8C;display:inline-block;">&#xeb99;</i> 咨询报错</a>
				</div>';
				
			echo $before_widget;
			echo $content;
			echo $after_widget;
		}

	}
	
}




class widget_asst extends WP_Widget {

	function __construct(){
		parent::__construct( 'widget_asst', 'Picmore: 广告', array( 'classname' => 'widget-asst' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$code = $instance['code'];
		$nophone = isset($instance['nophone']) ? $instance['nophone'] : '';

		if( $nophone && wp_is_mobile() ){
			
		}else{
			echo $before_widget;
			echo $code;
			echo $after_widget;
		}
	}

	function form($instance) {
		$defaults = array( 
			'title' => __('广告', 'haoui').' '.date('m-d'), 
			'code' => '<a href="go.php?https://bufu.taobao.com/category.htm?spm=a1z10.1-c-s.w5001-18229804102.5.55cd23fckJ8tu0&search=y&scene=taobao_shop" target="_blank"><img src="http://up-picd.sjoneone.com/360.jpg"></a>',
			'nophone' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label>
				<?php echo __('标题：', 'haoui') ?>
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('广告代码：', 'haoui') ?>
				<textarea id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php echo $instance['code']; ?></textarea>
			</label>
		</p>
		<p>
			<label>
				<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked( $instance['nophone'], 'on' ); ?> id="<?php echo $this->get_field_id('nophone'); ?>" name="<?php echo $this->get_field_name('nophone'); ?>">不在手机端显示
			</label>
		</p>
	<?php
	}
}













class widget_comments extends WP_Widget {
	
	function __construct(){
		parent::__construct( 'widget_comments', 'Picmore: 最新评论', array( 'classname' => 'widget-comments' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$limit = $instance['limit'];
		$outer = $instance['outer'];

		if( !$outer ){
			$outer = -1;
		}

		echo $before_widget;
		echo $before_title.$title.$after_title; 

		$output = '';

		global $wpdb;
		$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,60) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE user_id!='".$outer."' AND comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date DESC LIMIT $limit";
		$comments = $wpdb->get_results($sql);

		foreach ( $comments as $comment ) {
			$output .= '<li><a'._target_blank().' href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="'.$comment->post_title.__('上的评论', 'haoui').'">';
			$output .= _get_user_avatar($comment->comment_author_email);
			$output .= '<div class="inner"><time><strong>'.strip_tags($comment->comment_author).'</strong>'.( $comment->comment_date ).'</time>'.str_replace(' src=', ' data-src=', convert_smilies(strip_tags($comment->com_excerpt))).'</div>';
			$output .= '</a></li>';
		}

		echo '<ul>'. $output .'</ul>';
		echo $after_widget;
	}

	function form($instance) {
		$defaults = array( 'title' => __('最新评论', 'haoui'), 'limit' => 8, 'outer' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label>
				<?php echo __('标题：', 'haoui') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('显示数目：', 'haoui') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('排除某用户ID：', 'haoui') ?>
				<input class="widefat" id="<?php echo $this->get_field_id('outer'); ?>" name="<?php echo $this->get_field_name('outer'); ?>" type="number" value="<?php echo $instance['outer']; ?>" />
			</label>
		</p>

	<?php
	}
}












class widget_postlist extends WP_Widget {
	
	function __construct(){
		parent::__construct( 'widget_postlist', 'Picmore: 文章展示', array( 'classname' => 'widget-postlist' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );
		/*新加*/
		$category = get_the_category();
		$cate_id= $category[0]->cat_ID;
		$top_cate_id=category_top_parent_id($cate_id);//当前分类的顶级分类

		/*新加*/
		$title        = apply_filters('widget_name', $instance['title']);
		$limit        = $instance['limit'];
		$cat          = isset($instance['cat']) ? $instance['cat'] : '';
		$orderby      = $instance['orderby'];
		// $showstyle      = $instance['showstyle'];
		// $img = $instance['img'];

		// $style = ' class="'.$showstyle.'"';
		echo $before_widget;
		echo $before_title.$title.$after_title; 
		echo '<ul>';

		$args = array(
			'order'            => 'DESC',
			'cat'              => $top_cate_id,
			'orderby'          => $orderby,
			'showposts'        => $limit,
			'ignore_sticky_posts' => 1
		);
		query_posts($args);
		while (have_posts()) : the_post(); 
			echo '<li><a class="thumbnail" '. _target_blank() .' href="'. get_the_permalink() .'">';
			/*if( $showstyle!=='items-03' ){
			}*/
			echo ''._get_post_thumbnail().'</a>';
			echo '<a'. _target_blank() .' href="'. get_the_permalink() .'">'. get_the_title() .'</a>';
			echo '</li>';
			
		endwhile; wp_reset_query();

		echo '</ul>';
		echo $after_widget;

	}

	function form( $instance ) {
		$defaults = array( 
			'title' => '最新文章', 
			'limit' => 6, 
			'orderby' => 'date',
			// 'showstyle' => '' 
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label>
				<?php echo __('标题：', 'haoui') ?>
				<input style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('排序：', 'haoui') ?>
				<select style="width:100%;" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" style="width:100%;">
					<option value="comment_count" <?php selected('comment_count', $instance['orderby']); ?>><?php echo __('评论数', 'haoui') ?></option>
					<option value="date" <?php selected('date', $instance['orderby']); ?>><?php echo __('发布时间', 'haoui') ?></option>
					<option value="rand" <?php selected('rand', $instance['orderby']); ?>><?php echo __('随机', 'haoui') ?></option>
				</select>
			</label>
		</p>
		
		<p>
			<label>
				<?php echo __('分类限制：', 'haoui') ?>
				<a style="font-weight:bold;color:#f60;text-decoration:none;" href="javascript:;" title="<?php echo __('格式：1,2 &nbsp;表限制ID为1,2分类的文章&#13;格式：-1,-2 &nbsp;表排除分类ID为1,2的文章&#13;也可直接写1或者-1；注意逗号须是英文的', 'haoui') ?>">？</a>
				<input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				<?php echo __('显示数目：', 'haoui') ?>
				<input style="width:100%;" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" size="24" />
			</label>
		</p>
		
	<?php
	}
}












class widget_textasst extends WP_Widget {
	
	function __construct(){
		parent::__construct( 'widget_textasst', 'Picmore: 特别推荐', array( 'classname' => 'widget-textasst' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$tag = $instance['tag'];
		$content = $instance['content'];
		$link = $instance['link'];
		$style = $instance['style'];
		$blank = isset($instance['blank']) ? $instance['blank'] : '';

		$lank = '';
		if( $blank ) $lank = ' target="_blank"';

		echo $before_widget;
		echo '<a class="'.$style.'" href="'.$link.'"'.$lank.'>';
		echo '<strong>'.$tag.'</strong>';
		echo '<h2>'.$title.'</h2>';
		echo '<p>'.$content.'</p>';
		echo '</a>';
		echo $after_widget;
	}

	function form($instance) {
		$defaults = array( 
			'title' => '如此简单的下载', 
			'tag' => 'WpayTheme', 
			'content' => '扁平化、简洁风、多功能配置，优秀的电脑、平板、手机支持，响应式布局，不同设备不同展示效果...', 
			'link' => 'http://sjoneone.com/', 
			'style' => 'style01',
			'blank' => 'on',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label>
				名称：
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				描述：
				<textarea id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" class="widefat" rows="3"><?php echo $instance['content']; ?></textarea>
			</label>
		</p>
		<p>
			<label>
				标签：
				<input id="<?php echo $this->get_field_id('tag'); ?>" name="<?php echo $this->get_field_name('tag'); ?>" type="text" value="<?php echo $instance['tag']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				链接：
				<input style="width:100%;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="url" value="<?php echo $instance['link']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				样式：
				<select style="width:100%;" id="<?php echo $this->get_field_id('style'); ?>" name="<?php echo $this->get_field_name('style'); ?>" style="width:100%;">
					<option value="style01" <?php selected('style01', $instance['style']); ?>>蓝色</option>
					<option value="style02" <?php selected('style02', $instance['style']); ?>>橘红色</option>
					<option value="style03" <?php selected('style03', $instance['style']); ?>>绿色</option>
					<option value="style04" <?php selected('style04', $instance['style']); ?>>紫色</option>
				</select>
			</label>
		</p>
		<p>
			<label>
				<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked( $instance['blank'], 'on' ); ?> id="<?php echo $this->get_field_id('blank'); ?>" name="<?php echo $this->get_field_name('blank'); ?>">新打开浏览器窗口
			</label>
		</p>
	<?php
	}
}

 


