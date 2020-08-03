<?php
if(_hui('weihu_net')){
if(get_ip()!=_hui('no_weihu_ip')){
	include(__DIR__.'/pages/upgrade.php');
	exit();
}
}
	
if(is_home()){
	get_template_part( 'header','home' ); 
}else{

	get_template_part( 'header','page' ); 
}

/////首页和内容页活动倒计时遮罩
$activityChazhi=strtotime(_hui('activity_end_time'))-time(); 
if(is_home()||is_single()|| is_search() || is_category()) {
 if(_hui('activity_end_open') && ($activityChazhi>0) ){

get_template_part('index','zhezhao');


}	
}

?>