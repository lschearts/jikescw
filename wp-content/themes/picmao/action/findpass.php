<?php 
/*忘记密码*/

require( dirname(__FILE__) . '/../../../../wp-load.php' ); 
if(isset($_POST['useremail'])){
$email_data=trim($_POST['useremail']);

$is_haved_data=get_user_by('email',$email_data);
if($is_haved_data){
	echo json_encode(array('code'=>'1','msg'=>'该邮箱存在'));
}else{
	echo json_encode(array('code'=>'2','msg'=>'该邮箱不存在'));
}

exit;

}












 ?>