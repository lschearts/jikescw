<?php 
/*
Plugin Name: DX-Contribute
Plugin URI: http://www.daxiawp.com/dx-contribute.html
Description: The shortcut Submission wordpress plugin. 快捷投稿插件。
Version: 1.4.0
Author: 大侠wp
Author URI: http://www.daxiawp.com/dx-contribute.html

Copyright: daxiawp开发的原创插件，任何个人或团体不可擅自更改版权。

*/
//header("Access-Control-Allow-Origin: *");

//dx-contribute plugin class
class DX_Contribute{
	
	//hook
	function __construct(){
		add_shortcode( 'DX-Contribute', array( $this, 'contribute_page' ) );
		add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'init', array( $this, 'contribute' ) );
		//add_action( 'init', array( $this, 'theme' ), 9999 );
		add_action( 'DXC_form_bottom', array( $this, 'contact' ) );
		add_filter( 'the_content', array( $this, 'contribute_metadata' ) );
		add_action ( 'publish_post', array( $this, 'publish' ) );
		//add_action( 'init',array($this,'thum_pic'));
		//上传文章封面
		add_action( 'init', array( $this, 'thumb_uploaded' ) );
	}
	
	//contribute page content
	function contribute_page( $atts, $content ){
		include( 'contribute-page.php' );
		return $content;
	}
	
	//plugin menu page
	function menu_page(){
		add_menu_page( 'DX-Contribute','投稿', 'manage_options', 'DX-Contribute', array( $this, 'options_form' ), plugins_url( 'icon.png', __FILE__ ) );
	}
	
	//menu page options form
	function options_form(){
		include( 'options-form.php' );
	}
	
	//contribute form submit
	function contribute(){
		//global $post;
		if( $_GET['DX-Contribute']=='submit' ){
			
			$DXC_options = get_option( 'DX-Contribute-options' );
			global $user_ID;
			$author = ( is_user_logged_in() ) ? $user_ID : $DXC_options['user'];
			session_start();
			$interval = abs( $_SESSION['DXC-interval'] - time() );
			
			if( $interval > $DXC_options['interval'] || empty( $_SESSION['DXC-interval'] ) ){
				$cat = ($DXC_options['select-cat']=='on') ? $_GET['DXC_cat'] : $DXC_options['category'];
				$cat = wp_filter_nohtml_kses( $cat );
				 
				
				$meta_inputs=array('wppay_type'=>wp_filter_nohtml_kses($_GET['wppay_type']),
								'wppay_vip_auth'=>1,
								'wppay_price'=>wp_filter_nohtml_kses($_GET['wppay_price']),
								'wppay_down'=>wp_filter_nohtml_kses($_GET['wppay_down']),
								'wppay_down_info'=>wp_filter_nohtml_kses($_GET['wppay_down_info']),
								'wppay_info_v'=>wp_filter_nohtml_kses($_GET['wppay_info_v']),
								'wppay_info_g'=>wp_filter_nohtml_kses($_GET['wppay_info_g']),
								'wppay_info_d'=>wp_filter_nohtml_kses($_GET['wppay_info_d']),
								


							);
				$args = array(
						'post_author' => $author,
						'post_category' => array( (int)$cat ), 
						'post_status' => 'pending',
						'post_type' => 'post',
						'tags_input' => wp_filter_nohtml_kses( $_GET['DXC_tags'] ),
						'post_title' => wp_filter_nohtml_kses( $_GET['DXC_title'] ),
						'post_content' => wp_filter_post_kses( $_GET['DXC_content'] ),
						'meta_input' =>$meta_inputs ,

					);
				$insert_id = wp_insert_post( $args );
				$_SESSION['DXC-interval'] = time();
				
				$already_has_thumb = has_post_thumbnail($insert_id);
				if (!$already_has_thumb)  {
       			$attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
        			if ($attached_image) {
           			foreach ($attached_image as $attachment_id => $attachment) {
              		set_post_thumbnail($insert_id, $attachment_id);
           			 }
       				 } else {
            		set_post_thumbnail($insert_id,654);
        			}
    				}

				/*$meta_data = array(
					'user' => wp_filter_nohtml_kses( $_GET[ 'DXC_user' ] ),
					'email' => wp_filter_nohtml_kses( $_GET[ 'DXC_email' ] ),
					'site' => wp_filter_nohtml_kses( $_GET[ 'DXC_site' ] )
				);
				update_post_meta( $insert_id, '_DX_Contribute', $meta_data );*/
				wp_mail( get_option('admin_email'), '文章审核：'.wp_filter_nohtml_kses( $_GET['DXC_title'] ), wp_filter_post_kses( $_GET['DXC_content'] ) );	
			}
			else{
				echo 'stop'.abs( $DXC_options['interval']-$interval );					
			}
			exit;
		}
	}
	
	function theme(){
		if( !function_exists('_daxiawp_theme_menu_page') ) include_once( 'theme.php' );
	}
	
	function contact(){
?>
	
<?php
	}
	
	//show contribute meta data
	function contribute_metadata( $content ){
		if( is_single() ){
			$DXC_options = get_option( 'DX-Contribute-options' );
			$pid = get_the_ID();
			$metas = get_post_meta( $pid, '_DX_Contribute', true );
			if( $DXC_options['meta-on'] = 'on' && $metas ){
				$avatar = get_avatar( $metas['email'], 25 );
				$url = ($metas['site'] == 'true') ? '' : $metas['site'];
				$user = $metas['user'];
				$site = ( $url ) ? '<a href="'.$url.'" rel="external nofollow" target="_blank">'.$user.'</a>' : '<a rel="nofollow">'.$user.'</a>';
				$style = '<style type="text/css">#contribute-metadata{line-height:25px;margin:10px 0;} #contribute-metadata img{display:block;float:left;margin-right:5px;}</style>';
				$meta_code = '<div id="contribute-metadata">'.$avatar.'<div id="contribute-site">'.$site.' 提交于'.get_the_time( 'Y-m-d H:i:s' ).'</div></div><div style="clear:both;"></div>';
				if( $DXC_options[ 'metapo' ]=='head' ){
					$content = $style.$meta_code.$content;
				}
				else $content .= $style.$meta_code;			
			}
		}
		return $content;
	}
	
	//publish and email
	function publish( $pid ){
		global $current_user;
		//$metas = get_post_meta( $pid, '_DX_Contribute', true );
		$DXC_options = get_option( 'DX-Contribute-options' );
		if( $current_user->user_email && $DXC_options['mail']=='send' ){
			$email = $current_user->user_email;
			$title = esc_attr( get_the_title( $pid ) );
			$url = get_permalink( $pid );
			$subject = $title. ' 你的作品审核通过！';
			$message = '你在设计1+1提交的文章”'.$title.'“已经审核通过，请通过以下链接浏览：'.$url;
			wp_mail('zhuyujin001@qq.com', $subject, $message );
		}
	}

