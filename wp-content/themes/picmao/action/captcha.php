<?php
require_once(dirname(__FILE__)."/../../../../wp-load.php");
if($_POST['action'] == 'WPAY_captcha' && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	
	$user_email = apply_filters( 'user_registration_email', $_POST['email'] );
	$user_email = $wpdb->_escape(trim($user_email));
	
	if ( email_exists( $user_email ) ){
		echo "2";
	}else{
		$send_email = sessioncode($user_email);
		if ($send_email) {
			echo "1";
		}else{
			echo "3";
		}
		
	}
}

function sessioncode($email){
  	session_start();
	$originalcode = '0,1,2,3,4,5,6,7,8,9';
	$originalcode = explode(',',$originalcode);
	$countdistrub = 10;
	$_dscode = "";
	$counts=6;
	for($j=0;$j<$counts;$j++){
		$dscode = $originalcode[rand(0,$countdistrub-1)];
		$_dscode.=$dscode;
	}
	$_SESSION['WPAY_code_captcha']=strtolower($_dscode);
	$_SESSION['WPAY_code_captcha_email']=$email;
	$message .= '尊敬的用户：您好！感谢您使用设计1+1服务，您正在进行邮箱验证，本次请求的验证码为：'.$_dscode;
	$send_email = wp_mail($email, '验证码-'.get_bloginfo('name'), $message);
	

	if ($send_email) {
		return true;
	}
	return false;
}

?>