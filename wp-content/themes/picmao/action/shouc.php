<?php

/*if ( 'POST' != $_SERVER['REQUEST_METHOD'] ) {
	header('Allow: POST');
	header('HTTP/1.1 405 Method Not Allowed');
	header('Content-Type: text/plain');
	exit;
}
*/


require( dirname(__FILE__).'/../../../../wp-load.php' );
global $wpdb,$post;

//新建数据表 用户收藏文章
//获取表前缀
$wpprefix=$wpdb->prefix.'collect';
$uid=$_POST['user_id'];
$postid=$_POST['post_id'];
$time=time();
if($_POST['post_action']=='shoucang'){
	
	//取值
	$sql="SELECT statused,uid,postid FROM {$wpprefix} WHERE uid={$uid} AND postid = {$postid}";

	//$result= $wpdb->get_row($sql,ARRAY_A);
	$result= $wpdb->get_var($sql);
	if($result){


		echo json_encode(array('status'=>2));

	}else
	{

		//插入数据
		$table=$wpprefix;
		$table_data=array('uid'=>$uid,'postid'=>$postid,'statused'=>2,'create_time'=>$time,'update_time'=>$time);
		$format=array('%d','%d','%d','%s','%s');
		/**/
		$wpdb->insert($table,$table_data,$format);
		echo json_encode(array('status'=>2));
	}

	













} //if($_POST)







?>