/*
	function thum_pic(){
if (!function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails');
}

}*/

function thumb_uploaded(){
$dir_y=date('Y');
$dir_m=date('m');
$dir_name=ABSPATH.'uploads/'.$dir_y.'/'.$dir_m;
$net_dir_name=home_url('/').'uploads/'.$dir_y.'/'.$dir_m;
if(!is_dir($dir_name)){
	mkdir($dir_name,0777);
}	
if($_GET['methoded']=='picup' && $_FILES['picuped']['error']<=0){
		$file = $_FILES['picuped'];
		$temp = explode(".", $file["name"]);
		$extension = end($temp);        // 获取文件后缀名
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$file_ext=array("image/gif","image/jpeg","image/jpg","image/pjpeg","image/x-png","image/png");
		if($file['size']>300*1024){  
			
			$re=array(
                        'code'=>2,
                        'msg'=>'文件不能大于300kb',
                         );
			echo json_encode($re);

			exit;}

			if(!in_array($file['type'],$file_ext) || !in_array($extension, $allowedExts) ){
				$re=array(
                        'code'=>3,
                        'msg'=>'图片格式不正确',
                         );
			echo json_encode($re);
				exit;
			}
		$wp_upload_dir = wp_upload_dir();
		$basename   = $file['name'];
                $filename   = $wp_upload_dir['path'] . '/' . md5($basename).'.'.end(explode('.', $basename));
                $re         = rename( $file['tmp_name'], $filename );
                $attachment = array(
                        'guid'           => $wp_upload_dir['url'] . '/' . $basename,
                        'post_mime_type' => $file['type'],
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', $basename ),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                );
               $attach_id  = wp_insert_attachment( $attachment, $filename );
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
                wp_update_attachment_metadata( $attach_id, $attach_data );
                $re = array(
                        'code'=>0,
                        'msg'=>'上传成功',
                        'data'=>array(
                                'src'=>wp_get_attachment_url( $attach_id ),
                                'title'=>''
                        )
                );
                echo json_encode( $re );
                exit;

}  //if get
	
}  //function thumb
}//new
new DX_contribute();






