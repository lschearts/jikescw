<?php
if ( !defined('ABSPATH') ) {exit;}

add_action( 'admin_menu', 'wppay_add_metabox_data' );
function wppay_add_metabox_data(){
	add_meta_box( 'wppay-postmeta-box','付费资源设置', 'wppay_get_metabox_options', 'post', 'normal', 'high' );
}


add_action( 'save_post', 'wppay_save_metabox_data' );
function wppay_save_metabox_data($post_id){
	$metaboxes = array_merge( wppay_metabox_options() );

	foreach ( $metaboxes as $metabox ) :
		if ( !wp_verify_nonce( _post($metabox['name'] . '_input_name'), plugin_basename( __FILE__ ) ) )
			return $post_id;
		if ( 'post' == _post('post_type') && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		$data = stripslashes( _post($metabox['name']) );
		if ( get_post_meta( $post_id, $metabox['name'] ) == '' )
			add_post_meta( $post_id, $metabox['name'], $data, true );
		elseif ( $data != get_post_meta( $post_id, $metabox['name'], true ) )
			update_post_meta( $post_id, $metabox['name'], $data );
		elseif ( $data == '' )
			delete_post_meta( $post_id, $metabox['name'], get_post_meta( $post_id, $metabox['name'], true ) );
	endforeach;
}

function wppay_metabox_options() {
	$metaboxes = array(
		array(
			"name"             => "wppay_type",
			"title"            => "资源查看类型",
			"type"             => "radio",
			'options' => array(
				'0' => '不启用',
	            '1' => '全部内容',
	            '2' => '部分内容（利用短代码[wppay]隐藏内容[/wppay]）',
	            '3' => '收费下载',
				'4' => '免费下载',
	        ),
	        'default' => '0',
			"capability"       => "manage_options"
		),
		array(
			"name"             => "wppay_vip_auth",
			"title"            => "VIP查看权限",
			"type"             => "radio",
			'options' => array(
				'0' => '不启用',
	            '1' => '月费-会员免费',
	            '2' => '年费-会员免费',
	            '3' => '终身-会员免费'
	        ),
	        'default' => '0',
			"capability"       => "manage_options"
		),
		array(
			"name"             => "wppay_price",
			"title"            => "收费价格",
			"type"             => "number",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "wppay_down",
			"title"            => "下载地址（例：https://pan.baidu.com/....../）",
			"type"             => "text",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "wppay_down_info",
			"title"            => "下载密码（例：Eq76,为空则无密码）",
			"type"             => "text",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "wppay_demourl",
			"title"            => "作品色系",
			"type"             => "radio",
			'options' => array(
				'1' => '红色',
	            '2' => '橙色',
	            '3' => '黄色',
	            '4' => '绿色',
				'5' => '蓝色',
				'6' => '紫色',
				'7' => '紫红色',
				'8' => '棕色',
	            '9' => '黑色',
				'11' => '灰色',
				'12' => '白色',
				
	        ),
	        'default' => '1',
			"capability"       => "manage_options"
		),
		array(
			"name"             => "wppay_info_v",
			"title"            => "当前版本(例：photoshop cc,凡是有下载文件时必填)",
			"type"             => "text",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "wppay_info_g",
			"title"            => "文件格式(例：psd,凡是有下载文件时必填。格式规范：PSD、AI、CDR、EPS、PNG、JPG、MAX、DWG、C4D、SKP、AEP、PPTX、DOCX、XLS、MP4、MOV、AVI、WMF)",
			"type"             => "text",
			"capability"       => "manage_options"
		),
		array(
			"name"             => "wppay_info_d",
			"title"            => "文件大小(例：21.6M,凡是有下载文件时必填)",
			"type"             => "text",
			"capability"       => "manage_options"
		)
		
	);
	return $metaboxes;
}

function wppay_get_metabox_options(){
	global $post;
	$metaboxes = wppay_metabox_options(); 
	foreach ( $metaboxes as $meta ) :
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if ( $meta['type'] == 'number' ){
		?>
		<div id="<?php echo $meta['name']; ?>" class="wppay-metabox-options" style="margin-bottom: 10px;">
			<label for="<?php echo $meta['name']; ?>"><b><?php echo $meta['title']; ?></b></label><br><br>
			<input type="number" min="0" step="0.01" name="<?php echo $meta['name']; ?>" id="<?php echo $meta['name']; ?>" value="<?php echo esc_html( $value, 1 ); ?>" style="width: 100px;" /> 元
			<input type="hidden" name="<?php echo $meta['name']; ?>_input_name" id="<?php echo $meta['name']; ?>_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
		</div>
		<?php
		}elseif ( $meta['type'] == 'text' ){
		?>
			<div id="<?php echo $meta['name']; ?>" class="wppay-metabox-options" style="margin-bottom: 10px;display: inline-block;width: 100%;">
				<label for="<?php echo $meta['name']; ?>"><b><?php echo $meta['title']; ?></b></label><br><br>
				<input type="text" min="0" step="0.01" name="<?php echo $meta['name']; ?>" id="<?php echo $meta['name']; ?>" value="<?php echo esc_html( $value, 1 ); ?>" style="width: 100%;" />
				<input type="hidden" name="<?php echo $meta['name']; ?>_input_name" id="<?php echo $meta['name']; ?>_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			</div>
		<?php
		}elseif ( $meta['type'] == 'radio' ){
			echo '<div id="'.$meta['name'].'" class="wppay-metabox-options" style="margin-bottom: 10px;"><label for="'.$meta['name'].'"><b>'.$meta['title'].'</b></label><br><br>';
			$i=1;
            foreach ($meta['options'] as $key => $option) {
            	if(!$value) $value=$meta['default'];
                echo '<input type="radio" name="'.$meta['name'].'" id="'.$meta['name'].$i.'" value="'. esc_attr( $key ) . '" '. checked( $value, $key, false) .' /><label for="'.$meta['name'].$i.'">' . esc_html( $option ) . '</label>&nbsp;&nbsp;&nbsp;&nbsp;';
                $i ++;
            }
            echo '<input type="hidden" name="'.$meta['name'].'_input_name" id="'.$meta['name'].'_input_name" value="'.wp_create_nonce( plugin_basename( __FILE__ ) ).'" />';
            echo '</div>';
		}elseif ( $meta['type'] == 'textarea' ){
            if(empty($value)){
                $value= 'https://pan.baidu.com';
            }
			?>
			<div id="<?php echo $meta['name']; ?>" class="wppay-metabox-options" style="margin-bottom: 10px;">
				<label for="<?php echo $meta['name']; ?>"><b><?php echo $meta['title']; ?></b></label><br><br>
				<textarea rows="6" cols="20" class="input-text wide-input " name="<?php echo $meta['name']; ?>" id="<?php echo $meta['name']; ?>" style="    width: 100%;"><?php echo esc_html( $value ); ?></textarea>
				<input type="hidden" name="<?php echo $meta['name']; ?>_input_name" id="<?php echo $meta['name']; ?>_input_name" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
			</div>
		<?php } ?>
	<?php 
	endforeach; 
	?>
	<script>
		$("input[name='wppay_type']").click(function(){
			var wppay_type= $("input[name='wppay_type']:checked").val();
			if (wppay_type <= 2) {
				$("#wppay_price,#wppay_down,#wppay_down_info,#wppay_demourl,#wppay_info_v,#wppay_info_g,#wppay_info_d").hide('fast');
			}else{
				$("#wppay_price,#wppay_down,#wppay_down_info,#wppay_demourl,#wppay_info_v,#wppay_info_g,#wppay_info_d").show('fast');
			}
		});
	</script>
<?php 
} 
?>


